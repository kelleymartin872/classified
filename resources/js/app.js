/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import '../sass/app.scss'
import { createApp } from 'vue';

// import Vue from 'vue'
 
// import VueChatScroll from 'vue-chat-scroll'
// Vue.use(VueChatScroll)
/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
import SaveAd from './components/SaveAd.vue';

app.component('example-component', ExampleComponent);
app.component('save-ad', SaveAd);
app.component('image-preview', require('./components/imagepreview/FeaturedImage.vue').default);
app.component('first-image', require('./components/imagepreview/FirstImage.vue').default);
app.component('second-image', require('./components/imagepreview/SecondImage.vue').default);
app.component('category-dropdown', require('./components/CategoryDropdown.vue').default);
app.component('country-dropdown', require('./components/AdressDropDown.vue').default);
app.component('message', require('./components/Message.vue').default);
app.component('conversation', require('./components/Conversation.vue').default);
app.component('show-phone-number', require('./components/ShowPhoneNumber.vue').default);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.globEager('./**/*.vue')).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
