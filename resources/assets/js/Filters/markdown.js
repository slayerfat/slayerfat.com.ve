/**
 * Parse text into markdown with code parsing capabilities.
 *
 * @link https://github.com/chjj/marked
 * @param value
 * @returns Object
 */
export function markdown(value) {
    var marked = require('marked');
    marked.setOptions({
        langPrefix: 'hljs ', // workaround https://github.com/chjj/marked/pull/418

        highlight: function (code) {
            return require('highlight.js').highlightAuto(code).value;
        }
    });
    return marked(value);
}
