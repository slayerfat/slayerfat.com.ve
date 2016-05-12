<template>
    <div class="greeter">
        <div class="greeter-contents">
            <div class="row">
                <div class="column large-12">
                    <h1 class="greeter-name">{{ name }}</h1>
                    <p class="greeter-desc">{{ currentDesc }}</p>
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
