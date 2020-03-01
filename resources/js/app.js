require('./bootstrap');

window.Vue = require('vue');
window.jsdiff = require('diff');
var bsn = require('bootstrap.native/dist/bootstrap-native');
var marked = require('marked');

import Toasted from 'vue-toasted';
import VoerroTagsInput from '@voerro/vue-tagsinput';
import VueSweetalert2 from 'vue-sweetalert2';

Vue.use(Toasted);
Vue.component('tags-input', VoerroTagsInput);
Vue.use(VueSweetalert2);

Vue.component('text-editor', require('./components/EditorComponent'));
Vue.component('diff', require('./components/DiffComponent'));
Vue.component('exercise', require('./components/ExerciseComponent'));
Vue.component('questions', require('./components/QuestionsComponent'));

document.addEventListener('turbolinks:load', () => {
    if (document.getElementById("app") != null) {
        var app = new Vue({
            el: '#app',
            mixins: [{
                methods: {
                    marked: function (input) {
                        return marked(input);
                    }
                }
            }],
            data: {
                selectedTags: [],
            }
        });
    }

    BSN.initCallback();
});

require('./prism.js');
