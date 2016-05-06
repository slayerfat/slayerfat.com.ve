<template>
    <navbar></navbar>
    <div class="row posts">
        <div class="small-12 columns">
            <form>
                <label>Título
                    <input type="text" name="title">
                </label>

                <label>Cuerpo
                    <textarea name="body" rows="10"></textarea>
                </label>

                <button type="submit" class="button">
                    <i class="fa fa-sign-in"></i> Entrar
                </button>
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
            return;
        },

        created() {

        },

        methods: {
            store() {
                this.$http.get().then(function (response) {
                    this.$set('posts', response.data)
                }, function () {
                    this.$set('posts', [{title: 'Error inesperado en el servidor.'}])
                });
            }
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
</style>
