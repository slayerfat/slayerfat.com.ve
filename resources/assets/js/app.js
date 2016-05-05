var Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');

// Define some routes.
var VueRouter = require('vue-router');
Vue.use(VueRouter);

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

var router = new VueRouter();

// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// Vue.extend(), or just a component options object.
// We'll talk about nested routes later.
router.map({
    '/': {
        name: '/',
        component: Greeter
    },
    '/etiquetas': {
        name: 'tags.index',
        component: Tags
    },
    '/videos': {
        name: 'videos.index',
        component: Videos
    }
});

var App = Vue.extend({
    components: {
        navbar: Navbar,
        greeter: Greeter,
        videos: Videos,
        tags: Tags,
        "my-footer": Footer
    }
});

router.start(App, '#app');
