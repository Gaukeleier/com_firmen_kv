<?php
/**
 * @version     1.0.0
 * @package     com_firmen
 * @copyright   Copyright (C) 2013. Alle Rechte vorbehalten.
 * @license     GNU General Public License version 2 oder später; siehe LICENSE.txt
 * @author      Gaukeleier <gaukeleier@gmail.com> - http://
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View class for a list of Firmen.
 */
class FirmenViewFirmens extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->state		= $this->get('State');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			throw new Exception(implode("\n", $errors));
		}
        
		FirmenHelper::addSubmenu('firmens');
        
		$this->addToolbar();
        
        $this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		require_once JPATH_COMPONENT.'/helpers/firmen.php';

		$state	= $this->get('State');
		$canDo	= FirmenHelper::getActions($state->get('filter.category_id'));

		JToolBarHelper::title(JText::_('COM_FIRMEN_TITLE_FIRMENS'), 'firmens.png');

        //Check if the form exists before showing the add/edit buttons
        $formPath = JPATH_COMPONENT_ADMINISTRATOR.'/views/firmen';
        if (file_exists($formPath)) {

            if ($canDo->get('core.create')) {
			    JToolBarHelper::addNew('firmen.add','JTOOLBAR_NEW');
		    }

		    if ($canDo->get('core.edit') && isset($this->items[0])) {
			    JToolBarHelper::editList('firmen.edit','JTOOLBAR_EDIT');
		    }

        }

		if ($canDo->get('core.edit.state')) {

            if (isset($this->items[0]->state)) {
			    JToolBarHelper::divider();
			    JToolBarHelper::custom('firmens.publish', 'publish.png', 'publish_f2.png','JTOOLBAR_PUBLISH', true);
			    JToolBarHelper::custom('firmens.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
            } else if (isset($this->items[0])) {
                //If this component does not use state then show a direct delete button as we can not trash
                JToolBarHelper::deleteList('', 'firmens.delete','JTOOLBAR_DELETE');
            }

            if (isset($this->items[0]->state)) {
			    JToolBarHelper::divider();
			    JToolBarHelper::archiveList('firmens.archive','JTOOLBAR_ARCHIVE');
            }
            if (isset($this->items[0]->checked_out)) {
            	JToolBarHelper::custom('firmens.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
            }
		}
        
        //Show trash and delete for components that uses the state field
        if (isset($this->items[0]->state)) {
		    if ($state->get('filter.state') == -2 && $canDo->get('core.delete')) {
			    JToolBarHelper::deleteList('', 'firmens.delete','JTOOLBAR_EMPTY_TRASH');
			    JToolBarHelper::divider();
		    } else if ($canDo->get('core.edit.state')) {
			    JToolBarHelper::trash('firmens.trash','JTOOLBAR_TRASH');
			    JToolBarHelper::divider();
		    }
        }

		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_firmen');
		}
        
        //Set sidebar action - New in 3.0
		JHtmlSidebar::setAction('index.php?option=com_firmen&view=firmens');
        
        $this->extra_sidebar = '';
        
        
	}
    
	protected function getSortFields()
	{
		return array(
		'a.adresseid' => JText::_('COM_FIRMEN_FIRMENS_ADRESSEID'),
		'a.anrede' => JText::_('COM_FIRMEN_FIRMENS_ANREDE'),
		'a.firma' => JText::_('COM_FIRMEN_FIRMENS_FIRMA'),
		'a.vorname' => JText::_('COM_FIRMEN_FIRMENS_VORNAME'),
		'a.nachname' => JText::_('COM_FIRMEN_FIRMENS_NACHNAME'),
		'a.strasse' => JText::_('COM_FIRMEN_FIRMENS_STRASSE'),
		'a.nr' => JText::_('COM_FIRMEN_FIRMENS_NR'),
		'a.land' => JText::_('COM_FIRMEN_FIRMENS_LAND'),
		'a.plz' => JText::_('COM_FIRMEN_FIRMENS_PLZ'),
		'a.ort' => JText::_('COM_FIRMEN_FIRMENS_ORT'),
		'a.tel' => JText::_('COM_FIRMEN_FIRMENS_TEL'),
		'a.fax' => JText::_('COM_FIRMEN_FIRMENS_FAX'),
		'a.email' => JText::_('COM_FIRMEN_FIRMENS_EMAIL'),
		'a.mobil' => JText::_('COM_FIRMEN_FIRMENS_MOBIL'),
		'a.auftragid' => JText::_('COM_FIRMEN_FIRMENS_AUFTRAGID'),
		'a.kategorieid' => JText::_('COM_FIRMEN_FIRMENS_KATEGORIEID'),
		'a.geb' => JText::_('COM_FIRMEN_FIRMENS_GEB'),
		'a.gebrem' => JText::_('COM_FIRMEN_FIRMENS_GEBREM'),
		'a.gebremmail' => JText::_('COM_FIRMEN_FIRMENS_GEBREMMAIL'),
		'a.type' => JText::_('COM_FIRMEN_FIRMENS_TYPE'),
		'a.bemerkung' => JText::_('COM_FIRMEN_FIRMENS_BEMERKUNG'),
		'a.adressespracheid' => JText::_('COM_FIRMEN_FIRMENS_ADRESSESPRACHEID'),
		'a.homepage' => JText::_('COM_FIRMEN_FIRMENS_HOMEPAGE'),
		'a.vsgkundentyp' => JText::_('COM_FIRMEN_FIRMENS_VSGKUNDENTYP'),
		'a.exporttoldap' => JText::_('COM_FIRMEN_FIRMENS_EXPORTTOLDAP'),
		'a.zusatz1' => JText::_('COM_FIRMEN_FIRMENS_ZUSATZ1'),
		'a.position' => JText::_('COM_FIRMEN_FIRMENS_POSITION'),
		'a.lastchange' => JText::_('COM_FIRMEN_FIRMENS_LASTCHANGE'),
		'a.bezirk' => JText::_('COM_FIRMEN_FIRMENS_BEZIRK'),
		'a.emailinvalid' => JText::_('COM_FIRMEN_FIRMENS_EMAILINVALID'),
		'a.titelprefix' => JText::_('COM_FIRMEN_FIRMENS_TITELPREFIX'),
		'a.titelsuffix' => JText::_('COM_FIRMEN_FIRMENS_TITELSUFFIX'),
		'a.abteilung' => JText::_('COM_FIRMEN_FIRMENS_ABTEILUNG'),
		'a.kundennummer' => JText::_('COM_FIRMEN_FIRMENS_KUNDENNUMMER'),
		'a.as_praesentation' => JText::_('COM_FIRMEN_FIRMENS_AS_PRAESENTATION'),
		'a.breite' => JText::_('COM_FIRMEN_FIRMENS_BREITE'),
		'a.laenge' => JText::_('COM_FIRMEN_FIRMENS_LAENGE'),
		);
	}

    
}
