<?php
global $lang;
$config->kanban = new stdclass();

$config->kanban->require = new stdclass();
$config->kanban->require->createregion = 'name';
$config->kanban->require->createlane   = 'name';
$config->kanban->require->createcolumn = 'name';

$config->kanban->setwip        = new stdclass();
$config->kanban->setlane       = new stdclass();
$config->kanban->setlaneColumn = new stdclass();
$config->kanban->create        = new stdclass();
$config->kanban->edit          = new stdclass();
$config->kanban->createspace   = new stdclass();
$config->kanban->editspace     = new stdclass();
$config->kanban->createcard    = new stdclass();

$config->kanban->editcard      = new stdclass();

$config->kanban->setwip->requiredFields        = 'limit';
$config->kanban->setlane->requiredFields       = 'name,type';
$config->kanban->setlaneColumn->requiredFields = 'name';
$config->kanban->create->requiredFields        = 'space,name';
$config->kanban->edit->requiredFields          = 'space,name';
$config->kanban->createspace->requiredFields   = 'name,owner';
$config->kanban->editspace->requiredFields     = 'name,owner';
$config->kanban->createcard->requiredFields    = 'name';

$config->kanban->editcard->requiredFields = 'name';

$config->kanban->editor = new stdclass();
$config->kanban->editor->create      = array('id' => 'desc', 'tools' => 'simpleTools');
$config->kanban->editor->edit        = array('id' => 'desc', 'tools' => 'simpleTools');
$config->kanban->editor->createspace = array('id' => 'desc', 'tools' => 'simpleTools');
$config->kanban->editor->editspace   = array('id' => 'desc', 'tools' => 'simpleTools');
$config->kanban->editor->closespace  = array('id' => 'comment', 'tools' => 'simpleTools');
$config->kanban->editor->createcard  = array('id' => 'desc', 'tools' => 'simpleTools');
$config->kanban->editor->close       = array('id' => 'comment', 'tools' => 'simpleTools');
$config->kanban->editor->editcard    = array('id' => 'desc', 'tools' => 'simpleTools');
$config->kanban->editor->viewcard    = array('id' => 'comment', 'tools' => 'simpleTools');

$config->kanban->default = new stdclass();
$config->kanban->default->story  = new stdclass();
$config->kanban->default->story->name  = $lang->SRCommon;
$config->kanban->default->story->color = '#7ec5ff';
$config->kanban->default->story->order = '5';

$config->kanban->default->bug = new stdclass();
$config->kanban->default->bug->name  = $lang->bug->common;
$config->kanban->default->bug->color = '#ba55d3';
$config->kanban->default->bug->order = '10';

$config->kanban->default->task = new stdclass();
$config->kanban->default->task->name  = $lang->task->common;
$config->kanban->default->task->color = '#4169e1';
$config->kanban->default->task->order = '15';

$config->kanban->storyColumnStageList = array();
$config->kanban->storyColumnStageList['backlog']    = 'projected';
$config->kanban->storyColumnStageList['ready']      = 'projected';
$config->kanban->storyColumnStageList['developing'] = 'developing';
$config->kanban->storyColumnStageList['developed']  = 'developed';
$config->kanban->storyColumnStageList['testing']    = 'testing';
$config->kanban->storyColumnStageList['tested']     = 'tested';
$config->kanban->storyColumnStageList['verified']   = 'verified';
$config->kanban->storyColumnStageList['released']   = 'released';
$config->kanban->storyColumnStageList['closed']     = 'closed';

$config->kanban->storyColumnStatusList = array();
$config->kanban->storyColumnStatusList['backlog']    = 'active';
$config->kanban->storyColumnStatusList['ready']      = 'active';
$config->kanban->storyColumnStatusList['developing'] = 'active';
$config->kanban->storyColumnStatusList['developed']  = 'active';
$config->kanban->storyColumnStatusList['testing']    = 'active';
$config->kanban->storyColumnStatusList['tested']     = 'active';
$config->kanban->storyColumnStatusList['verified']   = 'active';
$config->kanban->storyColumnStatusList['released']   = 'active';
$config->kanban->storyColumnStatusList['closed']     = 'closed';

$config->kanban->bugColumnStatusList = array();
$config->kanban->bugColumnStatusList['unconfirmed'] = 'active';
$config->kanban->bugColumnStatusList['confirmed']   = 'active';
$config->kanban->bugColumnStatusList['fixing']      = 'active';
$config->kanban->bugColumnStatusList['fixed']       = 'resolved';
$config->kanban->bugColumnStatusList['testing']     = 'resolved';
$config->kanban->bugColumnStatusList['tested']      = 'resolved';
$config->kanban->bugColumnStatusList['closed']      = 'closed';

$config->kanban->taskColumnStatusList = array();
$config->kanban->taskColumnStatusList['wait']       = 'wait';
$config->kanban->taskColumnStatusList['developing'] = 'doing';
$config->kanban->taskColumnStatusList['developed']  = 'done';
$config->kanban->taskColumnStatusList['pause']      = 'pause';
$config->kanban->taskColumnStatusList['canceled']   = 'cancel';
$config->kanban->taskColumnStatusList['closed']     = 'closed';

$config->kanban->laneColorList   = array('#7ec5ff', '#333', '#2b529c', '#e48600', '#d2323d', '#229f24', '#777', '#d2691e', '#008b8b', '#2e8b57', '#4169e1', '#4b0082', '#fa8072', '#ba55d3', '#6b8e23');
$config->kanban->columnColorList = array('#333', '#2b519c', '#e48610', '#d2313d', '#2a9f23', '#777', '#d2691e', '#2e8b8b', '#2f8b58', '#4168e0', '#4b0082', '#f58072', '#ba55d3', '#6a8e22');
