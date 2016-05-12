import Greeter from './Components/Greeter.vue';
import Knowledge from './Components/Knowledge/Knowledge.vue';
import VideosIndex from './Components/Videos/Index.vue';
import Navbar from './Components/Navbar.vue';
import Footer from './Components/Footer.vue';
import TagsIndex from './Components/Tags/Index.vue';
import PostIndex from './Components/Posts/Index.vue';
import PostCreate from './Components/Posts/Create.vue';
import PostShow from './Components/Posts/Show.vue';

export default {
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
        component: TagsIndex,
        auth: true
    },
    '/videos': {
        name: 'videos.index',
        component: VideosIndex
    },
    '/blog': {
        name: 'posts.index',
        component: PostIndex
    },
    'blog/:slug': {
        name: 'posts.show',
        component: PostShow
    },
    'blog/crear': {
        name: 'posts.create',
        component: PostCreate,
        auth: true
    }
};
