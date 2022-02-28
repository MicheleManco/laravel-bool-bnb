/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

 const files = require.context('./', true, /\.vue$/i)
 files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

 document.addEventListener('DOMContentLoaded', function() {
     console.log('wekrlbhrk')
    token = $('meta[name="csrf-token"]').attr('content');
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
    
    const app = new Vue({
    el: '#app',
    });
    })
