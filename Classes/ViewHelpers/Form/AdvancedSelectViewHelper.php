<?php 
class Tx_Cmp3Demo_ViewHelpers_Form_AdvancedSelectViewHelper extends Tx_Fluid_ViewHelpers_Form_SelectViewHelper
{
	public function initializeArguments() {
		parent::initializeArguments();
		$this->registerArgument('defaultOption', 'string', 'value to prepend', FALSE);
	}
	
	protected function getOptions() {
		if ($this->arguments['defaultOption']) {
			return array("" => $this->arguments['defaultOption']) + parent::getOptions();
		} else {
 			return parent::getOptions();
		}
	}
}