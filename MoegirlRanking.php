<?php
/**
 * Created by PhpStorm.
 * User: Hi_old
 * Date: 2018/11/20
 * Time: 14:01
 */
$wgExtensionCredits['parserhook'][] = array(
    'path' => __FILE__,
    'name' => 'MoegirlRanking',
    'author' => 'Hi_old',
    'url' => '#',
    'description' => '自动记录首页以外的，文章点击次数并排名',
    'version' => 1.0,
    'license-name' => 'Apache-2.0+'
);

//页面访问完毕Hook
$wgHooks ['BeforePageDisplay'][] = 'MoegirlRankingHandlerHook::onBeforePageDisplay';
//升级数据库Hook
$wgHooks['LoadExtensionSchemaUpdates'][] = 'MoegirlRankingHandlerHook::addDatabases';
$wgHooks['ParserFirstCallInit'][] = 'ExampleExtension::onParserFirstCallInit';

$wgAutoloadClasses['MoegirlRankingHandlerHook'] = __DIR__ . '/MoegirlRankingHandlerHook.php';
$wgAutoloadClasses['MGRankingAPI'] = __DIR__ . '/api/MGRankingAPI.php';
$wgAutoloadClasses['ExampleExtension'] = __DIR__ . '/includes/parserfunctions/MoegirlRanking.php';
$wgAPIModules['MGRankingAPI'] = 'MGRankingAPI';


return true;