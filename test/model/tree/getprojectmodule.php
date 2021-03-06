#!/usr/bin/env php
<?php
include dirname(dirname(dirname(__FILE__))) . '/lib/init.php';
include dirname(dirname(dirname(__FILE__))) . '/class/tree.class.php';
su('admin');

/**

title=测试 treeModel->getProjectModule();
cid=1
pid=1

测试获取项目模块 1 >> ,1821,2621,2622,1822,1823,1824,2221,2821,2822,2222,2223,2224
测试获取项目模块 2 >> ,1825,2623,2624,1826,1827,1828,2225,2823,2824,2226,2227,2228
测试获取项目模块 3 >> ,1829,2625,2626,1830,1831,1832,2229,2825,2826,2230,2231,2232
测试获取项目模块 4 >> ,1833,2627,2628,1834,1835,1836,2233,2827,2828,2234,2235,2236
测试获取项目模块 5 >> ,1837,2629,2630,1838,1839,1840,2237,2829,2830,2238,2239,2240
测试获取项目模块 6 >> ,1841,2631,2632,1842,1843,1844,2241,2831,2832,2242,2243,2244

*/
$projectID = 1;
$productID = array(1, 2, 3, 4, 5, 6);

$tree = new treeTest();

r($tree->getProjectModuleTest($projectID, $productID[0])) && p() && e(',1821,2621,2622,1822,1823,1824,2221,2821,2822,2222,2223,2224'); // 测试获取项目模块 1
r($tree->getProjectModuleTest($projectID, $productID[1])) && p() && e(',1825,2623,2624,1826,1827,1828,2225,2823,2824,2226,2227,2228'); // 测试获取项目模块 2
r($tree->getProjectModuleTest($projectID, $productID[2])) && p() && e(',1829,2625,2626,1830,1831,1832,2229,2825,2826,2230,2231,2232'); // 测试获取项目模块 3
r($tree->getProjectModuleTest($projectID, $productID[3])) && p() && e(',1833,2627,2628,1834,1835,1836,2233,2827,2828,2234,2235,2236'); // 测试获取项目模块 4
r($tree->getProjectModuleTest($projectID, $productID[4])) && p() && e(',1837,2629,2630,1838,1839,1840,2237,2829,2830,2238,2239,2240'); // 测试获取项目模块 5
r($tree->getProjectModuleTest($projectID, $productID[5])) && p() && e(',1841,2631,2632,1842,1843,1844,2241,2831,2832,2242,2243,2244'); // 测试获取项目模块 6