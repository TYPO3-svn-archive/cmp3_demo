<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jagodzinski
 * Date: 21.09.12
 * Time: 09:52
 * To change this template use File | Settings | File Templates.
 */
class Tx_Cmp3Demo_Controller_BemodController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @param Tx_Cmp3Demo_Domain_Model_JobFilter $jobFilter
	 * @ignorevalidation $jobFilter
	 */
	public function indexAction(Tx_Cmp3Demo_Domain_Model_JobFilter $jobFilter = NULL) {
		/* @var $jobFilter Tx_Cmp3Demo_Domain_Model_JobFilter*/
		if (!$jobFilter) {
			$jobFilter = $this->objectManager->get('Tx_Cmp3Demo_Domain_Model_JobFilter');
		}

		if ($jobFilter->getSelectedJob()) {
			$this->GenerateJobAction($jobFilter);
		}


		$this->view->assign('jobFilter', $jobFilter->toArray());
	}

	/**
	 * @param Tx_Cmp3Demo_Domain_Model_JobFilter $jobFilter
	 * @ignorevalidation $jobFilter
	 */
	protected function GenerateJobAction(Tx_Cmp3Demo_Domain_Model_JobFilter $jobFilter = NULL)
	{
		$strJobName = $jobFilter->getSelectedJob();

		$filepath = t3lib_extMgm::extPath('cmp3_demo') . 'Configuration/Setup/' . $strJobName . '.txt';

		$tsConfString = file_get_contents($filepath);

		$configArray = \Cmp3\Config\TypoScriptParser::ParseAsArray($tsConfString);
		$objConfig = new \Cmp3\Config\TypoScriptArray($configArray);


		$objResult = $this->RenderJob($strJobName, $objConfig);

		if ($objResult->hasErrors) {
			$this->view->assign('error', TRUE);
		}


		$jobFilter->setLog($objResult->Log);
		$jobFilter->setSetup(trim($tsConfString));

		$objContent = $objResult->Content;

		if (!$objResult->hasErrors) {
			if ($objContent->Type == \Cmp3\Content\ContentType::PDF) {
				$objFile = $objContent->File->Copy(t3lib_extMgm::extPath('cmp3_demo') . 'output/result.pdf');
				$objFile->SetDeleteOnDestruct(false);
			} else {
				$strXml = (string)$objContent->GetData();
				file_put_contents(t3lib_extMgm::extPath('cmp3_demo') . 'output/result.txt', $strXml);

				$jobFilter->setResult($strXml);
			}

			$objContent->File->SetDeleteOnDestruct(false);
			$jobFilter->setDownloadUrl($objContent->File->GetDownloadURL());
		}
	}

	/**
	 * Job rendering
	 *
	 * @param string Job name
	 * @param \tx_next_Config_Interface cmp3 configuration
	 * @return \Cmp3\Job\Result
	 */
	public function RenderJob($strJob, $objConfig)
	{
		$objQueue = new \Cmp3\Job\Queue;

		$objJob = $objQueue->CreateJob($strJob, $objConfig);

		$objQueue->RunJob($objJob);

		while (!$objQueue->isJobFinished($objJob)) {
			sleep(1);
		}

		$objResult = $objQueue->GetResult($objJob);

		return $objResult;
	}

	/**
	 * @param Tx_Cmp3Demo_Domain_Model_JobFilter $jobFilter
	 * @ignorevalidation $jobFilter
	 */
	public function downloadAction(Tx_Cmp3Demo_Domain_Model_JobFilter $jobFilter = NULL) {
		/* @var $jobFilter Tx_Cmp3Demo_Domain_Model_JobFilter*/
		if (!$jobFilter) {
			$jobFilter = $this->objectManager->get('Tx_Cmp3Demo_Domain_Model_JobFilter');
		}




		$this->view->assign('jobFilter', $jobFilter->toArray());
	}



}