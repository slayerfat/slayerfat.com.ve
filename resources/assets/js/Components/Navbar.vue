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
    import {getCurrentUser} from "./../getCurrentUser";
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
            if  (this.user === null) {
                if (typeof this.$router.user === 'object') {
                    this.$set('user', this.$router.user);
                    this.$set('isAdmin', this.$router.user.admin);
                } else {
                    getCurrentUser(this.$http).then(function(user) {
                        this.$router.user = user;
                        this.$set('user', user);
                        this.$set('isAdmin', user.admin);
                    }.bind(this), function() {console.log('user failed')});
                }
            }
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
