<template>
    <div class="row align-middle loader-wrap" v-show="loading">
        <pulse-loader
                class="columns"
                :loading="loading"
                :color="color"
                :size="size"
        ></pulse-loader>
    </div>
</template>

<script>
    import {PulseLoader} from 'vue-spinner/dist/vue-spinner.min';
    export default {
        data () {
            return {
                color: '#777',
                size: '50px'
            };
        },

        props: {
            loading: {
                type: Boolean,
                default: true
            }
        },

        components: {
            PulseLoader
        }
    };
</script>
