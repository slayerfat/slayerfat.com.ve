import {getCurrentUser} from "./getCurrentUser";
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
