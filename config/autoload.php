<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Ck_elementcontainer
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'CKElementContainer',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'CKElementContainer\CKElementContainer'          => 'system/modules/ck_elementcontainer/classes/CKElementContainer.php',
	'CKElementContainer\CKElementContainerCallbacks' => 'system/modules/ck_elementcontainer/classes/CKElementContainerCallbacks.php',
	'CKElementContainer\CKElementContainerContent'   => 'system/modules/ck_elementcontainer/classes/CKElementContainerContent.php',
	'CKElementContainer\CKElementContainerModule'    => 'system/modules/ck_elementcontainer/classes/CKElementContainerModule.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_dma_ec'  => 'system/modules/ck_elementcontainer/templates',
	'mod_dma_ec' => 'system/modules/ck_elementcontainer/templates',
));
