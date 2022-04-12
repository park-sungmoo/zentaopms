#!/usr/bin/env php
<?php
include dirname(dirname(dirname(__FILE__))) . '/lib/init.php';
include dirname(dirname(dirname(__FILE__))) . '/class/stage.class.php';
su('admin');

/**

title=测试 stageModel->batchCreate();
cid=1
pid=1

*/
$name1    = array('1' => '批量创建的需求', '2' => '批量创建的设计', '3' => '', '4' => '', '5' => '', '6' => '', '7' => '', '8' => '', '9' => '', '10' => '');
$percent1 = array('1' => '1', '2' => '2', '3' => '', '4' => '', '5' => '', '6' => '', '7' => '', '8' => '', '9' => '', '10' => '');
$type1    = array('1' => 'request', '2' => 'design', '3' => '', '4' => '', '5' => '', '6' => '', '7' => '', '8' => '', '9' => '', '10' => '');

$name2    = array('1' => '批量创建的开发', '2' => '批量创建的测试', '3' => '', '4' => '', '5' => '', '6' => '', '7' => '', '8' => '', '9' => '', '10' => '');
$percent2 = array('1' => '3', '2' => '4', '3' => '', '4' => '', '5' => '', '6' => '', '7' => '', '8' => '', '9' => '', '10' => '');
$type2    = array('1' => 'dev', '2' => 'qa', '3' => '', '4' => '', '5' => '', '6' => '', '7' => '', '8' => '', '9' => '', '10' => '');

$name3    = array('1' => '批量创建的发布', '2' => '批量创建的总结评审', '3' => '', '4' => '', '5' => '', '6' => '', '7' => '', '8' => '', '9' => '', '10' => '');
$percent3 = array('1' => '5', '2' => '6', '3' => '', '4' => '', '5' => '', '6' => '', '7' => '', '8' => '', '9' => '', '10' => '');
$type3    = array('1' => 'release', '2' => 'review', '3' => '', '4' => '', '5' => '', '6' => '', '7' => '', '8' => '', '9' => '', '10' => '');

$name4    = array('1' => '', '2' => '批量创建的其他', '3' => '', '4' => '', '5' => '', '6' => '', '7' => '', '8' => '', '9' => '', '10' => '');
$percent4 = array('1' => '1', '2' => '7', '3' => '', '4' => '', '5' => '', '6' => '', '7' => '', '8' => '', '9' => '', '10' => '');
$type4    = array('1' => 'request', '2' => 'other', '3' => '', '4' => '', '5' => '', '6' => '', '7' => '', '8' => '', '9' => '', '10' => '');

$param1 = array('name' => $name1, 'percent' => $percent1, 'type' => $type1);
$param2 = array('name' => $name2, 'percent' => $percent2, 'type' => $type2);
$param3 = array('name' => $name3, 'percent' => $percent3, 'type' => $type3);
$param4 = array('name' => $name4, 'percent' => $percent4, 'type' => $type4);

$stage = new stageTest();

r($stage->batchCreateTest($param1)) && p() && e('8');  // 测试批量创建阶段 1
r($stage->batchCreateTest($param2)) && p() && e('10'); // 测试批量创建阶段 2
r($stage->batchCreateTest($param3)) && p() && e('12'); // 测试批量创建阶段 3
r($stage->batchCreateTest($param4)) && p() && e('13'); // 测试批量创建阶段 4
system("./ztest init");
