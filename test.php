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

$currentTime = (string)microtime();
$dateString = date('Ymd', substr($currentTime, 11, 20));


$timestamp1 = (int)(substr($currentTime, 11, 20) - (3600 * 24));
$timestamp2 = (int)substr($currentTime, 11, 20);

$dateString1 = date('Ymd', $timestamp1) . '000000';
$dateString2 = date('Ymd', $timestamp2) . '235959';

echo $dateString1 . "\r\n";
echo $dateString2;