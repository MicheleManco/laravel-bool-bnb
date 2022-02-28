/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// scansiona la cartella dei componenti di VUE e li trasforma in tag HTML per inserirli
const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// carica VUE al caricamento della pagina
 document.addEventListener("DOMContentLoaded", function(){
    const app = new Vue({
        el: '#app',
    });
});
