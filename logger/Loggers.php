<?php

/**
 * Created by PhpStorm.
 * User: Hi_old
 * Date: 2018/11/20
 * Time: 13:40
 */
class Loggers
{
    /**
     * @param string $func
     * @param string $message
     */
    public static function addlogtoFile($func, $message)
    {
        $logfilePath = __DIR__ . '/logger' . -date('Ymd') . '.log';
        $fileobj = @fopen($logfilePath, "a");
        date_default_timezone_set("Asia/Shanghai");
        if (!$fileobj) {
            echo "没有当天日志文件-->创建一个日志文件";
            fopen($logfilePath, "w");
        } else {
            fwrite($fileobj, date("Y-m-d H:i:s:u") . ":-->" . $func . "-->" . json_encode($message));
            fwrite($fileobj, "\r\n");
        }
    }

}