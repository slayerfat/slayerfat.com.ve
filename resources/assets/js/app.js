var Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');

// Define some routes.
var VueRouter = require('vue-router');
Vue.use(VueRouter);

import Greeter from './Components/Greeter.vue';
import Knowledge from './Components/Knowledge/Knowledge.vue';
import Videos from './Components/Videos/Videos.vue';
import Navbar from './Components/Navbar.vue';
import Footer from './Components/Footer.vue';
import Tags from './Components/Tags/Tags.vue';
import Post from './Components/Posts/Post.vue';
import PostCreate from './Components/Posts/Create.vue';
import PostShow from './Components/Posts/Show.vue';
import {getCurrentUser} from './getCurrentUser'

Vue.filter('fontAwesomeClass', function (value) {
    return 'fa fa-' + value;
});

// https://github.com/chjj/marked
Vue.filter('markdown', function (value) {
    var marked = require('marked');
    marked.setOptions({
        langPrefix: 'hljs ', // workaround https://github.com/chjj/marked/pull/418

        highlight: function (code) {
            return require('highlight.js').highlightAuto(code).value;
        }
    });
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
    '/conocimientos': {
        name: 'knowledge',
        component: Knowledge
    },
    '/etiquetas': {
        name: 'tags.index',
        component: Tags,
        auth: true
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
        component: PostCreate,
        auth: true
    }
});

if (router.counter !== 'undefined') {
    router.counter = 0;
}

router.beforeEach(function (transition) {
    let authenticated = false;

    if (typeof router.user === 'object') {
        authenticated = router.user.admin;
    } else if (typeof router.user === 'undefined') {
        getCurrentUser(Vue.http).then(function (user) {
            router.user = user;
        }, function() {console.log('user failed')});
    } else if (router.counter <= 5) {
        getCurrentUser(Vue.http).then(function (user) {
            router.user = user;
        }, function(user) {
            router.user = user;
        });
    }

    if (transition.to.auth && !authenticated) {
        router.counter++;
        transition.redirect('/');
    } else {
        transition.next();
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
