<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
defined('_JEXEC') or die('Restricted access');

class DonateViewDonate extends JViewLegacy{
    function display($tpl = null)
    {
        $app = JFactory::getApplication();
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        /*$context = "donate.list.admin.donate";
        $this->state = $this->get('state');
        $this->filter_order = $app->getUserStateFromRequest($context.'filter_order', 'filter_order', 'id', 'cmd');
        $this->filter_order_Dir = $app->getUserStateFromRequest($context.'filter_order_Dir', 'filter_order_Dir', 'asc', 'cmd');
        $this->filterForm    	= $this->get('FilterForm');
        $this->activeFilters 	= $this->get('ActiveFilters');*/
        if (count($errors = $this->get('Errors')))
        {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        $this->addToolbar();
        return parent::display($tpl); // TODO: Change the autogenerated stub
    }

    protected function addToolbar(){
        JToolbarHelper::title(JText::_('Donation Component'));
        JToolbarHelper::preferences('com_donate');
    }
    protected function setDocument()
    {
        $document = JFactory::getDocument();
        $document->setTitle(JText::_('COM_HELLOWORLD_ADMINISTRATION'));
    }
}