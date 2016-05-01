<template>
    <div class="greeter">
        <div class="greeter-contents">
            <div class="row">
                <div class="column large-12">
                    <h1>{{ name }}</h1>
                    <p>{{ currentDesc }}</p>
                </div>
            </div>
            <div class="row align-spaced">
                <div v-for="link in links" class="small-12 medium-2 columns">
                    <a :href="link.url">
                        <i :class="link.className | fontAwesomeClass"></i>
                        {{ link.name }}
                    </a>
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

                currentDesc: '',

                descList: [
                    'Programación, ingeniería de software, estructura de datos y mas.',
                    'Creador del Código T, los Trululus, Maria Sofia y Cafe Pedro Lopez.',
                    'Saaaaaaaaaaaludos a todos!',
                    'Narrador, comentarista, aficionado de los números, amante de los Zerg.',
                    'Creador de contenidos multimedia web 2.0',
                    'Mago manipulador de entidades y relaciones nivel 10',
                    'Modelo, Vista, Controlador, Entidad, Relación, Metodología.'
                ],

                links: [
                    {url: '/blog', className: 'pencil'},
                    {url: '/videos', className: 'play'},
                    {url: 'http://www.twitter.com/slayerfat', className: 'twitter'},
                    {url: 'http://www.facebook.com/slayerfat', className: 'facebook'},
                    {url: 'https://plus.google.com/112944288001461665013', className: 'google-plus'},
                    {url: 'http://www.github.com/slayerfat', className: 'github'}
                ]
            };
        },

        methods: {
            changeDesc () {
                return this.currentDesc = this.getRandomDesc();
            },

            getRandomDesc () {
                return this.descList[Math.floor(Math.random() * this.descList.length)];
            }
        },

        created() {
            this.changeDesc();

            setInterval(this.changeDesc, 10000);
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
