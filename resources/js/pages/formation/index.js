import host from "../../settings/host.js";

let contentFormation = document.getElementById('content-formation');
let navFormation = document.querySelectorAll('.nav-formation');

// initiliazing content formation by xhr
let url = host + '/formation/all';
var xhr = new XMLHttpRequest();
xhr.open('GET', url, true);
xhr.onload = function () {
    if (this.status === 200) {
        contentFormation.innerHTML = this.responseText;
    }
}
xhr.send();


// changing content formation by xhr as the nav formation is clicked
navFormation.forEach(function (item, index) {
    item.addEventListener('click', function () {
        let url = host + '/formation/' + item.id;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
        xhr.onload = function () {
            if (this.status === 200) {
                contentFormation.innerHTML = this.responseText;
            }
        }
        xhr.send();
    });
});


