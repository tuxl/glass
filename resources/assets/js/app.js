
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/*给axios添加finally支持*/
import promiseFinally from 'promise.prototype.finally'
promiseFinally.shim();

import ElementUI from 'element-ui';
import '../css/app.scss'

import Vuex from 'vuex';
import VueRouter from 'vue-router'
window.Vue = require('vue');

Vue.use(ElementUI);
Vue.use(Vuex);
Vue.use(VueRouter);

import { sidebar } from './vexm/sidebar'
import { user } from './vexm/user'
import framwork from './components/framwork';
import { routes } from './routes/routes'

const store = new Vuex.Store({
    state: {
        path:'/',
    },
    modules: {
        sidebar: sidebar,
        user : user,
    }
});


const router = new VueRouter({
    routes,
});


const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(framwork),
    data:{
        resizeCallBack:[],
    },
    methods:{
        registResizeListener:function (func) {
            this.resizeCallBack.push(func);
        },
        reactResize:function () {
            for (let i=0; i<this.resizeCallBack.length; i++){
                this.resizeCallBack[i]();
            }
        },
    },
    mounted(){
        window.onresize = this.reactResize;
        axios.interceptors.response.use(
            response => {
                return response;
            },
            error => {
                if (error.response.status == 401 || error.response.status == 419) {
                    this.$notify({
                        message: '登录超时,请重新登录',
                        type: 'error'
                    });
                }
                return Promise.reject(error.response)
            });
    }
});
