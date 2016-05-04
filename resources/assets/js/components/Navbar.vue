<template>
    <div class="top-bar">
        <div class="top-bar-left">
            <ul class="dropdown menu" data-dropdown-menu>
                <li><a href="/">slayerfat.com.ve</a></li>
                <li v-for="link in links">
                    <a :href="link.url" :title="link.title">
                        <i :class="link.className | fontAwesomeClass"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import data from "./data/greeterData";
    export default {
        data () {
            return {
                links: data.links
            };
        },

        created() {
            this.links = [this.links[0], this.links[1]];
        }
    };
</script>

<style>
    .top-bar, .top-bar ul {
        background-color: #504C4C;
    }

    .top-bar a, .top-bar {
        color: white;
    }
</style>
