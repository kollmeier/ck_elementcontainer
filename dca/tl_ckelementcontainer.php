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
 * Table tl_ckelementcontainer
 */
$GLOBALS['TL_DCA']['tl_ckelementcontainer'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'onsubmit_callback'	=> array
		(		
			array('ElementContainerCallbacks','element_onsubmit')
		),
		'ondelete_callback'	=> array
		(
			array('ElementContainerCallbacks','element_ondelete')
		),
		'ctable' => array('tl_ckelementcontainer_elements'),
		'switchToEdit' => true,
		'sql'              => array
				(
					'keys' => array
					(
						'id' => 'primary'
					)
				)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('title'),
			'flag'                    => 1,
			'panelLayout'             => 'filter;search,limit'
		),
		'label' => array
		(
			'fields'                  => array('title'),
			'format'                  => '%s',
            'label_callback'          => array('tl_ckelementcontainer', 'listFormFields')
		),

		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_ckelementcontainer']['edit'],
				'href'                => 'table=tl_ckelementcontainer_elements',
				'icon'                => 'edit.gif',
				'attributes'          => 'class="contextmenu"'
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_ckelementcontainer']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif',
				'attributes'          => 'class="edit-header"'
			),			
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_ckelementcontainer']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_ckelementcontainer']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['tl_ckelementcontainer']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
            'toggle' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_content']['toggle'],
                'icon'                => 'visible.gif',
                'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback'     => array('tl_ckelementcontainer', 'toggleIcon')
            ),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_ckelementcontainer']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array(),
		'default'                     => '{title_legend},title,category;{settings_legend},template,be_template,content,module;{expert_legend:hide},without_label,display_in_divs,class',
	),

	// Subpalettes
	'subpalettes' => array
	(		
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),	
		'invisible' => array
		(
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'title' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_ckelementcontainer']['title'],
			'inputType'					=> 'text',
			'exclude'					=> true,
			'filter'						=> true,
			'eval'						=> array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'						=> "varchar(255) NOT NULL default ''"
		),
		'category' => array
		(
			'label'                 => &$GLOBALS['TL_LANG']['tl_ckelementcontainer']['category'],
			'inputType'             => 'ck_combobox',
			'exclude'				=> true,
			'filter'				=> true,
			'eval'                  => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'options'      			=> array('labelContentelement'=>array_keys($GLOBALS['TL_CTE']),'labelFrontendmodule'=>array_keys($GLOBALS['FE_MOD'])),
			'reference'             => array_merge($GLOBALS['TL_LANG']['MSC'],$GLOBALS['TL_LANG']['CTE'],$GLOBALS['TL_LANG']['FMD'],$GLOBALS['TL_LANG']['tl_ckelementcontainer']),
			'sql'					=> "varchar(255) NOT NULL default ''"
		),
		'module' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_ckelementcontainer']['module'],
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'w50','isBoolean'=> true),
			'sql'					  => "char(1) NOT NULL default ''"
		),
		'content' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_ckelementcontainer']['content'],
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'clr w50','isBoolean'=> true),
			'sql'					  => "char(1) NOT NULL default ''"
		),
		'class' => array
		(
			'label'                 => &$GLOBALS['TL_LANG']['tl_ckelementcontainer']['class'],
			'inputType'             => 'text',
			'exclude'					=> true,
			'filter'						=> true,
			'eval'                  => array('tl_class'=>'w50','maxlength'=>255, 'tl_class'=>'clr'),
			'sql'						=> "varchar(255) NOT NULL default ''"			
		)
	)
);



/**
 * Class tl_ckelementcontainer
 *
 */
class tl_ckelementcontainer extends Backend
{


    /**
     * returns the list output
     * @param array
     * @return string
     */
    public function listFormFields($arrRow)
    {
        return '<div class="cte_type ' . ($arrRow['invisible'] ? 'unpublished' : 'published') . '">'
            . ($arrRow['content'] ? ' ' . $GLOBALS['TL_LANG']['tl_ckelementcontainer']['labelContentelement'] . ' [' . $arrRow['category'] . ']' : '')
            . ($arrRow['module'] ? ' ' . $GLOBALS['TL_LANG']['tl_ckelementcontainer']['labelFrontendmodule'] . ' [' . $arrRow['category'] . ']' : '')
            . '</div>'."\n"
            . '<div class="block">'
            . '<strong>' . $arrRow['title'] . '</strong>' ."\n"
            . '</div>' . "\n";
    }

    /**
     * Return the "toggle visibility" button
     * @param array
     * @param string
     * @param string
     * @param string
     * @param string
     * @param string
     * @return string
     */
    public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
    {
        if (strlen($this->Input->get('tid')))
        {
            $this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 1));
            $this->redirect($this->getReferer());
        }

        // Check permissions AFTER checking the tid, so hacking attempts are logged
        //if (!$this->User->isAdmin && !$this->User->hasAccess('tl_content::invisible', 'alexf'))
        //{
        //    return '';
        //}

        $href .= '&amp;id='.$this->Input->get('id').'&amp;tid='.$row['id'].'&amp;state='.$row['invisible'];

        if ($row['invisible'])
        {
            $icon = 'invisible.gif';
        }

        return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
    }


    /**
     * Toggle the visibility of an element
     * @param integer
     * @param boolean
     */
    public function toggleVisibility($intId, $blnVisible)
    {
        // Check permissions to edit
        $this->Input->setGet('id', $intId);
        $this->Input->setGet('act', 'toggle');

        // The onload_callbacks vary depending on the dynamic parent table (see #4894)
        //if (is_array($GLOBALS['TL_DCA']['tl_content']['config']['onload_callback']))
        //{
        //    foreach ($GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'] as $callback)
        //    {
        //        if (is_array($callback))
        //        {
        //            $this->import($callback[0]);
        //            $this->$callback[0]->$callback[1]($this);
        //        }
        //    }
        //}

        // Check permissions to publish
        //if (!$this->User->isAdmin && !$this->User->hasAccess('tl_content::invisible', 'alexf'))
        //{
        //    $this->log('Not enough permissions to show/hide content element ID "'.$intId.'"', 'tl_content toggleVisibility', TL_ERROR);
        //    $this->redirect('contao/main.php?act=error');
        //}

        $objVersions = new Versions('tl_ckelementcontainer', $intId);
        $objVersions->initialize();


        // Update the database
        $this->Database->prepare("UPDATE tl_ckelementcontainer SET tstamp=". time() .", invisible='" . ($blnVisible ? '' : 1) . "' WHERE id=?")
                       ->execute($intId);

        $objVersions->create();
        $this->log('A new version of record "tl_ckelementcontainer.id='.$intId.'" has been created'.$this->getParentEntries('tl_ckelementcontainer', $intId), 'tl_ckelementcontainer toggleVisibility()', TL_GENERAL);

        // Trigger the onsubmit_callback
        if (is_array($GLOBALS['TL_DCA']['tl_ckelementcontainer']['config']['onsubmit_callback']))
        {
           foreach ($GLOBALS['TL_DCA']['tl_ckelementcontainer']['config']['onsubmit_callback'] as $callback)
            {
                $this->import($callback[0]);
                $this->$callback[0]->$callback[1]($this);
            }
        }

    }
    	
}

?>