<template>
    {{{ $data.html }}}
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
                this.videos = videos;
                let that = this;
                let row = '<div class="row">';
                let column = '<div class="column  large-3 small-6">';
                let tail = '</div>';
                let i = 0;

                this.videos.forEach(function (video) {
                    if (i === 0) {
                        that.html = that.html + row;
                    }

                    that.html = that.html + column
                            + `<div style="min-height: 180px">
                            <img
                            class="thumbnail lazy-img"
                            data-original="${video.snippet.thumbnails.high.url}"
                            ></div>`
                            + tail;

                    i++;

                    if (i === 4) {
                        that.html = that.html + tail;
                        i = 0;
                    }
                });
            });
        }
    };
</script>

<style>

</style>
