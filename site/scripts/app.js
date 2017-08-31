/**
 * Created by elm on 8/31/17.
 */
Vue.component('donate', {
    template: '#vue-template',
    data: function () {
        return{
            stepOne: true,
            stepTwo: false,
            details: [],
            frameSource: null
        }
    },
    methods: {
        donate: function () {
            var inh = this;
            console.log(inh.details);
            var details = {email: inh.details.email, first_name:inh.details.first_name,last_name:inh.details.last_name,
            amount:inh.details.amount};
            $.post(base_url+"index.php?option=com_donate&task=donate", details, function (data) {
                console.log(data);
                inh.frameSource = data;
                inh.stepOne = false;
                inh.stepTwo = true;
            })
        }
    }
});
var app = new Vue({
    el: '#vue-app'
});