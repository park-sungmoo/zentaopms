#!/usr/bin/env php
<?php
include dirname(dirname(dirname(__FILE__))) . '/lib/init.php';
include dirname(dirname(dirname(__FILE__))) . '/class/product.class.php';

/**

title=productModel->getAllExecutionPairsByProduct();
cid=1
pid=1

测试获取产品1的执行信息 >> 项目1/迭代1,项目11/迭代11,项目1/迭代91,项目11/迭代101,项目1/迭代181,项目11/迭代191,项目1/迭代271,项目11/迭代281,项目1/迭代361,项目11/迭代371,项目1/迭代451,项目11/迭代461,项目1/迭代541,项目11/迭代551
测试获取产品2的执行信息 >> 项目2/迭代2,项目12/迭代12,项目2/迭代92,项目12/迭代102,项目2/迭代182,项目12/迭代192,项目2/迭代272,项目12/迭代282,项目2/迭代362,项目12/迭代372,项目2/迭代452,项目12/迭代462,项目2/迭代542,项目12/迭代552
测试获取产品3的执行信息 >> 项目3/迭代3,项目13/迭代13,项目3/迭代93,项目13/迭代103,项目3/迭代183,项目13/迭代193,项目3/迭代273,项目13/迭代283,项目3/迭代363,项目13/迭代373,项目3/迭代453,项目13/迭代463,项目3/迭代543,项目13/迭代553
测试获取产品4的执行信息 >> 项目4/迭代4,项目14/迭代14,项目4/迭代94,项目14/迭代104,项目4/迭代184,项目14/迭代194,项目4/迭代274,项目14/迭代284,项目4/迭代364,项目14/迭代374,项目4/迭代454,项目14/迭代464,项目4/迭代544,项目14/迭代554
测试获取产品5的执行信息 >> 项目5/迭代5,项目15/迭代15,项目5/迭代95,项目15/迭代105,项目5/迭代185,项目15/迭代195,项目5/迭代275,项目15/迭代285,项目5/迭代365,项目15/迭代375,项目5/迭代455,项目15/迭代465,项目5/迭代545,项目15/迭代555

*/

$productIDList = array('1', '2', '3', '4', '5', '1000001');

$product = new productTest('admin');

r($product->getAllExecutionPairsByProductTest($productIDList[0])) && p('101,111,191,201,281,291,371,381,461,471,551,561,641,651') && e('项目1/迭代1,项目11/迭代11,项目1/迭代91,项目11/迭代101,项目1/迭代181,项目11/迭代191,项目1/迭代271,项目11/迭代281,项目1/迭代361,项目11/迭代371,项目1/迭代451,项目11/迭代461,项目1/迭代541,项目11/迭代551');   // 测试获取产品1的执行信息
r($product->getAllExecutionPairsByProductTest($productIDList[1])) && p('102,112,192,202,282,292,372,382,462,472,552,562,642,652') && e('项目2/迭代2,项目12/迭代12,项目2/迭代92,项目12/迭代102,项目2/迭代182,项目12/迭代192,项目2/迭代272,项目12/迭代282,项目2/迭代362,项目12/迭代372,项目2/迭代452,项目12/迭代462,项目2/迭代542,项目12/迭代552');   // 测试获取产品2的执行信息
r($product->getAllExecutionPairsByProductTest($productIDList[2])) && p('103,113,193,203,283,293,373,383,463,473,553,563,643,653') && e('项目3/迭代3,项目13/迭代13,项目3/迭代93,项目13/迭代103,项目3/迭代183,项目13/迭代193,项目3/迭代273,项目13/迭代283,项目3/迭代363,项目13/迭代373,项目3/迭代453,项目13/迭代463,项目3/迭代543,项目13/迭代553');   // 测试获取产品3的执行信息
r($product->getAllExecutionPairsByProductTest($productIDList[3])) && p('104,114,194,204,284,294,374,384,464,474,554,564,644,654') && e('项目4/迭代4,项目14/迭代14,项目4/迭代94,项目14/迭代104,项目4/迭代184,项目14/迭代194,项目4/迭代274,项目14/迭代284,项目4/迭代364,项目14/迭代374,项目4/迭代454,项目14/迭代464,项目4/迭代544,项目14/迭代554');   // 测试获取产品4的执行信息
r($product->getAllExecutionPairsByProductTest($productIDList[4])) && p('105,115,195,205,285,295,375,385,465,475,555,565,645,655') && e('项目5/迭代5,项目15/迭代15,项目5/迭代95,项目15/迭代105,项目5/迭代185,项目15/迭代195,项目5/迭代275,项目15/迭代285,项目5/迭代365,项目15/迭代375,项目5/迭代455,项目15/迭代465,项目5/迭代545,项目15/迭代555');   // 测试获取产品5的执行信息
r($product->getAllExecutionPairsByProductTest($productIDList[5])) && p('0:')                                                      && e('');   // 测试获取不存在产品的执行信息