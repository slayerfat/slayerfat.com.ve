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
                    <h1>
                        <a :href="link.url" :title="link.title">
                            <i :class="link.className | fontAwesomeClass"></i>
                            {{ link.name }}
                        </a>
                    </h1>
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
                    'PHP 7 > PHP 5.',
                    'Creador del Código T, los Trululus, Maria Sofia y Cafe Pedro Lopez.',
                    'Saaaaaaaaaaaludos a todos!',
                    'También conocido como wachi.',
                    'slayerfat, el único e inigualable, campeón del Código A, S y T en Starcraft 2.',
                    'Control de version de código fuente.',
                    'Adicto innecesario del perfeccionismo, lo correcto y lo exacto.',
                    'Narrador, comentarista, aficionado de los números, amante de los Zerg.',
                    'Creador de contenidos multimedia web 2.0',
                    'Mago de entidades, relaciones y flujo de datos nivel 8.',
                    'Modelo, Vista, Controlador, Entidad, Relación, Metodología.'
                ],

                links: [
                    {title: 'Blog de Alejandro slayerfat Granadillo', url: '/blog', className: 'pencil'},
                    {title: 'Videos en youtube de Alejandro slayerfat Granadillo', url: '/videos', className: 'play'},
                    {
                        title: 'Alejandro slayerfat Granadillo en twitter @slayerfat',
                        url: 'http://www.twitter.com/slayerfat',
                        className: 'twitter'
                    },
                    {
                        title: 'Alejandro slayerfat Granadillo en Facebook',
                        url: 'http://www.facebook.com/slayerfat',
                        className: 'facebook'
                    },
                    {
                        title: 'Alejandro slayerfat Granadillo en google plus',
                        url: 'https://plus.google.com/112944288001461665013',
                        className: 'google-plus'
                    },
                    {
                        title: 'Perfil en Github de Alejandro slayerfat Granadillo',
                        url: 'http://www.github.com/slayerfat',
                        className: 'github'
                    }
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
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-color: #464646;
        width: 100%;
        height: 100%;
        position: relative;
        display: table;
        text-align: center;
        color: white;
        text-shadow: 0 0 10px black;
    }

    .greeter-contents {
        background-color: rgba(10, 10, 10, 0.3);
        display: table-cell;
        vertical-align: middle;
    }
</style>
