<template>
    <div class="top-bar">
        <div class="top-bar-left">
            <ul class="dropdown menu" data-dropdown-menu>
                <li><a v-link="{path: '/'}">slayerfat.com.ve</a></li>
                <li v-for="link in localLinks">
                    <a v-link="link.url" :title="link.title">
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
                localLinks: data.localLinks
            };
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
