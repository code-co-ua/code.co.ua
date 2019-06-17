/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/**
 * Responsive Touch Compatible Toast plugin for Vue
 */
import Toasted from 'vue-toasted';

Vue.use(Toasted)

/**
 * A simple tags input with typeahead (autocomplete) built with Vue.js 2.
 */
import VoerroTagsInput from '@voerro/vue-tagsinput';

Vue.component('tags-input', VoerroTagsInput);

/**
 * SweetAlert2 Vue
 */
import VueSweetalert2 from 'vue-sweetalert2';

Vue.use(VueSweetalert2);

/**
 * A javascript text differencing implementation.
 */
window.jsdiff = require('diff');

/**
 * Components
 */
Vue.component('text-editor', require('./components/EditorComponent'));
Vue.component('diff', require('./components/DiffComponent'));
Vue.component('exercise', require('./components/ExerciseComponent'));
Vue.component('questions', require('./components/QuestionsComponent'));

/**
 * Markdown library
 */
var marked = require('marked');
Vue.mixin({
    methods: {
        marked: function (input) {
            return marked(input);
        }
    }
});

/**
 * Vue app instance
 */
const app = new Vue({
    el: '#app',
    data: {
        selectedTags: [],
    }
});

/**
 * Bootstrap js dependencies without jquery
 */
var bsn = require('bootstrap.native/dist/bootstrap-native-v4');

/**
 * Prism is a lightweight, extensible syntax highlighter, built with modern web standards in mind.
 */
require('./prism.js');