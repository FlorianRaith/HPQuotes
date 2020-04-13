import Vue from 'vue';
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import router from './router';
import store from './store';
import App from './components/App';
import axios from 'axios';

// setup axios
window.axios = axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// setup csrf token
const token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

// setup vue app
Vue.use(VueRouter);
const app = new Vue({
    el: '#app',
    router,
    store,
    template: '<App/>',
    components: { App }
});