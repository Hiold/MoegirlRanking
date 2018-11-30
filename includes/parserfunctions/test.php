<?php
/**
 * Created by PhpStorm.
 * User: Hi_old
 * Date: 2018/11/20
 * Time: 13:53
 */
//require_once (__DIR__."/logger/Loggers.php");
//for ($i = 0; $i < 100; $i++) {
//    Loggerss::addlogtoFile("testModuel", "测试消息");
//}
require_once("DateUtils.php");

$g = DateUtils::getDateArray(1);
echo $g[0];
echo $g[1];