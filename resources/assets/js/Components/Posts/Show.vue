<template>
    <navbar :maintenace="maintenance"></navbar>
    <loader :loading="loader.loading"></loader>
    <div class="row posts" v-if="post">
        <div class="small-12 column">
            <artice>
                <h1>{{ post.title }}</h1>
                <h2 class="subheader">{{ post.summary }}</h2>
                <h4>{{ post.dates.formal }}, {{ post.dates.formatted }}</h4>
                <hr>
                <p>{{{ post.body }}}</p>
            </artice>

            <p>
                <span class="secondary label post-tags" v-for="tag in post.tags">
                    {{ tag.name }}
                </span>
            </p>
        </div>
    </div>
    <my-footer></my-footer>
</template>

<script>
    import Navbar from "./../Navbar.vue";
    import MyFooter from "./../Footer.vue";
    import Loader from "./../Loader.vue";
    export default {
        data () {
            return {
                loader: {
                    loading: true
                },
                post: null,
                user: null
            };
        },

        created() {
            this.$http.get('users/current').then(function (response) {
                this.$set('user', response.data);
            });

            this.$http.get('posts{/id}', {id: this.$route.params.id}).then(function (response) {
                this.$set('post', response.data);
                this.loader.loading = false;
            }, function () {
                this.$set('post', [{title: 'Error inesperado en el servidor.'}]);
            });
        },

        components: {
            Navbar,
            MyFooter,
            Loader
        }
    };
</script>

<style>
    .posts {
        margin-top: 1em;
    }

    .post-tags {
        margin-right: 10px;
    }
</style>
