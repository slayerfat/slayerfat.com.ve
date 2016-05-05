var Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');

import Greeter from './components/Greeter.vue';
import Videos from './components/Videos.vue';
import Navbar from './components/Navbar.vue';
import Footer from './components/Footer.vue';
import Tags from './components/Tags.vue';

Vue.filter('fontAwesomeClass', function (value) {
    return 'fa fa-' + value;
});

Vue.filter('arrayRandom', function (value) {
    return value[Math.floor(Math.random() * value.length)];
});

var app = new Vue({
    el: '#app',

    components: {
        navbar: Navbar,
        greeter: Greeter,
        videos: Videos,
        tags: Tags,
        "my-footer": Footer
    }
});
