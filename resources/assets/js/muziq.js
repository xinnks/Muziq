import Vue from 'vue';
import Start from './Start'
import router from './router'
import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios, axios);

Vue.config.productionTip = false

new Vue({
    el: '#app',
    router,
    components: { Start },
    template: '<Start/>'
});