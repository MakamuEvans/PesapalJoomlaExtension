<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
class DonateTableDonate extends JTable{
    function __construct(&$db)
    {
        parent::__construct('#__donate', 'id', $db);
    }
}