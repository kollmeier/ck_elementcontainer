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


/**
 * Namespace
 */
namespace CK;


/**
 * Class CKElementContainerCallbacks
 *
 * @copyright  2014
 * @author     Carsten Kollmeier
 * @package    Devtools
 */
class ElementContainerCallbacks extends \Backend
{

	/**
	 * Stores the configuration array without the given element
	 * @param int
	 */
	protected function store_configuration_without($without)
	{
		$objElement = $this->Database->prepare("SELECT id,category,module,content FROM tl_ckelementcontainer WHERE invisible!=1 ORDER BY title")
		->execute();
		$arrModuleConfig = array();
		$arrContentConfig = array();
		while ($objElement->next())
		{
			if ($objElement->id != $without)
			{
				if ($objElement->module)
				{
					$arrModuleConfig[$objElement->category][] = $objElement->id;
				}
				if ($objElement->content)
				{
					$arrContentConfig[$objElement->category][] = $objElement->id;
				}
			}
		}

		$this->Config->update("\$GLOBALS['TL_CONFIG']['ck_ec_content']", serialize($arrContentConfig));
		$this->Config->update("\$GLOBALS['TL_CONFIG']['ck_ec_modules']", serialize($arrModuleConfig));
	}

	/**
	 * Stores the configuration array
	 */
	protected function store_configuration()
	{
		$this->store_configuration_without(-1);
	}


	/**
	 * Stores the generated Elements in Configuration
	 */
	public function element_onsubmit(\DataContainer $dc)
	{
		$this->import("Database");
		$this->store_configuration();
	}

	/**
	 * Deletes Elements from Configuration, Contentelements and Modules
	 */

	public function element_ondelete(\DataContainer $dc)
	{
		$this->import("Database");

		// Delete from Contentelements
		$this->Database->prepare("DELETE FROM tl_content WHERE type=?")
		->execute(CK_EC_PREFIX.$dc->id);
		// Delete from Modules
		$this->Database->prepare("DELETE FROM tl_module WHERE type=?")
		->execute(CK_EC_PREFIX.$dc->id);

		// Delete from Configuration
		$this->store_configuration_without($dc->id);
	}

}
