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
	'CK',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'CK\ElementContainer'          => 'system/modules/ck_elementcontainer/classes/ElementContainer.php',
	'CK\ElementContainerCallbacks' => 'system/modules/ck_elementcontainer/classes/ElementContainerCallbacks.php',
	'CK\ElementContainerContent'   => 'system/modules/ck_elementcontainer/classes/ElementContainerContent.php',
	'CK\ElementContainerModule'    => 'system/modules/ck_elementcontainer/classes/ElementContainerModule.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_dma_ec'  => 'system/modules/ck_elementcontainer/templates',
	'mod_dma_ec' => 'system/modules/ck_elementcontainer/templates',
));
