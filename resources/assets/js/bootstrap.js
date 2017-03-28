
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

require('admin-lte');
window.toastr = require('toastr');

require('icheck');
/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */


require('sweetalert');

window.Vue = require('vue');

window.axios = require('axios');
Vue.prototype.$http = axios;

/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */

//Vue.http.interceptors.push((request, next) => {
//request.headers['X-CSRF-TOKEN'] = Laravel.csrfToken;
//-axios.defaults.headers.common['X-CSRF-TOKEN'] = Laravel.csrfToken;

//    next();
//});
window.axios = require('axios');

axios.defaults.headers.common['X-CSRF-TOKEN'] = Laravel.csrfToken;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
// Use trans function in Vue (equivalent to trans() Laravel Translations helper). See htmlheader.balde.php partial.
Vue.prototype.trans = (key) => {
    return _.get(window.trans, key, key);
};

//Laravel AdminLTE login input field component
Vue.component('login-input-field', require('./components/LoginInputField.vue'));

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });

import Echo from "laravel-echo"

import io from "socket.io-client"
window.io = io

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: '0beb4667296e55481ee9',
//     cluster: 'mt1',
//     encrypted: true
// });

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001',
    namespace: 'Manelgavalda.TodosBackend.Events'
});