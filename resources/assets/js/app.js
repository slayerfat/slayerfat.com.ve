var Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

import Greeter from './components/Greeter.vue';

Vue.filter('fontAwesomeClass', function (value) {
    return 'fa fa-' + value;
});

Vue.filter('arrayRandom', function (value) {
    return value[Math.floor(Math.random() * value.length)];
});

new Vue({
    el: '#app',

    components: {Greeter}
});
