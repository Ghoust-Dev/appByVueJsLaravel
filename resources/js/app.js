require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
import store from "./store/store";

Vue.use(VueRouter)

import Progressbar from './components/Progressbar';
import Personal from './components/Personal';
import Company from './components/Company';
import Validate from './components/Validate';
import Success from './components/Success';

const routes = [
    { path: '/', component: Personal },
    { path: '/company', component: Company },
    { path: '/validate', component: Validate },
    { path: '/success', component: Success }
  ]

const router = new VueRouter({
    mode:'history',
    routes 
  })

const app = new Vue({
    el: '#app',
    router,
    store,
    components:{
        Progressbar,
        Personal,
        Company,
        Validate,
        Success
    }
});
