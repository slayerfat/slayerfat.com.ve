export function getCurrentUser(http) {
    let user = {admin: false};

    // http://www.html5rocks.com/en/tutorials/es6/promises/
    return new Promise(function (resolve, reject) {
        http.get('users/current').then(function (response) {
            resolve(response.data);
        }, function () {
            reject(user);
        });
    });
}
