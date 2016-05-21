export function imgurlImageResizer(url, type) {
    if (url) {
        let regExp = /imgur.com\/(.*?)(.png|.gif|.jpeg|.jpg|.bmp|.tiff|.svg)/;
        let results = url.split(regExp);

        if (results) {
            // results[0] is the beginning (i.imgur.com)
            return "http://i.imgur.com/" + results[1] + type + results[2];
        }

        return url;
    }

    return "http://i.imgur.com/Cbo4G.png";
}
