<?php
/**
 * Created by PhpStorm.
 * User: elm
 * Date: 8/31/17
 * Time: 10:44 AM
 */
defined('_JEXEC') or die('Restricted access');
?>
<script type="text/javascript">
    var base_url = '<?php echo JUri::base(); ?>';
</script>

<!--
vue component will be placed here
-->
<div id="vue-app">
    <donate></donate>
</div>

<!--
Vue app's template here
-->
<template id="vue-template">
    <div class="row" style="margin: 20px">
        <div class="row">
            <div class="col-md-6 col-md-offset-3" v-show="stepOne">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" v-model="details.first_name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" v-model="details.last_name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" v-model="details.email" class="form-control">
                </div>
                <div class="form-group">
                    <label>Amount</label>
                    <input type="number" v-model="details.amount" class="form-control">
                </div>
                <div class="form-group">
                    <label>Period</label>
                    <input type="text" v-model="details.period" class="form-control">
                </div>
                <div class="form-group">
                    <button class="form-control btn btn-primary" @click="donate">Donate</button>
                </div>
            </div>
        </div>
        <div class="iframe" v-show="stepTwo">
            <iframe :src="frameSource" style="width: 100%;height: 700px"></iframe>
        </div>

    </div>
</template>