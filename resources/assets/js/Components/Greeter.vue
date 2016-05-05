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
    import data from "./data/greeterData";
    export default {
        data () {
            return data;
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
