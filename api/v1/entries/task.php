<?php
/**
 * The task entry point of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2021 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     entries
 * @version     1
 * @link        http://www.zentao.net
 */
class taskEntry extends Entry
{
    /**
     * GET method.
     *
     * @param  int    $taskID
     * @access public
     * @return void
     */
    public function get($taskID)
    {
        $control = $this->loadController('task', 'view');
        $control->view($taskID);

        $data = $this->getData();

        if(!$data or !isset($data->status)) return $this->send400('error');
        if(isset($data->status) and $data->status == 'fail') return isset($data->code) and $data->code == 404 ? $this->send404() : $this->sendError(400, $data->message);

        $task = $data->data->task;

        if(!empty($task->children)) $task->children = array_values((array)$task->children);
        if($task->parent > 0) $task->parentPri = $this->dao->select('pri')->from(TABLE_TASK)->where('id')->eq($task->parent)->fetch('pri');

        /* Set execution name */
        $task->executionName = $data->data->execution->name;

        /* Set module title */
        $moduleTitle = '';
        if(empty($task->module)) $moduleTitle = '/';
        if($task->module)
        {
            $modulePath = $data->data->modulePath;
            foreach($modulePath as $key => $module)
            {
                $moduleTitle .= $module->name;
                if(isset($modulePath[$key + 1])) $moduleTitle .= '/';
            }
        }
        $task->moduleTitle = $moduleTitle;

        /* Format user for api. */
        if($task->openedBy)     $task->openedBy     = $this->formatUser($task->openedBy, $data->data->users);
        if($task->finishedBy)   $task->finishedBy   = $this->formatUser($task->finishedBy, $data->data->users);
        if($task->canceledBy)   $task->canceledBy   = $this->formatUser($task->canceledBy, $data->data->users);
        if($task->closedBy)     $task->closedBy     = $this->formatUser($task->closedBy, $data->data->users);
        if($task->lastEditedBy) $task->lastEditedBy = $this->formatUser($task->lastEditedBy, $data->data->users);

        $mailto = array();
        if($task->mailto)
        {
            foreach(explode(',', $task->mailto) as $account)
            {
                if(empty($account)) continue;
                $mailto[] = $this->formatUser($account, $data->data->users);
            }
        }
        $task->mailto = $mailto;

        $queryAccounts = array();
        if($task->assignedTo) $queryAccounts[$task->assignedTo] = $task->assignedTo;
        if(!empty($task->team))
        {
            foreach($task->team as $account => $team) $queryAccounts[$account] = $account;
        }
        $usersWithAvatar = $this->loadModel('user')->getListByAccounts($queryAccounts, 'account');

        $task->assignedTo = zget($usersWithAvatar, $task->assignedTo, '');
        if(!empty($task->team))
        {
            $teams = array();
            foreach($task->team as $account => $team)
            {
                $user = zget($usersWithAvatar, $account, '');
                $team->realname = $user ? $user->realname : $account;
                $team->avatar   = $user ? $user->avatar : '';
                $team->progress = (empty($team->consumed) and empty($team->left)) ? 0 : round($team->consumed / ($team->consumed + $team->left) * 100, 1);

                $teams[] = $team;
            }
            $task->team = $teams;
        }

        $task->actions = $this->loadModel('action')->processActionForAPI($data->data->actions, $data->data->users, $this->lang->task);

        $this->send(200, $this->format($task, 'openedDate:time,assignedDate:time,realStarted:time,finishedDate:time,canceledDate:time,closedDate:time,lastEditedDate:time,deleted:bool'));
    }

    /**
     * PUT method.
     *
     * @param  int    $taskID
     * @access public
     * @return void
     */
    public function put($taskID)
    {
        $oldTask = $this->loadModel('task')->getByID($taskID);

        /* Set $_POST variables. */
        $fields = 'name,type,assignedTo,estimate,left,consumed,story,parent,execution,module,closedReason,status,estStarted,deadline';
        $this->batchSetPost($fields, $oldTask);

        $control = $this->loadController('task', 'edit');
        $control->edit($taskID);

        $this->getData();
        $task = $this->task->getByID($taskID);
        $this->send(200, $this->format($task, 'openedDate:time,assignedDate:time,realStarted:time,finishedDate:time,canceledDate:time,closedDate:time,lastEditedDate:time'));
    }

    /**
     * DELETE method.
     *
     * @param  int    $taskID
     * @access public
     * @return void
     */
    public function delete($taskID)
    {
        $control = $this->loadController('task', 'delete');
        $control->delete(0, $taskID, 'true');

        $this->getData();
        $this->sendSuccess(200, 'success');
    }
}
