<template>
    <navbar></navbar>
    <loader :loading="loader.loading"></loader>
    <div class="row align-spaced" v-for="video in videos">
        <div class="small-9 columns">
            <div class="flex-video widescreen">
                <iframe width="420" height="315"
                        :src="video.url"
                        frameborder="0" allowfullscreen
                ></iframe>
            </div>
        </div>
    </div>
    <my-footer></my-footer>
</template>

<script>
    import Navbar from "./../Navbar.vue";
    import MyFooter from "./../Footer.vue";
    import Loader from "./../Loader.vue";
    export default {
        data () {
            return {
                loader: {
                    loading: true
                },

                videos: []
            };
        },

        created() {
            this.$http.get('/videos/uploads/latest', function (videos) {
                videos.forEach(function(video, index, videos) {
                    video.url = `https://www.youtube.com/embed/${video.contentDetails.videoId}`;
                    videos[index] = video;
                });
                this.videos = videos;
                this.loader.loading = false;
            });
        },

        components: {
            Navbar,
            MyFooter,
            Loader
        }
    };
</script>
