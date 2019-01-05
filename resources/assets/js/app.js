
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
const server = require('./server');

window.Vue = require('vue');
Vue.use(require('vue-resource'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.mixin(server);
Vue.component('exchange', require('./components/economy/Exchange.vue').default);
Vue.component('product', require('./components/economy/Products.vue').default);
Vue.component('jobs', require('./components/economy/Jobs.vue').default);
Vue.component('company', require('./components/economy/Company.vue').default);

const app = new Vue({
    el: '#app'
});