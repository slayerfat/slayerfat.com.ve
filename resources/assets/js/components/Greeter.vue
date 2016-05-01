<template>
    <div class="greeter">
        <div class="greeter-contents">
            <div class="row">
                <div class="column large-12">
                    <h1>{{ name }}</h1>
                </div>
            </div>
            <div class="row align-spaced">
                <div v-for="link in links" class="small-12 medium-2 columns">
                    <a :href="link.url">{{ link.name }}</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                name: 'Alejandro Granadillo Palau',

                links: [
                    {name: 'Videos', url: '/videos'},
                    {name: 'Blog', url: '/blog'},
                    {name: 'Twitter', url: 'http://www.twitter.com/slayerfat'},
                    {name: 'Facebook', url: 'http://www.facebook.com/slayerfat'},
                    {name: 'G+', url: 'https://plus.google.com/112944288001461665013'},
                    {name: 'Github', url: 'http://www.github.com/slayerfat'}
                ]
            };
        }
    };
</script>

<style>
    .greeter {
        width: 100%;
        height: 100%;
        position: relative;
        display: table;
        text-align: center;
    }

    .greeter-contents {
        display: table-cell;
        vertical-align: middle;
    }
</style>
