require('./bootstrap');
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import {routes} from './routes';
import MainApp from './components/MainApp.vue';
import StoreData from './store/index';
import {initialize} from './helpers/general';
import VModal from 'vue-js-modal';

Vue.use(VModal);
Vue.use(BootstrapVue);
Vue.use(VueRouter);
Vue.use(Vuex);


const store = new Vuex.Store(StoreData);

global.router = new VueRouter({
    routes,
    mode: 'history'
});

initialize(store, router); 

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        MainApp
    }
});
