const $ = require('jquery');
require('bootstrap');

import { createApp } from 'vue';
import App from './js/admin/NewConsultationFlow.vue';
import SimpleTypeahead from 'vue3-simple-typeahead';
import 'vue3-simple-typeahead/dist/vue3-simple-typeahead.css'; //Optional default CSS
let app = createApp(App);
app.use(SimpleTypeahead);
app.mount('#vue-app');