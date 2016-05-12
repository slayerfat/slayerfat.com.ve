/**
 * Returns a random index of an array.
 *
 * @param value
 * @returns {*}
 */
export function arrayRandom(value) {
    return value[Math.floor(Math.random() * value.length)];
}
