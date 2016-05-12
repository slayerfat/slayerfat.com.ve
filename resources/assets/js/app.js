// App routes.
import routes from './routes';

// Filters.
import {markdown} from './Filters/markdown';
import {arrayRandom} from './Filters/arrayRandom';
import {fontAwesomeClass} from './Filters/fontAwesomeClass';

// Helpers.
import {getCurrentUser} from './getCurrentUser'

var Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');

// define the router.
var VueRouter = require('vue-router');
Vue.use(VueRouter);
var router = new VueRouter();

// using the filters.
Vue.filter('fontAwesomeClass', fontAwesomeClass);
Vue.filter('markdown', markdown);
Vue.filter('arrayRandom', arrayRandom);

// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// Vue.extend(), or just a component options object.
// We'll talk about nested routes later.
router.map(routes);

// checks how many times the user has being tracked for auth.
if (router.counter !== 'undefined') {
    router.counter = 0;
}

// before each route call.
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

var App = Vue.extend();

router.start(App, '#app');
