<template>
    <navbar></navbar>
    <div class="row">
        <div class="medium-8 medium-offset-2 columns">
            <h1>Etiquetas en el sistema</h1>
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
                error: false,
                names: [],
                nameModel: ''
            };
        },

        components: {
            Navbar,
            MyFooter
        }
    };
</script>
