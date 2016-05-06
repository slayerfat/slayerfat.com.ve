<template>
    <navbar></navbar>
    <div class="row posts">
        <div class="small-12 columns">
            <h2>Crear nueva Entrada</h2>

            <form @submit="store()">
                <label>Título
                    <input type="text" v-model="title">
                </label>

                <p v-if="errors.title" class="help-text" v-for="error in errors.title">
                    {{ error }}
                </p>

                <label>Cuerpo
                    <textarea v-model="body" rows="6"></textarea>
                </label>

                <p v-if="errors.body" class="help-text" v-for="error in errors.body">
                    {{ error }}
                </p>

                <label>
                    <button type="button"
                            class="button expanded secondary"
                            @click="showPreview = !showPreview"
                    >
                        Preview
                    </button>
                    <div v-show="showPreview">{{{ body | markdown }}}</div>
                </label>

                <label>Sumario
                    <textarea v-model="summary" rows="2"></textarea>
                </label>

                <p v-if="errors.summary" class="help-text" v-for="error in errors.summary">
                    {{ error }}
                </p>

                <div class="row">
                    <div class="medium-6 columns">
                        <label>Imagen por defecto
                            <input type="text" v-model="thumbnail_url">
                        </label>
                        <p v-if="errors.thumbnail_url"
                           class="help-text"
                           v-for="error in errors.thumbnail_url"
                        >
                            {{ error }}
                        </p>
                    </div>
                    <div class="medium-6 columns">
                        <label>Fecha de publicación
                            <input type="date" v-model="publish_date">
                        </label>
                        <p v-if="errors.publish_date"
                           class="help-text"
                           v-for="error in errors.publish_date"
                        >
                            {{ error }}
                        </p>
                    </div>
                </div>

                <select v-model="selectedTags" multiple>
                    <option v-for="tag in tags" :value="tag.id">{{ tag.name }}</option>
                </select>

                <p v-if="errors.tag_id" class="help-text" v-for="error in errors.tag_id">
                    {{ error }}
                </p>

                <button type="submit" class="button expanded">Crear Entrada</button>
            </form>
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
                // allows showing the markdown render
                showPreview: false,

                errors: {
                    title: null,
                    body: null,
                    summary: null,
                    thumbnail_url: null,
                    publish_date: null,
                    tag_id: null
                },

                title: '',
                body: '',
                summary: '',
                thumbnail_url: '',
                publish_date: '',
                selectedTags: null,
                tags: null
            };
        },

        created() {
            this.$http.get('/tags').then(function(response) {
                this.tags = response.data;
            }, function() {
                this.tags.push({name: 'Error, no se puede procesar tags.'});
            });
        },

        methods: {
            store() {
                let post = {
                    title: this.title,
                    body: this.body,
                    summary: this.summary,
                    thumbnail_url: this.thumbnail_url,
                    publish_date: this.publish_date,
                    tag_id: this.selectedTags
                };
                this.$http.post('/posts', post).then(function (response) {
                    this.$route.router.go('/blog', {id: response.data.id});
                }, function (response) {
                    this.$set('errors', response.data)
                });
            }
        },

        components: {
            Navbar,
            MyFooter
        }
    };
</script>
