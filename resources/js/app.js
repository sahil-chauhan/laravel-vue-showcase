/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;


import Vue from 'vue'
import axios from 'axios';
import VueAxios from 'vue-axios'
import VueSocialauth from 'vue-social-auth'

import VueLoading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

Vue.use(VueAxios, axios);

Vue.use(VueSocialauth, {

  providers: {
    github: {
      clientId: window.Laravel.GITHUB_CLIENT_ID,
      redirectUri: window.Laravel.GITHUB_CLIENT_CALLBACK_URL, // Your client app URL
    },
    linkedin: {
      clientId:window.Laravel.LINKEDIN_CLIENT_ID,
      redirectUri:window.Laravel.LINKEDIN_CLIENT_CALLBACK_URL, // Your client app URL
      requiredUrlParams: ['state','scope'],
      state:['DCEeFWf45A53sdfKef424'],
      scope: ['r_emailaddress','r_liteprofile']
    }
  }
});

Vue.use(VueLoading);


import store from '@store/store'
import App from '@components/App'
import router from '@routes/routes';

import interceptorsSetup from './helpers/interceptors'
interceptorsSetup()


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store:store
});