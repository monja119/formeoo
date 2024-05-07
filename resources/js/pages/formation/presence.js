let btn_presence  = document.querySelectorAll('.btn-presence')
function button_state_change(id){
    let button =document.querySelector('#'+id)
    // split id
    let id_split = id.split('_')
    let formation_id = id_split[2]
    let apprenant_id = id_split[3]

    if(button.innerText === 'non') {
        button.classList.remove('btn-danger')
        button.classList.add('btn-success')
        button.innerText = 'oui'

        // participer vers server
        let url = '/participation/'+formation_id+'/participate/'+apprenant_id

        fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        })


    }
    else {
        button.classList.remove('btn-success')
        button.classList.add('btn-danger')
        button.innerText = 'non'

        // annuler participation vers server
        let url = '/participation/'+formation_id+'/annuller/'+apprenant_id

        fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            }
        })

    }
}


btn_presence.forEach(function (item)
    {
        item.addEventListener('click', function () {
            button_state_change(item.id)
        });
    }
)
