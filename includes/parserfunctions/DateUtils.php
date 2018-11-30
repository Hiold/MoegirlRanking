<?php
/**
 * Created by PhpStorm.
 * User: Hi_old
 * Date: 2018/11/27
 * Time: 11:27
 */

class DateUtils
{
    /**
     * 根据近期日期获取数据库对应的日期字符串
     * @param $dt
     * @return array
     */
    public static function getDateArray($dt)
    {
        $currentTime = (string)microtime();
        $timestamp1 = (int)(substr($currentTime, 11, 20) - (3600 * 24 * $dt));
        $timestamp2 = (int)substr($currentTime, 11, 20);
        $dateString1 = date('Ymd', $timestamp1) . '000000';
        $dateString2 = date('Ymd', $timestamp2) . '235959';
        $result = [$dateString1, $dateString2];
        return $result;
    }

}