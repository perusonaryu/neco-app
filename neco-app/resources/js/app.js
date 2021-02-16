/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// import router from './router';
import Vuetify from 'vuetify';
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/dist/vuetify.min.css';
import router from './router'
import store from './store/index'
import prefectureData from './prefectureData.json'
Vue.use(Vuetify);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('my-cats-list', require('./components/myPageComponent/myCatsList.vue').default);
Vue.component('all-cat-list', require('./components/everyonePageComponent/allCatList.vue').default);
Vue.component('like-check', require('./components/everyonePageComponent/likeCheck.vue').default);
Vue.component('chat-list', require('./components/everyonePageComponent/chatListComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify({
        icons: {
            iconfont: 'mdi', // default - only for display purposes
        },
    }),
    router,
    store,
    prefectureData,
});
