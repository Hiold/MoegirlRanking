<?php
/**
 * Created by PhpStorm.
 * User: Hi_old
 * Date: 2018/11/21
 * Time: 17:31
 */

require_once("Loggerss.php");

class MGRankingAPI extends ApiBase
{
//    private $logger;
    protected $service;

    public function __construct(ApiMain $mainModule, $moduleName, $modulePrefix = '')
    {
        parent::__construct($mainModule, $moduleName, $modulePrefix);
//        $this->logger = new MRLogging(__FILE__);
        $this->service = new RankAroundService();
    }


    public function execute()
    {

        $start = (int)$this->getMain()->getVal('start');
        $limit = $this->getMain()->getVal('limit');
        $ranktype = $this->getMain()->getVal('ranktype');
        Loggerss::addlogtoFile("insertsql", $ranktype . $start . $limit);
        if ($ranktype == "rankall") {
            Loggerss::addlogtoFile("rankall", $ranktype);
            $result = $this->service->getAllrank($start, $limit);
            if ($result) {
                $this->getResult()->addValue(null, $this->getModuleName(), array(
                    'isSuccess' => 1,
                    'message' => json_encode($result)
                ));
            } else {
                $this->getResult()->addValue(null, $this->getModuleName(), array(
                    'isSuccess' => 0,
                    'message' => ''
                ));
            }
        } else if ($ranktype == "ranktime") {
            Loggerss::addlogtoFile("ranktime", $ranktype);
            $result = $this->service->getRankByCreationTime($start, $limit);
            if ($result) {
                $this->getResult()->addValue(null, $this->getModuleName(), array(
                    'isSuccess' => 1,
                    'message' => json_encode($result)
                ));
            } else {
                $this->getResult()->addValue(null, $this->getModuleName(), array(
                    'isSuccess' => 0,
                    'message' => ''
                ));
            }
        } else {
            $this->getResult()->addValue(null, $this->getModuleName(), array(
                'isSuccess' => 0,
                'message' => 'ERROR! please check params'
            ));
        }


        return true;

    }

    public function getDescription()
    {
    }

    public function getAllowedParams()
    {
        return array(
            'ranktype' => array(
                ApiBase::PARAM_TYPE => 'string',
                ApiBase::PARAM_REQUIRED => true,
                ApiBase::PARAM_HELP_MSG => 'Rank type'
            ),
            'start' => array(
                ApiBase::PARAM_TYPE => 'string',
                ApiBase::PARAM_REQUIRED => true
            ),
            'limit' => array(
                ApiBase::PARAM_TYPE => 'string',
                ApiBase::PARAM_REQUIRED => true)
        );
    }

    public function getExample()
    {
    }

}
