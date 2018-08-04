import Vue from 'vue';
import Start from './Start'
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios, axios);

new Vue({
    el: '#app',
    components: { Start },
    template: '<Start/>'
});