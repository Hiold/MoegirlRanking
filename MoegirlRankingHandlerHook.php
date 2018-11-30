<?php
/**
 * Created by PhpStorm.
 * User: Hi_old
 * Date: 2018/11/20
 * Time: 14:30
 */

require_once(__DIR__ . "/logger/Loggers.php");
require_once(__DIR__ . "/includes/dbservice/RankAroundService.php");

final class MoegirlRankingHandlerHook
{
    public static function onBeforePageDisplay(OutputPage &$out, Skin &$skin)
    {
        $pageTitle = $skin->getTitle();
        $output = $skin->getOutput();
        $request = $skin->getRequest();

        //特殊页面不记录访问
        if ($pageTitle->isSpecialPage()//特殊页面
            || $pageTitle->getArticleID() == 0//wikiid为0
            || !$pageTitle->canTalk()//可发言
            || $pageTitle->isTalkPage()//讨论页面
            || method_exists($pageTitle, 'isMainPage') && $pageTitle->isMainPage() // 主页
            || in_array($pageTitle->getNamespace(), array(NS_MEDIAWIKI, NS_TEMPLATE, NS_CATEGORY, NS_FILE, NS_USER))
            || $output->isPrintable()//打印页面
            || $request->getVal('action', 'view') != 'view'//带action参数
        ) {

            return true;
        }

//        Loggerss::addlogtoFile("hooks", $skin->getTitle()->getArticleID());
        $dbobj = new RankAroundService();
        $wiki_id = $skin->getTitle()->getArticleID();
//        try {
        $wiki_version = $skin->getContext()->getWikiPage()->getRevision()->getTextId();

        //匿名访问用户
        if ($skin->getUser()->isAnon()) {
            try {
                $user_id = $skin->getRequest()->getIP();
            } catch (MWException $e) {
                $user_id="unknow";
            }
        } else {
            $user_id = $skin->getUser()->getId();
        }
//        } catch (Exception $exception) {
//        $wiki_version = '-1';
//            Loggerss::addlogtoFile("hooks", $exception->getMessage());
//        }

        $dbobj->insertVisitToDB($wiki_id, $wiki_version, $user_id);

        return true;
    }

    /**
     * 执行默认sql添加表
     * @param DatabaseUpdater $updater
     * @return bool
     */
    public static function addDatabases(DatabaseUpdater $updater)
    {
        $updater->addExtensionUpdate(array('addTable', 'moegirl_ranking_database', __DIR__ . '/sql/moegirl_ranking_database.sql', true));

        return true;
    }
}