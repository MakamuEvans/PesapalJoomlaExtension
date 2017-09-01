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
    <div class="row" style="margin: 20px;">
        <div class="row" style="margin-left: 30px">
            <div class="row">
                <h3>Joomla extension for Pesapal</h3>
                <h6>Fill below form to get started</h6>
                <div v-show="blank" class="alert alert-warning">
                    <h6>No field(s) should be left blank</h6>
                </div>
                <div v-show="email" class="alert alert-warning">
                    <h6>Ensure you input a correct email</h6>
                </div>
            </div>
            <div class="col-md-8" v-show="stepOne">
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
                    <input type="email" v-model="details.email" class="form-control">
                </div>
                <div class="form-group">
                    <label>Currency</label>
                    <select class="form-control" v-model="details.currency">
                        <option selected >KES</option>
                        <option>USD</option>
                        <option>EUR</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Amount</label>
                    <input type="number" v-model="details.amount" class="form-control">
                </div>
                <div class="form-group">
                    <label>Period</label>
                    <select class="form-control" v-model="details.period">
                        <option selected >One Off</option>
                        <option>Monthly</option>
                        <option>Annually</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="form-control btn btn-primary" @click="validate">Donate</button>
                </div>
            </div>
        </div>
        <div class="iframe" v-show="stepTwo">
            <iframe :src="frameSource" style="width: 100%;height: 700px"></iframe>
        </div>

    </div>
</template>