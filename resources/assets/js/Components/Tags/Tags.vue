<template>
    <navbar></navbar>
    <div class="row">
        <div class="medium-8 medium-offset-2 columns">
            <h2>Etiquetas en el sistema</h2>
            <div>
                <input v-if="showCreateInput" type="text" title="nueva etiqueta" v-model="name" name="name">
                <div class="button-group">
                    <a v-if="showCreateInput" type="button" class="button" @click="storeTag()">
                        Crear
                    </a>
                    <a
                            type="button"
                            class="button"
                            :class="{'secondary': showCreateInput}"
                            @click="showCreateInput = !showCreateInput"
                    >
                        <span v-if="showCreateInput">Cancelar</span>
                        <span v-else>Crear</span>
                    </a>
                </div>
            </div>
            <p class="help-text" v-if="createInputErrors">
                Etiqueta Invalida. <span v-for="msg in errorMsg.name">{{ msg }}</span>
            </p>
        </div>

        <div class="medium-8 medium-offset-2 columns">
            <p v-for="tag in tags">
                {{ tag.name }}
            </p>
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
                // flag that allows the input field to show.
                showCreateInput: false,

                // flag that allows the error message to show.
                createInputErrors: false,

                // the error message text.
                errorMsg: '',

                // the tags in the system.
                tags: [],

                // the name of a new tag.
                name: '',

                // the tag ajax http resource.
                resource: null
            };
        },

        created() {
            // the {/id} is important.
            // https://github.com/vuejs/vue-resource/blob/master/docs/resource.md
            this.resource = this.$resource('tags{/id}');

            this.resource.get().then(function (response) {
                this.$set('tags', response.data)
            }, function () {
                console.log('Error tags.')
            });
        },

        methods: {
            storeTag() {
                this.resource.save({name: this.name}).then(function (response) {
                    this.tags.push(response.data);
                    this.showCreateInput = false;
                    this.name = '';
                }, function (response) {
                    this.createInputErrors = true;
                    this.errorMsg = response.data;
                });
            }
        },

        components: {
            Navbar,
            MyFooter
        }
    };
</script>
