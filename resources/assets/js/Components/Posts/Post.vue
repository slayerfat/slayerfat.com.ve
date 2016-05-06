<template>
    <navbar></navbar>
    <div class="row posts">
        <div class="small-12 columns">
            <p>
                <a class="button"
                   v-show="user.admin"
                   v-link="{name: 'posts.create'}"
                >
                    Crear
                </a>
            </p>
            <div class="media-object stack-for-small" v-for="post in posts">
                <div class="media-object-section">
                    <a v-link="{name: 'posts.show', params: {id: post.id}}">
                        <img :src="post.thumbnail_url">
                    </a>
                </div>
                <div class="media-object-section main-section">
                    <h4>
                        <a v-link="{name: 'posts.show', params: {id: post.id}}">
                            {{ post.title }}
                        </a>
                    </h4>
                    <p>{{ post.summary }}</p>
                    <p>
                        <span class="secondary label" v-for="tag in post.tags">
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
    export default {
        data () {
            return {
                // the error message text.
                errorMsg: '',

                // the tags in the system.
                posts: [],

                // the last edited tag.
                deleted: null,

                // the tag ajax http resource.
                resource: null,

                user: null
            };
        },

        created() {
            this.$http.get('users/current').then(function (response) {
                this.$set('user', response.data);
            });

            // the {/id} is important.
            // https://github.com/vuejs/vue-resource/blob/master/docs/resource.md
            this.resource = this.$resource('posts{/id}');

            this.resource.get().then(function (response) {
                this.$set('posts', response.data)
            }, function () {
                this.$set('posts', [{title: 'Error inesperado en el servidor.'}])
            });
        },

        components: {
            Navbar,
            MyFooter
        }
    };
</script>

<style>
    .posts {
        margin-top: 1em;
    }

    .media-object-section img {
        width: 300px;
    }
</style>
