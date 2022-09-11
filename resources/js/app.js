/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import CKEditor from '@ckeditor/ckeditor5-vue2'
import VueHtml5Editor from 'vue-html5-editor'

window.Vue = require('vue').default;
Vue.use( CKEditor );
Vue.use(VueHtml5Editor);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('exam-component', require('./components/ExamComponent.vue').default);
Vue.component('exam-details', require('./components/ExamDetailsComponent.vue').default);
Vue.component('add-question', require('./components/AddQuestionComponent.vue').default);
Vue.component('edit-question', require('./components/EditQuestionComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
