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
            <dl v-for="tag in tags">
                <dt @dblclick="startEdit(tag)" v-show="tag != editedTag">
                    {{ tag.name }}
                    <i class="fa fa-times float-right delete-tag" @click="remove(tag)"></i>
                </dt>
                <input class="edit"
                       v-show="tag == editedTag"
                       type="text" v-model="tag.name"
                       @blur="doneEdit(tag)"
                       @keyup.enter="doneEdit(tag)"
                       @keyup.esc="cancelEdit(tag)"
                >
                <p class="help-text" v-if="updateInputErrors && (tag == editedTag || tag == deletedTag)">
                    Acción Invalida. <span v-for="msg in errorMsg.name">{{ msg }}</span>
                </p>
            </dl>
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

                // flag that allows the error message to show when updating.
                updateInputErrors: false,

                // the error message text.
                errorMsg: '',

                // the tags in the system.
                tags: [],

                // the last edited Tag.
                editedTag: null,

                // the last edited tag.
                deletedTag: null,

                // the cache where we store the name of the tag.
                beforeEditCache: null,

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
                this.$set('tags', [{name: 'Error inesperado en el servidor.'}])
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

                    // if the server returns a string, then probably is a html string 500 response.
                    if (typeof response == "string") {
                        return this.errorMsg = 'Error inesperado.';
                    }
                    this.errorMsg = response.data;
                });
            },

            startEdit(tag) {
                this.beforeEditCache = tag.name;
                this.editedTag = tag;
            },

            doneEdit(tag) {
                tag.name = tag.name.trim();
                if (!this.editedTag || !tag.name) {
                    return;
                }
                this.editedTag = null;

                this.resource.update({id: tag.id}, {name: tag.name}).then(function () {
                    console.log('tag updated');
                }, function (response) {
                    this.editedTag = tag;
                    this.createUpdateErrorMsg(response);
                });
            },

            remove(tag) {
                this.resource.delete({id: tag.id}).then(function () {
                    this.deletedTag = null;
                    this.tags.$remove(tag);
                }, function (response) {
                    // necessary for msg to show
                    this.deletedTag = tag;
                    this.createUpdateErrorMsg(response);
                });
            },

            createUpdateErrorMsg(response) {
                this.updateInputErrors = true;

                // if the server returns a string, then probably is a html string 500 response.
                if (response.status === 500) {
                    return this.errorMsg = [{name: 'Error inesperado.'}];
                }
                this.errorMsg = response.data;
            },

            cancelEdit(tag) {
                this.editedTag = null;
                tag.name = this.beforeEditCache;
                this.beforeEditCache = null;

                // check the tags and filter then to find the tag being edited.
                this.tags.filter(function (element, index) {
                    if (tag.id === element.id) {
                        this.tags[index] = tag;
                    }
                }.bind(this));
            }
        },

        components: {
            Navbar,
            MyFooter
        }
    };
</script>

<style>
    .delete-tag {
        color: #EC5840;
    }
</style>
