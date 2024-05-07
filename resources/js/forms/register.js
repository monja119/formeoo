var apprenant_space = document.querySelector('.apprenant-space');
var entity_space= document.querySelector('.entity-space');
var account_type = document.querySelector('#account_type');

entity_space.style.display = 'none';
var apprenant_inputs = apprenant_space.querySelectorAll('input');
var entity_inputs = entity_space.querySelectorAll('input');

// make all input in apprenant_space required
apprenant_inputs.forEach(function(input){
    input.required = true;
})

account_type.addEventListener('change', function(){

    if(this.value === 'apprenant'){
        apprenant_space.style.display = 'block';
        entity_space.style.display = 'none';

        // make all input in apprenant_space required
        apprenant_inputs.forEach(function(input){
            input.required = true;
        });

        // make all input in entity_space not required
        entity_inputs.forEach(function(input){
            input.required = false;
        });

    }else{
        apprenant_space.style.display = 'none';
        entity_space.style.display = 'block';

        // make all input in apprenant_space not required

        apprenant_inputs.forEach(function(input){
            input.required = false;
        });

        // make all input in entity_space required
        entity_inputs.forEach(function(input){
            input.required = true;
        });
    }

});
