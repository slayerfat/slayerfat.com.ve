<template>
    <navbar></navbar>
    <div class="row posts">
        <div class="small-12 columns">
            <h2>Crear nueva Entrada</h2>

            <form @submit.prevent="store()">
                <label>Título
                    <input type="text" v-model="title">
                </label>

                <p v-if="errors.title" class="help-text" v-for="error in errors.title">
                    {{ error }}
                </p>

                <label>Sumario
                    <textarea v-model="summary" rows="2"></textarea>
                </label>

                <p v-if="errors.summary" class="help-text" v-for="error in errors.summary">
                    {{ error }}
                </p>

                <div>
                    <label>Cuerpo uno
                        <textarea v-model="body_one" rows="6"></textarea>
                    </label>

                    <p v-if="errors.body_one" class="help-text" v-for="error in errors.body_one">
                        {{ error }}
                    </p>

                    <label>
                        <button type="button"
                                class="button expanded secondary"
                                @click="showPreview.one = !showPreview.one"
                        >
                            Preview
                        </button>
                        <div v-show="showPreview.one">{{{ body_one | markdown }}}</div>
                    </label>
                </div>

                <div>
                    <label>Cuerpo dos
                        <textarea v-model="body_two" rows="6"></textarea>
                    </label>

                    <p v-if="errors.body_two" class="help-text" v-for="error in errors.body_two">
                        {{ error }}
                    </p>

                    <label>
                        <button type="button"
                                class="button expanded secondary"
                                @click="showPreview.two = !showPreview.two"
                        >
                            Preview
                        </button>
                        <div v-show="showPreview.two">{{{ body_two | markdown }}}</div>
                    </label>
                </div>

                <div>
                    <label>Cuerpo tres
                        <textarea v-model="body_three" rows="6"></textarea>
                    </label>

                    <p v-if="errors.body_three" class="help-text" v-for="error in errors.body_three">
                        {{ error }}
                    </p>

                    <label>
                        <button type="button"
                                class="button expanded secondary"
                                @click="showPreview.three = !showPreview.three"
                        >
                            Preview
                        </button>
                        <div v-show="showPreview.three">{{{ body_three | markdown }}}</div>
                    </label>
                </div>

                <div>
                    <label>Cuerpo cuatro
                        <textarea v-model="body_four" rows="6"></textarea>
                    </label>

                    <p v-if="errors.body_four" class="help-text" v-for="error in errors.body_four">
                        {{ error }}
                    </p>

                    <label>
                        <button type="button"
                                class="button expanded secondary"
                                @click="showPreview.four = !showPreview.four"
                        >
                            Preview
                        </button>
                        <div v-show="showPreview.four">{{{ body_four | markdown }}}</div>
                    </label>
                </div>

                <div class="row">
                    <div class="medium-6 columns">
                        <label>Imágenes por defecto
                            <input type="text" v-model="thumbnails" placeholder="Enlaces URL separadas por coma">
                        </label>
                        <p v-if="errors.thumbnails"
                           class="help-text"
                           v-for="error in errors.thumbnails"
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
                showPreview: {
                    one: false,
                    two: false,
                    three: false,
                    four: false
                },

                errors: {
                    title: null,
                    body_one: null,
                    body_two: null,
                    body_three: null,
                    body_four: null,
                    summary: null,
                    thumbnails: null,
                    publish_date: null,
                    tag_id: null
                },

                title: '',
                body_one: '',
                body_two: '',
                body_three: '',
                body_four: '',
                summary: '',
                thumbnails: '',
                publish_date: '',
                selectedTags: null,
                tags: null
            };
        },

        computed: {
            thumbnailsArray() {
                let array = this.thumbnails.split(',');
                array.forEach(function (element, index, data) {
                    let value = element.trim();

                    // we need to make sure that the element is not
                    // empty, if so, we remove it from the array.
                    if (value == '') {
                        return data.splice(index, 1);
                    }
                    data[index] = value;
                });
                return array;
            }
        },

        created() {
            this.$http.get('/tags').then(function (response) {
                this.tags = response.data;
            }, function () {
                this.tags.push({name: 'Error, no se puede procesar tags.'});
            });
        },

        methods: {
            store() {
                let post = {
                    title: this.title,
                    body_one: this.body_one,
                    body_two: this.body_two,
                    body_three: this.body_three,
                    body_four: this.body_four,
                    summary: this.summary,
                    thumbnails: this.thumbnailsArray,
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
