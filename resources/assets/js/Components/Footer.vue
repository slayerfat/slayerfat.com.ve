<template>
    <footer class="footer-center">
        <div class="row align-spaced">
            <div v-for="link in localLinks" class="small-12 medium-2 columns">
                <h1>
                    <a v-link="link.url" :title="link.title">
                        <i :class="link.className | fontAwesomeClass"></i>
                        {{ link.name }}
                    </a>
                </h1>
            </div>
            <div v-for="link in links" class="small-12 medium-2 columns">
                <h1>
                    <a v-link="link.url" :title="link.title">
                        <i :class="link.className | fontAwesomeClass"></i>
                        {{ link.name }}
                    </a>
                </h1>
            </div>
        </div>

        <h1 class="footer-authors">
            <a href="https://github.com/slayerfat">slayerfat</a>
            © {{ date.getFullYear() }}
        </h1>

        <h1 class="text-center">
            <a href="https://github.com/slayerfat/slayerfat.com.ve"
               title="Ver código fuente"
            >
                <i class="fa fa-2x fa-github-alt"></i>
            </a>
        </h1>
    </footer>
</template>

<script>
    import data from "./data/greeterData";
    export default {
        data () {
            return {
                localLinks: data.localLinks,
                links: data.links,

                date: new Date()
            };
        }
    };
</script>

<style>
    .footer-center {
        background: linear-gradient(#f9f9f9, white);
        border-top: 1px solid #f2f2f2;
        margin-top: 1em;
        padding: 50px;
        width: 100%;
        text-align: center;
    }

    .footer-authors {
        letter-spacing: 2px;
        margin: 2em 0;
        font-family: Consolas, Menlo, Monaco, monospace;
    }
</style>
