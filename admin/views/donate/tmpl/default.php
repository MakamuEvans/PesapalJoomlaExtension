<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
defined('_JEXEC') or die("Restricted access");
?>

<form action="index.php?option=com_helloworld&view=helloworlds" method="post" id="adminForm" name="adminForm">
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th width="1%"><?php echo JText::_('#Num'); ?></th>
            <th width="30%">
                <?php echo JText::_('Client Names') ;?>
            </th>
            <th width="20%">
                <?php echo JText::_('Client Email') ;?>
            </th>
            <th width="10%">
                <?php echo JText::_('Amount Donated'); ?>
            </th>
            <th width="13%">
                <?php echo JText::_('Donation Method'); ?>
            </th>
            <th width="13%">
                <?php echo JText::_('Donation Status'); ?>
            </th><th width="13%">
                <?php echo JText::_('Donation Schedule'); ?>
            </th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="5">
                <?php echo $this->pagination->getListFooter(); ?>
            </td>
        </tr>
        </tfoot>
        <tbody>
        <?php if (!empty($this->items)) : ?>
            <?php foreach ($this->items as $i => $row) :
                $link = JRoute::_('index.php?option=com_helloworld&task=helloworld.edit&id=' . $row->id);
                ?>
                <tr>
                    <td><?php echo $this->pagination->getRowOffset($i); ?></td>
                    <td>
                        <?php echo $row->first_name. ' , '. $row->last_name; ?>
                    </td>
                    <td>
                        <?php echo $row->email; ?>
                    </td>
                    <td align="center">
                        <?php echo $row->amount; ?>
                    </td>
                    <td align="center">
                        <?php echo $row->method; ?>
                    </td>
                    <td align="center">
                        <?php echo $row->status; ?>
                    </td>
                    <td align="center">
                        <?php echo $row->period; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
    <input type="hidden" name="task" value=""/>
    <input type="hidden" name="boxchecked" value="0"/>
    <?php echo JHtml::_('form.token'); ?>
</form>