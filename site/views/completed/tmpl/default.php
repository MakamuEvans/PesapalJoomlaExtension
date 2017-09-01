<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
defined('_JEXEC') or die('Restricted access');
?>
<script type="text/javascript">
    var base_url = '<?php echo JUri::base(); ?>';


</script>
<div id="vue-app">
    <completed></completed>
</div>
<template id="completed-template">
    <div class="row" style="margin-left: 30px">
        <h2>Thank you for your Donation</h2>
        Donation Status: <strong>{{status}}</strong>
    </div>
</template>