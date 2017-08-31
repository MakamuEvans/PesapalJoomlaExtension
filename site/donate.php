<?php
/**
 * Created by PhpStorm.
 * User: elm
 * Date: 8/31/17
 * Time: 10:43 AM
 */
defined('_JEXEC') or die('Restricted access');

$controller = JControllerLegacy::getInstance('Donate');
$controller->execute(JFactory::getApplication()->input->get('task'));

$controller->redirect();