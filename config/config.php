<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package   CKElementContainer
 * @author    Carsten Kollmeier
 * @license   LGPL
 * @copyright 2014
 */


// Prefix
define('CK_EC_PREFIX','ck_ec_');

// Backend module definition
array_insert($GLOBALS['BE_MOD']['design'], 1, array
	(
		'ck_ec' => array
		(
			'tables' => array('tl_ckelementcontainer','tl_ckelementcontainer_fields'),
			'icon'       => 'system/modules/ck_elementcontainer/assets/icons/icon.png',
			'stylesheet'   => 'system/modules/ck_elementcontainer/assets/use_combobox.css',
			'javascript'   => 'system/modules/ck_elementcontainer/assets/use_combobox.js'
		)
	));

// include the localconfig since Contao 3
include TL_ROOT . '/system/config/localconfig.php';

// Get defined frontend modules from configuration
if ($GLOBALS['TL_CONFIG']['ck_ec_modules'])
{
	$arrModules = unserialize($GLOBALS['TL_CONFIG']['ck_ec_modules']);
} else
{
	$arrModules = array();
}

// Get defined Contentelements from configuration
if ($GLOBALS['TL_CONFIG']['ck_ec_content'])
{
	$arrContent = unserialize($GLOBALS['TL_CONFIG']['ck_ec_content']);
} else
{
	$arrContent = array();
}

// Include modules in list
foreach ($arrModules as $strCategory => $arrElements)
{
	foreach ($arrElements as $strElement) {
		$GLOBALS['FE_MOD'][$strCategory][CK_EC_PREFIX.$strElement]= 'CKElementContainerModule';
	}
}

// Include Contentelements in list
foreach ($arrContent as $strCategory => $arrElements)
{
	foreach ($arrElements as $strElement) {
		$GLOBALS['TL_CTE'][$strCategory][CK_EC_PREFIX.$strElement]= 'CKElementContainerContent';
	}
}

// Hooks
//if(version_compare(VERSION.BUILD, '3.10','>=') && version_compare(VERSION.BUILD, '3.20','<')) {
//	$GLOBALS['TL_HOOKS']['executePostActions'][] = array('CKElementContainer','fixedAjaxRequest');
//}



?>
