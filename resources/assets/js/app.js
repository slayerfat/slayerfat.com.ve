var Vue = require('vue');
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
