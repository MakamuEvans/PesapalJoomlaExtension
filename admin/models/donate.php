<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
class DonateModelDonate extends JModelList{
    protected function getListQuery()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*')->from($db->quoteName('#__donation'));

        return $query;
        //return parent::getListQuery(); // TODO: Change the autogenerated stub
    }
}