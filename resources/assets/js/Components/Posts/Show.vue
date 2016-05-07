<template>
    <navbar></navbar>
    <loader :loading="loader.loading"></loader>
    <div class="post-header" style="background-image: url(http://i.imgur.com/Cbo4G.png)" v-if="post">
        <div class="post-header-title">
            <div class="row">
                <div class="column">
                    <h1>{{ post.title }}</h1>
                    <h3>{{ post.summary }}</h3>
                    <h6>{{ post.dates.formal }}, {{ post.dates.formatted }}</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row" v-if="post">
        <div class="small-12 column">
            <div class="post-body">
                <p>{{{ post.body_one | markdown }}}</p>
                <p>{{{ post.body_two | markdown }}}</p>
                <p>{{{ post.body_three | markdown }}}</p>
                <p>{{{ post.body_four | markdown }}}</p>
            </div>

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
    .post-header {
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-color: #464646;
        width: 100%;
        height: 40%;
        position: relative;
        display: table;
        color: white;
        text-shadow: 0 0 10px black;
    }

    .post-header-title {
        background-color: rgba(10, 10, 10, 0.3);
        display: table-cell;
        vertical-align: middle;
        padding: 0 2em;
    }

    .post-header-title h3 {
        color: #d2d2d2;
    }

    .post-body {
        text-align: justify;
    }

    .post-tags {
        margin-right: 10px;
    }
</style>
