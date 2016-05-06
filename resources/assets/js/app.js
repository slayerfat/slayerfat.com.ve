var Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');

// Define some routes.
var VueRouter = require('vue-router');
Vue.use(VueRouter);

import Greeter from './Components/Greeter.vue';
import Videos from './Components/Videos/Videos.vue';
import Navbar from './Components/Navbar.vue';
import Footer from './Components/Footer.vue';
import Tags from './Components/Tags/Tags.vue';
import Post from './Components/Posts/Post.vue';
import PostCreate from './Components/Posts/Create.vue';
import PostShow from './Components/Posts/Show.vue';

Vue.filter('fontAwesomeClass', function (value) {
    return 'fa fa-' + value;
});

Vue.filter('markdown', function (value) {
    var marked = require('marked');
    return marked(value);
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
    },
    '/blog': {
        name: 'posts.index',
        component: Post
    },
    'blog/:id': {
        name: 'posts.show',
        component: PostShow
    },
    'blog/crear': {
        name: 'posts.create',
        component: PostCreate
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
