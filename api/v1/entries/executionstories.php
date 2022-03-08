<?php
/**
 * The execution entry point of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2021 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     execution
 * @version     1
 * @link        http://www.zentao.net
 */
class executionStoriesEntry extends entry
{
    /**
     * GET method.
     *
     * @param  int    $executionID
     * @access public
     * @return void
     */
    public function get($executionID)
    {
        if(empty($executionID)) $this->param('execution', 0);
        if(empty($executionID)) return $this->sendError(400, 'Need execution id.');

        $control = $this->loadController('execution', 'story');
        $control->story($executionID, $this->param('order', 'id_desc'), $this->param('status', 'all'), 0, 0, $this->param('limit', 20), $this->param('page', 1));
        $data = $this->getData();

        if(isset($data->status) and $data->status == 'success')
        {
            $stories = $data->data->stories;
            $pager   = $data->data->pager;
            $result  = array();
            foreach($stories as $story)
            {
                $story->name =$story->title;
                $result[] = $this->format($story, 'openedBy:user,openedDate:time,assignedTo:user,assignedDate:time,reviewedBy:user,reviewedDate:time,lastEditedBy:user,lastEditedDate:time,closedBy:user,closedDate:time,deleted:bool,mailto:userList');
            }
            return $this->send(200, array('page' => $pager->pageID, 'total' => $pager->recTotal, 'limit' => $pager->recPerPage, 'stories' => $result));
        }

        if(isset($data->status) and $data->status == 'fail') return $this->sendError(zget($data, 'code', 400), $data->message);

        return $this->sendError(400, 'error');
    }
}
