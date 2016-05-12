import {getCurrentUser} from "./getCurrentUser";

/**
 * Makes an user object for a vue component.
 *
 * @param $vm
 * @returns {Promise}
 */
export function makeComponentsUser($vm) {
    // http://www.html5rocks.com/en/tutorials/es6/promises/
    return new Promise(function (resolve, reject) {
        if ($vm.user === null) {
            if (typeof $vm.$router.user === 'object') {
                resolve($vm.$router.user);
            } else {
                getCurrentUser($vm.$http).then(function (user) {
                    resolve(user);
                }, function () {
                    console.log('user failed');

                    reject(null);
                });
            }
        }
    });
}
