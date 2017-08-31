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
        }
    }
});
var app = new Vue({
    el: '#vue-app'
});