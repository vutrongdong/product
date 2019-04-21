
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
import Routes from './route'
import store from './store';
import VeeValidate from 'vee-validate'
import messages from './messages';
import Paginate from 'vuejs-paginate'

Vue.use(VeeValidate, {
    locale: 'vi',
    dictionary: {
        vi: messages['vi']
    }
});
Vue.use(VeeValidate);
Vue.use(VueRouter);
Vue.component('admin-layout', require('./components/AdminLayout.vue').default);
Vue.component('paginate', Paginate)
const router = new VueRouter({
    routes: Routes,
    mode: 'history'
});

const app = new Vue({
    el: '#wrapper',
    router: router,
    store: store,
});

