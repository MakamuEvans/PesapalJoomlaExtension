/**
 * Created by elm on 8/31/17.
 */
Vue.component('completed', {
   template: '#completed-template',
    data: function () {
        return{
            status: "Please wait..."
        }
    },
    methods: {
       urlParam: function (name) {
           var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
           if (results == null) {
               return null;
           }
           else {
               return results[1] || 0;
           }
       },
        checkStatus: function (reference, track) {
           var inh = this;
            var details = {
                pesapal_merchant_reference: reference,
                pesapal_transaction_tracking_id: track
            };
            $.post(base_url+"index.php?option=com_donate&task=status", details, function (data) {
                var response = data.split(",");
                inh.status = response[2];
            })
        }
    },
    mounted: function () {
       var merchant_reference = this.urlParam('pesapal_merchant_reference');
       var tracking_id = this.urlParam('pesapal_transaction_tracking_id');
       this.checkStatus(merchant_reference, tracking_id);
    }
});
Vue.component('donate', {
    template: '#vue-template',
    data: function () {
        return{
            stepOne: true,
            stepTwo: false,
            details: {
                email: "",
                first_name: "",
                last_name: "",
                amount: "",
                period: "",
                currency: ""
            },
            blank: false,
            email: false,
            frameSource: null
        }
    },
    methods: {
        donate: function () {
            var inh = this;
            console.log(inh.details);
            var details = {email: inh.details.email, first_name:inh.details.first_name,last_name:inh.details.last_name,
            amount:inh.details.amount, period:inh.details.period, currency:inh.details.currency};
            console.log(details);
            $.post(base_url+"index.php?option=com_donate&task=donate", details, function (data) {
                console.log(data);
                inh.frameSource = data;
                inh.stepOne = false;
                inh.stepTwo = true;
            })
        },
        validate: function () {
            var inh = this;
            console.log(inh.validateEmail(inh.details.email));
            if(inh.details.email == ""||inh.details.first_name== ""||inh.details.last_name== ""||inh.details.amount== ""||inh.details.period== ""||inh.details.currency ==""){
                inh.blank = true;
            }else {
                if (inh.validateEmail(inh.details.email)){
                    inh.blank = false;
                    inh.email = false;
                    inh.donate();
                }else {
                    inh.blank = false;
                    inh.email = true;
                }
            }
        },
        validateEmail: function (email) {
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
    }
});
var app = new Vue({
    el: '#vue-app'
});
var urlParam = function (name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results == null) {
        return null;
    }
    else {
        return results[1] || 0;
    }
};