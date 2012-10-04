<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	Tx_Extbase_Utility_Extension::registerModule(
		$_EXTKEY,
		'txcmp3M1',	 // Make module a submodule of 'tools'
		'txcmp3demoM1',	// Submodule key
		'',						// Position
		array(
			'Bemod' => 'index, selectJob',

		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/moduleicon.png',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_demo.xml',
		)
	);

}


?>