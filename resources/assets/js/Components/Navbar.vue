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

                <li v-for="link in maintenanceLinks" v-if="isAdmin">
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
    import {makeComponentsUser} from "./../makeComponentsUser";
    export default {
        data () {
            return {
                localLinks: data.localLinks,

                maintenanceLinks: data.maintenanceLinks,

                // the current user object
                user: null,

                // current user admin status
                isAdmin: false
            };
        },

        created() {
            makeComponentsUser(this).then(function (user) {
                this.$set('user', user);
                if (user.admin) {
                    this.$set('isAdmin', user.admin);
                }
            }.bind(this), function (user) {
                this.$set('user', user);
            }.bind(this));
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
