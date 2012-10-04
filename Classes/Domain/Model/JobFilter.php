<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jagodzinski
 * Date: 21.09.12
 * Time: 10:44
 * To change this template use File | Settings | File Templates.
 */
class Tx_Cmp3Demo_Domain_Model_JobFilter extends Tx_Extbase_DomainObject_AbstractEntity {
	/**
	 * jobs
	 *
	 * @var array
	 **/
	protected $jobs = array(
		'ttNewsFOP' => 'News to PDF using FOP',
		'simpleXSL' => 'XML file from file source with xslt processing',
		'Html2Pdf' => 'HTML file to PDF (mpdf)',
		'Html2PdfProcessing' => 'HTML file to PDF with processing (wkhtmltopdf)',
		'Docbook2Icml' => 'Docbook XML File to ICML',
		'SimpleFOP' => 'XML File to PDF using FOP',
		'Rich2FOP' => 'HTML richtext to PDF using FOP',
		'PdfMerge' => 'Merging two PDF with composer',
		'PdfImpose' => 'Impose two A4 PDF on A3 with composer'
	);

	/**
	 * selected Job
	 *
	 * @var string
	 */
	protected $selectedJob = '';


	/**
	 * Log
	 *
	 * @var string
	 */
	protected $log = '';

	/**
	 * Setup
	 *
	 * @var string
	 */
	protected $setup = '';

	/**
	 * Result
	 *
	 * @var string
	 */
	protected $result = '';

	/**
	 * downloadUrl
	 *
	 * @var string
	 */
	protected $downloadUrl = '';




	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
	}

	/**
	 * Initializes all Tx_Extbase_Persistence_ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$persistenceManager = t3lib_div::makeInstance('Tx_Extbase_Persistence_Manager');
		/* @var $persistenceManager Tx_Extbase_Persistence_Manager */
		$persistenceManager->persistAll();
	}

	/**
	 * @param array $jobs
	 */
	public function setJobs($jobs)
	{
		$this->jobs = $jobs;
	}

	/**
	 * @return array
	 */
	public function getJobs()
	{
		return $this->jobs;
	}

	/**
	 * @param string $selectedJob
	 */
	public function setSelectedJob($selectedJob)
	{
		$this->selectedJob = $selectedJob;
	}

	/**
	 * @return string
	 */
	public function getSelectedJob()
	{
		return $this->selectedJob;
	}

	/**
	 * makes array
	 *
	 * @return array
	 */
	public function toArray() {
		$arrayToReturn = array();

		$arrayToReturn['jobs'] = $this->getJobs();
		$arrayToReturn['selectedJob'] = $this->selectedJob;
		$arrayToReturn['log'] = $this->log;
		$arrayToReturn['setup'] = $this->setup;
		$arrayToReturn['result'] = $this->result;
		$arrayToReturn['downloadUrl'] = $this->downloadUrl;

		return $arrayToReturn;
	}

	/**
	 * @param string $log
	 */
	public function setLog($log)
	{
		$this->log = $log;
	}

	/**
	 * @return string
	 */
	public function getLog()
	{
		return $this->log;
	}

	/**
	 * @param string $setup
	 */
	public function setSetup($setup)
	{
		$this->setup = $setup;
	}

	/**
	 * @return string
	 */
	public function getSetup()
	{
		return $this->setup;
	}

	/**
	 * @param string $result
	 */
	public function setResult($result)
	{
		$this->result = $result;
	}

	/**
	 * @return string
	 */
	public function getResult()
	{
		return $this->result;
	}

	/**
	 * @param string $downloadUrl
	 */
	public function setDownloadUrl($downloadUrl)
	{
		$this->downloadUrl = $downloadUrl;
	}

	/**
	 * @return string
	 */
	public function getDownloadUrl()
	{
		return $this->downloadUrl;
	}
}
