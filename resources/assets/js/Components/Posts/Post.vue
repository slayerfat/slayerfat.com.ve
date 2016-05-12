<template>
    <navbar></navbar>
    <loader :loading="loader.loading"></loader>
    <div class="row posts">
        <div class="small-12 columns">
            <p>
                <a class="button"
                   v-if="isAdmin"
                   v-link="{name: 'posts.create'}"
                >
                    Crear
                </a>
            </p>
            <p>
                <a class="button"
                   v-if="filtered"
                   href="#"
                   @click.prevent="resetFiltered"
                >
                    Ver todos
                </a>
            </p>
            <h4 v-if="posts.length == 0">No hay entradas disponibles</h4>
            <div class="media-object stack-for-small" v-for="post in posts">
                <div class="media-object-section">
                    <a v-link="{name: 'posts.show', params: {slug: post.slug}}">
                        <img :src="post.thumbnails | arrayRandom">
                    </a>
                </div>
                <div class="media-object-section main-section">
                    <h4 class="post-title">
                        <a v-link="{name: 'posts.show', params: {slug: post.slug}}">
                            {{ post.title }}
                        </a>
                    </h4>
                    <p class="post-summary">{{ post.summary }}</p>
                    <p>
                        <span class="secondary label post-tags"
                              v-for="tag in post.tags"
                              @click="filterByTag(tag)"
                        >
                            {{ tag.name }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <my-footer></my-footer>
</template>

<script>
    import Navbar from "./../Navbar.vue";
    import MyFooter from "./../Footer.vue";
    import Loader from "./../Loader.vue";
    import {makeComponentsUser} from "./../../makeComponentsUser";
    export default {
        data () {
            return {
                loader: {
                    loading: true
                },
                // the error message text.
                errorMsg: '',

                // the posts in the system.
                posts: [],

                // current posts
                currentPosts: [],

                // flags if the current list is filtered or not.
                filtered: false,

                // the last edited tag.
                deleted: null,

                // the tag ajax http resource.
                resource: null,

                // the current user object
                user: null,

                // current user admin status
                isAdmin: false
            };
        },

        created() {
            makeComponentsUser(this).then(function (user) {
                this.$set('user', user);
                if (user.admin) {
                    this.$set('isAdmin', user.admin);
                }
            }.bind(this), function (user) {
                this.$set('user', user);
            }.bind(this));

            // the {/id} is important.
            // https://github.com/vuejs/vue-resource/blob/master/docs/resource.md
            this.resource = this.$resource('posts{/id}');

            this.resource.get().then(function (response) {
                this.$set('posts', response.data);
                this.$set('currentPosts', response.data);
                this.loader.loading = false;
            }, function () {
                this.$set('posts', [{title: 'Error inesperado en el servidor.'}]);
            });

            // if there is a tag in the params, then we must filter by it.
            if (this.$route.query.tagId) {
                this.filterByTag({id: this.$route.query.tagId});
            }
        },

        methods: {
            filterByTag(tag) {
                this.$http.get('tags{/id}/posts', {id: tag.id}).then(function (response) {
                    this.loader.loading = true;
                    this.filtered = true;
                    this.$set('posts', response.data);
                    this.$set('currentPosts', response.data);
                    this.loader.loading = false;
                }, function () {
                    console.log('error tag posts');
                });
            },

            resetFiltered() {
                this.loader.loading = true;
                this.$set('posts', this.currentPosts);
                this.filtered = false;
                this.loader.loading = false;
            }
        },

        components: {
            Navbar,
            MyFooter,
            Loader
        }
    };
</script>
