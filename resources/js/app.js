require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import {routes} from './routes';
import MainApp from './components/MainApp';
import vSelect from 'vue-select';
import vueSlider from 'vue-slider-component'
import VueNumberInput from '@chenfengyuan/vue-number-input';

Vue.component('v-numberInput', VueNumberInput);
Vue.component('v-select', vSelect);
Vue.component('v-slider', vueSlider);



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
    components:{ MainApp, vSelect, vueSlider }
});
