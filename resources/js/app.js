require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import {routes} from './routes';
import MainApp from './components/MainApp';


Vue.use(VueRouter);
Vue.use(Vuex);

//Setup router
//Routes at routes.js
const router = new VueRouter({
    mode: 'history',
    routes: routes,
})

//Setup app
const app = new Vue({
    el: '#app',
    router,
    components:{ MainApp }
});
