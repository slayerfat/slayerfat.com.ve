<template>
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
</template>

<script>
    export default {
        data () {
            return {
                videos: [],

                html: ''
            };
        },

        created() {
            this.$http.get('/videos/uploads/latest', function (videos) {
                videos.forEach(function(video, index, videos) {
                    video.url = `https://www.youtube.com/embed/${video.contentDetails.videoId}`;
                    videos[index] = video;
                });
                this.videos = videos;
            });
        }
    };
</script>

<style>

</style>
