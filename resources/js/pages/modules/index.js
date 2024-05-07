let btn_adds = document.querySelectorAll('input[value="Ajouter"]');


function removingItem(id) {
    let item = document.getElementById(id);
    item.remove();
}

function updatingList(){
    let list = document.querySelectorAll('li');
    let remove_items = document.querySelectorAll('.remove-item');

    remove_items.forEach(function (remove_item) {
        remove_item.addEventListener('click', function () {
            removingItem(remove_item.id);
        });
    });
}


btn_adds.forEach(function (btn_add) {
    btn_add.addEventListener('click', function () {
        let input = document.getElementById('input-add-'+ btn_add.id);
        let list = document.getElementById('list-'+ btn_add.id);

        if(input.value !== ''){
            let li = document.createElement('li');
            let count = list.getElementsByTagName('li').length;
            li.id = btn_add.id +'-' +count;

            li.innerHTML =
                `
                    <span>
                        ` + input.value + `
                    </span>
                    <i id="` + btn_add.id+'-'+count + `"  class="remove-item ml-1 mt-1 cursor-pointer fa fa-remove text-danger"> </i>
                `;

            list.appendChild(li);
            input.value = '';

            updatingList();
        }
    })
});



// posting data
let submit = document.getElementById('submit');


submit.addEventListener('click', function () {
    submit.disabled = true;
    submit.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';

    let error = document.getElementById('error');
    let titre = document.getElementById('titre').value;
    let description = document.getElementById('description').value;
    let module_id = null;

    if(titre === ''){
        error.innerText = 'Veuillez fournir un titre';
        submit.disabled = false;
        submit.innerHTML = 'Valider';
        return;
    }
    // posting titre and description as module by xhr
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '/module/new', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

    xhr.onreadystatechange = function () {
        if(xhr.readyState === 4 && xhr.status === 201){
            let $response = JSON.parse(xhr.responseText);
            module_id = $response.module.id;

            // posting other data
            const list_data = ['objectif', 'competence', 'prerequis'];

            list_data.forEach(function (data) {
                let current_list = document.getElementById('list-' + data);
                let items = current_list.getElementsByTagName('li');

                let items_data = [];

                for (let i = 0; i < items.length; i++) {
                    items_data.push(items[i].getElementsByTagName('span')[0].innerText);
                }

                // if data not null
                if(items_data.length !== 0) {

                    let xhr = new XMLHttpRequest();
                    xhr.open('POST', '/'+ data + '/new', true);
                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                    xhr.send(JSON.stringify({
                        items: items_data,
                        module_id: module_id
                    }));
                }

            });

            // finishing
            window.location.href = '/module/' + module_id;

        }
    }

    // on error
    xhr.onerror = function () {
        submit.disabled = false;
        submit.innerHTML = 'Valider';
        error.innerText = 'Une erreur est survenue, veuillez réessayer';
    }

    xhr.send(JSON.stringify({
        titre: titre,
        description: description
    }));

});
