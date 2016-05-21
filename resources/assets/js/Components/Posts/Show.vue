<template>
    <navbar></navbar>
    <loader :loading="loader.loading"></loader>
    <div class="post-header" :style="{'background-image': 'url(' + backgroundImg('h') + ')'}" v-if="post">
        <div class="post-header-title">
            <div class="row">
                <div class="column">
                    <!--title-->
                    <h1 @dblclick="startEditing('title')" v-show="editing != 'title'">
                        {{ post.title }}
                    </h1>
                    <input class="edit"
                           v-if="editing == 'title'"
                           type="text" v-model="post.title"
                           @blur="doneEditing('title')"
                           @keyup.enter="doneEditing('title')"
                           @keyup.esc="cancelEdit('title')"
                    >

                    <p class="help-text" v-if="errorMsg && editing == 'title'">
                        <span v-for="msg in errorMsg.title">{{ msg }}</span>
                    </p>

                    <!--summary-->
                    <h2 @dblclick="startEditing('summary')" v-show="editing != 'summary'">
                        {{ post.summary }}
                    </h2>
                    <input class="edit"
                           v-if="editing == 'summary'"
                           type="text" v-model="post.summary"
                           @blur="doneEditing('summary')"
                           @keyup.enter="doneEditing('summary')"
                           @keyup.esc="cancelEdit('summary')"
                    >

                    <p class="help-text" v-if="errorMsg && editing == 'summary'">
                        <span v-for="msg in errorMsg.summary">{{ msg }}</span>
                    </p>

                    <!--dates-->
                    <h3 @dblclick="startEditing('publish_date')" v-show="editing != 'publish_date'">
                        <em>{{ post.dates.formal }}, {{ post.dates.formatted }}</em>
                    </h3>
                    <input class="edit"
                           v-if="editing == 'publish_date'"
                           type="text" v-model="post.publish_date"
                           @blur="doneEditing('publish_date')"
                           @keyup.enter="doneEditing('publish_date')"
                           @keyup.esc="cancelEdit('publish_date')"
                    >

                    <p class="help-text" v-if="errorMsg && editing == 'publish_date'">
                        <span v-for="msg in errorMsg.publish_date">{{ msg }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row" v-if="post">
        <div class="small-12 column">
            <div class="post-body">
                <!--body_one-->
                <p @dblclick="startEditing('body_one')" v-show="editing != 'body_one'">
                    {{{ post.body_one | markdown }}}
                </p>
                <textarea class="edit" rows="6"
                       v-if="editing == 'body_one'"
                       type="text" v-model="post.body_one"
                       @blur="doneEditing('body_one')"
                       @keyup.esc="cancelEdit('body_one')"
                ></textarea>

                <p class="help-text" v-if="errorMsg && editing == 'body_one'">
                    <span v-for="msg in errorMsg.body_one">{{ msg }}</span>
                </p>

                <!--markdown preview-->
                <div v-if="editing == 'body_one'" class="markdown-preview">
                    {{{ post.body_one | markdown }}}
                    <hr>
                </div>

                <!--body_two-->
                <p @dblclick="startEditing('body_two')" v-show="editing != 'body_two'">
                    {{{ post.body_two | markdown }}}
                </p>
                <textarea class="edit" rows="6"
                          v-if="editing == 'body_two'"
                          type="text" v-model="post.body_two"
                          @blur="doneEditing('body_two')"
                          @keyup.esc="cancelEdit('body_two')"
                ></textarea>

                <p class="help-text" v-if="errorMsg && editing == 'body_two'">
                    <span v-for="msg in errorMsg.body_two">{{ msg }}</span>
                </p>

                <!--markdown preview-->
                <div v-if="editing == 'body_two'" class="markdown-preview">
                    {{{ post.body_two | markdown }}}
                    <hr>
                </div>

                <!--body_three-->
                <p @dblclick="startEditing('body_three')" v-show="editing != 'body_three'">
                    {{{ post.body_three | markdown }}}
                </p>
                <textarea class="edit" rows="6"
                          v-if="editing == 'body_three'"
                          type="text" v-model="post.body_three"
                          @blur="doneEditing('body_three')"
                          @keyup.esc="cancelEdit('body_three')"
                ></textarea>

                <p class="help-text" v-if="errorMsg && editing == 'body_three'">
                    <span v-for="msg in errorMsg.body_three">{{ msg }}</span>
                </p>

                <!--markdown preview-->
                <div v-if="editing == 'body_three'" class="markdown-preview">
                    {{{ post.body_three | markdown }}}
                    <hr>
                </div>

                <!--body_four-->
                <p @dblclick="startEditing('body_four')" v-show="editing != 'body_four'">
                    {{{ post.body_four | markdown }}}
                </p>
                <textarea class="edit" rows="6"
                          v-if="editing == 'body_four'"
                          type="text" v-model="post.body_four"
                          @blur="doneEditing('body_four')"
                          @keyup.esc="cancelEdit('body_four')"
                ></textarea>

                <p class="help-text" v-if="errorMsg && editing == 'body_four'">
                    <span v-for="msg in errorMsg.body_four">{{ msg }}</span>
                </p>

                <!--markdown preview-->
                <div v-if="editing == 'body_four'" class="markdown-preview">
                    {{{ post.body_four | markdown }}}
                    <hr>
                </div>
            </div>

            <p>
                <a class="secondary label post-tags"
                   v-for="tag in post.tags"
                   v-link="{name: 'posts.index', query:{tagId: tag.id}}"
                >
                    {{ tag.name }}
                </a>
            </p>
        </div>
    </div>
    <my-footer></my-footer>
</template>

<script>
    import Navbar from "./../Navbar.vue";
    import MyFooter from "./../Footer.vue";
    import Loader from "./../Loader.vue";
    import {makeComponentsUser} from "./../../makeComponentsUser";
    import {imgurlImageResizer} from "./../../Filters/imgurlImageResizer";
    export default {
        data () {
            return {
                loader: {
                    loading: true
                },

                // the model
                post: null,

                // the current user
                user: null,

                // current user privilege
                isAdmin: false,

                // the error object made from the server response.
                errorMsg: null,

                // the current variable value
                beforeEditCache: null,

                // flag to know if the view is being edited
                editing: false,

                // allows showing the markdown render
                showPreview: {
                    body_one: false,
                    body_two: false,
                    body_three: false,
                    body_four: false
                }
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

            this.$http.get('posts{/slug}', {slug: this.$route.params.slug}).then(function (response) {
                this.$set('post', response.data);
                this.loader.loading = false;
            }, function () {
                this.$set('post', [{title: 'Error inesperado en el servidor.'}]);
            });
        },

        methods: {
            backgroundImg(type) {
                if (this.post && this.post.thumbnails.length > 0) {
                    return imgurlImageResizer(this.post.thumbnails[0], type);
                }

                return imgurlImageResizer(null, type);
            },

            startEditing(attribute) {
                if (!this.isAdmin || this.errorMsg) {
                    return;
                }
                this.beforeEditCache = this.post[attribute];
                this.editing = attribute.toString();
            },

            cancelEdit(attribute) {
                this.editing = null;
                this.errorMsg = null;
                this.post[attribute] = this.beforeEditCache;
                this.beforeEditCache = null;
            },

            doneEditing(attribute) {
                if (!this.isAdmin) {
                    return;
                }

                // check the input
                this.post[attribute] = this.post[attribute].trim();
                if (!this.editing || !this.post[attribute]) {
                    return;
                }
                // prepare the data
                this.editing = null;

                // refuse if data is the same
                if (this.post[attribute] == this.beforeEditCache) {
                    return;
                }

                // if everything is ok we create the data to be send to the server
                let post = {};
                post[attribute] = this.post[attribute];

                // send the data
                this.resource.update({id: this.post.id}, post).then(function () {
                    console.log('updated');
                    this.errorMsg = null;
                }, function (response) {
                    this.editing = attribute.toString();
                    if (response.status === 500) {
                        let error = {};
                        error[attribute] = ['Error inesperado.'];
                        return this.errorMsg = error;
                    }

                    this.errorMsg = response.data;
                });
            }
        },

        components: {
            Navbar,
            MyFooter,
            Loader
        }
    };
</script>
