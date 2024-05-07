import host from "../../settings/host.js";

let contentUser = document.getElementById('content-user');
let navUser = document.querySelectorAll('.nav-user');

// initiliazing content user by xhr
let url = host + '/users/apprenants';
var xhr = new XMLHttpRequest();
xhr.open('GET', url, true);
xhr.onload = function () {
    if (this.status === 200) {
        contentUser.innerHTML = this.responseText;
    }
}
xhr.send();


// changing content user by xhr as the nav user is clicked
navUser.forEach(function (item, index) {
    item.addEventListener('click', function () {
        let url = host + '/users/' + item.id;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
        xhr.onload = function () {
            if (this.status === 200) {
                contentUser.innerHTML = this.responseText;
            }
        }
        xhr.send();
    });
});



