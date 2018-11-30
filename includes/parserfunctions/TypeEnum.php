<?php
/**
 * Created by PhpStorm.
 * User: Hi_old
 * Date: 2018/11/26
 * Time: 16:25
 */

final class TypeEnum
{
    public static $MOERANK_RANKTYPE_RANKALL = "rankall";//排序所有
    public static $MOERANK_RANKTYPE_RANKTIMESE = "ranktimese";//根据起始时间排序
    public static $MOERANK_RANKTYPE_RANKTIMEDAY = "ranktimeday";//根据日期排序,1天3天7天,或者其他自定义

    //数据呈现形式
    public static $MOERANK_DATATYPE_DEFAULT = 'default';//默认格式
    public static $MOERANK_DATATYPE_DEFAULT_SINGLE = 'default_single';//默认单条
    public static $MOERANK_DATATYPE_DEFAULT_SINGLE_FIELD = 'default_single_field';//默认单条

    //属性
    public static $MOERANK_FIELD_WIKI_TITLE = 'title';//仅标题
    public static $MOERANK_FIELD_WIKI_URL = 'url';//仅URL
    public static $MOERANK_FIELD_WIKI_RANK = 'cts';//仅访问量

}