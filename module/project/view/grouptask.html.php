<?php
/**
 * The task group view file of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     project
 * @version     $Id: grouptask.html.php 4143 2013-01-18 07:01:06Z wyd621@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include './taskheader.html.php';?>
<?php if(isset($lang->project->groupFilter[$groupBy])):?>
<?php $currentFilter = empty($filter) ? key($lang->project->groupFilter[$groupBy]) : $filter;?>
<div class='sub-featurebar'>
  <ul class='nav nav-tabs'>
    <?php foreach($lang->project->groupFilter[$groupBy] as $filterKey => $name):?>
    <li <?php if($filterKey == $currentFilter) echo "class='active'"?>><?php echo html::a(inlink('grouptask', "projectID=$projectID&groupBy=$groupBy&filter=$filterKey"), $name)?></li>
    <?php endforeach;?>
  </ul>
</div>
<?php endif;?>
<table class='table active-disabled table-condensed table-fixed' id='groupTable'>
  <thead>
    <tr>
      <th class='text-left' style='width:210px'>
        <?php echo html::a('###', "<i class='icon-caret-down'></i> " . $lang->task->$groupBy, '', "class='expandAll' data-action='expand'")?>
        <?php echo html::a('###', "<i class='icon-caret-right'></i> " . $lang->task->$groupBy, '', "class='collapseAll hidden' data-action='collapse'")?>
      </th>
      <th class='w-id'><?php echo $lang->task->id;?></th>
      <th class='w-pri'> <?php echo $lang->priAB;?></th>
      <th><?php echo $lang->task->name;?></th>
      <th class='w-80px'><?php echo $lang->task->status;?></th>
      <th class='w-80px'><?php echo $lang->task->deadlineAB;?></th>
      <th class='w-user'><?php echo $lang->task->assignedTo;?></th>
      <th class='w-user'><?php echo $lang->task->finishedBy;?></th>
      <th class='w-50px'><?php echo $lang->task->estimateAB;?></th>
      <th class='w-50px'><?php echo $lang->task->consumedAB;?></th>
      <th class='w-50px'><?php echo $lang->task->leftAB;?></th>
      <th class='w-50px'><?php echo $lang->task->progress;?></th>
      <th class='w-50px'><?php echo $lang->typeAB;?></th>
      <th class='w-60px'><?php echo $lang->actions;?></th>
    </tr>
  </thead>
  <tbody>
  <?php
  if($groupBy == 'finishedBy') unset($tasks['']);
  if($groupBy == 'closedBy') unset($tasks['']);
  ?>
  <?php $groupIndex = 0;?>
  <?php foreach($tasks as $groupKey => $groupTasks):?>
  <?php
    $groupWait     = 0;
    $groupDone     = 0;
    $groupDoing    = 0;
    $groupClosed   = 0;  
    $groupEstimate = 0.0;
    $groupConsumed = 0.0;
    $groupLeft     = 0.0;

    $groupName = $groupKey;
    if($groupBy == 'story') $groupName = empty($groupName) ? $this->lang->task->noStory : zget($groupByList, $groupKey);
    if($groupBy == 'assignedTo' and $groupName == '') $groupName = $this->lang->task->noAssigned;
  ?>
  <?php
  $rowspan = 0;
  foreach($groupTasks as $taskKey => $task)
  {
      if(isset($currentFilter) and $currentFilter != 'all')
      {
          if($groupBy == 'story' and $currentFilter == 'linked' and empty($task->story))
          {
              unset($groupTasks[$taskKey]);
              continue;
          }
          if($groupBy == 'pri' and $currentFilter == 'noset'  and !empty($task->pri))
          {
              unset($groupTasks[$taskKey]);
              continue;
          }
          if($groupBy == 'assignedTo' and $currentFilter == 'undone' and $task->status != 'wait' and $task->status != 'doing')
          {
              unset($groupTasks[$taskKey]);
              continue;
          }
      }

      if(!empty($task->children)) $rowspan += count($task->children);

      $groupEstimate  += $task->estimate;
      $groupConsumed  += $task->consumed;
      $groupLeft      += ($task->status == 'cancel' ? 0 : $task->left);

      if($task->status == 'wait')   $groupWait++;
      if($task->status == 'doing')  $groupDoing++;
      if($task->status == 'done')   $groupDone++;
      if($task->status == 'closed') $groupClosed++;
  }
  $groupSum = count($groupTasks);
  $rowspan += $groupSum;
  ?>
  <?php $i = 0;?>
  <?php foreach($groupTasks as $task):?>
  <?php $assignedToClass = $task->assignedTo == $app->user->account ? "style='color:red'" : '';?>
  <?php $taskLink        = $this->createLink('task','view',"taskID=$task->id"); ?>
    <tr class='text-center' data-id='<?php echo $groupIndex?>'>
      <?php if($i == 0):?>
      <td rowspan='<?php echo $rowspan?>' class='groupby text-left'>
        <?php echo html::a('###', "<i class='icon-caret-down'></i> " . $groupName, '', "class='expandGroup' data-action='expand' title='$groupName'");?>
        <div class='groupSummary text' style='white-space:normal'>
        <?php if($groupBy == 'assignedTo' and isset($members[$task->assignedTo])) printf($lang->project->memberHours, $users[$task->assignedTo], $members[$task->assignedTo]->totalHours);?>
        <?php printf($lang->project->groupSummaryAB, $groupSum, $groupWait, $groupDoing, $groupEstimate, $groupConsumed, $groupLeft);?>
        </div>
      </td>
      <?php endif;?>
      <td><?php echo $task->id;?></td>
      <td><span class='<?php echo 'pri' . zget($lang->task->priList, $task->pri, $task->pri)?>'><?php echo zget($lang->task->priList, $task->pri, $task->pri);?></span></td>
      <td class='text-left'><?php if(!empty($task->team)) echo '<span class="label">'.$lang->task->multipleAB.'</span> ';if(!common::printLink('task', 'view', "task=$task->id", $task->name)) echo $task->name;?></td>
      <td class='task-<?php echo $task->status;?>'><?php echo $lang->task->statusList[$task->status];?></td>
      <td class='<?php if(isset($task->delay)) echo 'delayed';?>'><?php if(substr($task->deadline, 0, 4) > 0) echo $task->deadline;?></td>
      <td <?php echo $assignedToClass;?>><?php echo $task->assignedToRealName;?></td>
      <td><?php echo $users[$task->finishedBy];?></td>
      <td><?php echo $task->estimate;?></td>
      <td><?php echo $task->consumed;?></td>
      <td><?php echo $task->left;?></td>
      <td class='text-left'><?php echo $task->progress . '%';?></td>
      <td><?php echo $lang->task->typeList[$task->type];?></td>
      <td>
        <?php common::printIcon('task', 'edit', "taskid=$task->id", '', 'list');?>
        <?php common::printIcon('task', 'delete', "projectID=$task->project&taskid=$task->id", '', 'list', '', 'hiddenwin');?>
      </td>
    </tr>
    <?php if(!empty($task->children)):?>
    <?php foreach($task->children as $key => $child):?>
    <?php $class  = $key == 0 ? 'table-child-top' : '';?>
    <?php $class .= ($key + 1  == count($task->children)) ? ' table-child-bottom' : '';?>
    <tr class='text-center table-children <?php echo $class;?>' data-id='<?php echo $groupIndex;?>'>
      <td><?php echo $child->id;?></td>
      <td>
        <span class='<?php echo 'pri' . zget($lang->task->priList, $child->pri, $task->pri)?>'><?php echo zget($lang->task->priList, $child->pri, $child->pri);?></span>
      </td>
      <td class='text-left'><span class="label"><?php echo $lang->task->childrenAB;?></span> <?php if(!common::printLink('task', 'view', "task=$child->id", $child->name)) echo $child->name;?></td>
      <td class='task-<?php echo $child->status;?>'><?php echo $lang->task->statusList[$child->status];?></td>
      <td class='<?php if(isset($child->delay)) echo 'delayed';?>'><?php if(substr($child->deadline, 0, 4) > 0) echo $child->deadline;?></td>
      <td <?php echo $assignedToClass;?>><?php echo $child->assignedToRealName;?></td>
      <td><?php echo $users[$child->finishedBy];?></td>
      <td><?php echo $child->estimate;?></td>
      <td><?php echo $child->consumed;?></td>
      <td><?php echo $child->left;?></td>
      <td class='text-left'><?php echo $child->progress . '%';?></td>
      <td><?php echo $lang->task->typeList[$child->type];?></td>
      <td>
        <?php common::printIcon('task', 'edit', "taskid=$child->id", '', 'list');?>
        <?php common::printIcon('task', 'delete', "projectID=$child->project&taskid=$child->id", '', 'list', '', 'hiddenwin');?>
      </td>
    </tr>
    <?php $i++;?>
    <?php endforeach;?>
    <?php endif;?>
    <?php $i++;?>
    <?php endforeach;?>
    <?php if($i != 0):?>
    <tr class='actie-disabled group-collapse hidden text-center group-title' data-id='<?php echo $groupIndex?>'>
      <td class='text-left'>
        <?php echo html::a('###', "<i class='icon-caret-right'></i> " . $groupName, '', "class='collapseGroup' data-action='collapse' title='$groupName'");?>
      </td>
      <td colspan='13' class='text-left'>
        <span class='groupdivider' style='margin-left:10px;'>
          <span class='text'>
            <?php if($groupBy == 'assignedTo' and isset($members[$task->assignedTo])) printf($lang->project->memberHours, $users[$task->assignedTo], $members[$task->assignedTo]->totalHours);?>
            <?php printf($lang->project->groupSummary, $groupSum, $groupWait, $groupDoing, $groupEstimate, $groupConsumed, $groupLeft);?>
          </span>
        </span>
      </td>
    </tr>
    <?php endif;?>
    <?php $groupIndex ++;?>
  <?php endforeach;?>
  </tbody>
</table>
<script language='Javascript'>$('#<?php echo $browseType;?>Tab').addClass('active');</script>
<?php include '../../common/view/footer.html.php';?>
