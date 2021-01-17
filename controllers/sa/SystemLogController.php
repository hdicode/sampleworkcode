<?php

namespace app\controllers\sa;
use app\extensions\XController;
use app\models\Sa;
use Yii;

class SystemLogController extends XController
{
	public function actionIndex()
	{
		$this->layout = 'basic/saLayout';
		$this->setBreadcrumb('System Log');
		
		$systemLog = new Sa();
		$systemLog->setDb( $this->db );
		$systemLog->ownerId = $this->getSession('OWNER_ID');
		$accessType = $systemLog->getAccessType();

		$officeUtc = '+' . $systemLog->getServerUTC();

		date_default_timezone_set("Asia/Bangkok");
		$currentDate = date('Ymd');

		$systemLog = new Sa();
		$systemLog->setDb($this->db);
		$systemLog->limit = 10;
		$systemLog->offset = 0;
		$systemLog->ownerId = $this->getSession('OWNER_ID');
		$systemLog->dateFrom = $currentDate;
		$systemLog->dateTo = $currentDate;
		$systemLog->timeFrom = '00:00';
		$systemLog->timeTo = '23:59';
		$systemLog->from = $systemLog->dateFrom.$systemLog->timeFrom;
		$systemLog->to = $systemLog->dateTo.$systemLog->timeTo;
		
		$systemLog->scenario = 'search-log';
		$systemLog = $this->jsonEncode($systemLog->searchSystemLog());

		return $this->render('system-log', 
		[
			'accessType' => json_encode($accessType),
			'officeUtc' => $officeUtc,
			'systemLogData' => $systemLog
		]);
	}
	
	public function actionSearchSystemLog()
	{
		$systemLog = new Sa();
		$systemLog->setDb($this->db);
		$this->setPaginationParam($systemLog);
		$systemLog->ownerId = $this->getSession('OWNER_ID');
		$systemLog->searchType = $this->getParam('searchType');
		$systemLog->accessType = $this->getParam('accessType');
		$systemLog->user = "%". $this->getParam('user') . "%";
		$systemLog->accessFrom = $this->getParam('accessFrom');
		$systemLog->dateFrom = $this->getParam('dateFrom');
		$systemLog->dateTo = $this->getParam('dateTo');
		$systemLog->timeFrom = $this->getParam('timeFrom');
		$systemLog->timeTo = $this->getParam('timeTo');
		$systemLog->from = $systemLog->dateFrom . $systemLog->timeFrom;
		$systemLog->to = $systemLog->dateTo . $systemLog->timeTo;
		
		$systemLog->scenario = 'search-log';
		
		if($systemLog->validate())
		{
			$result = $this->jsonEncode($systemLog->searchSystemLog());

			return $result;
		}
		else
		{
			return $this->jsonEncodeRules($systemLog->errors);
		}
	}
}