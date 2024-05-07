<style>
    .list:hover{
        border-bottom: 1px solid black;
    }
</style>
<div class="container-fluid">
        @if($formateurs->count() == 0)
            <div class="row mb-2 fw-bold main-color ">
                <div class="col-12 d-flex flex-row justify-content-center align-items-center">
                    Aucun formateur
                </div>
            </div>
        @else
            <div class="row mb-2 fw-bold main-color">
                <div class="col-6">
                    Nom complet
                </div>
                <div class="col-3">
                    Email
                </div>
                <div class="col-3">
                    Date d'inscription
                </div>
            </div>
            @foreach($formateurs as $formateur)
            <a href="/user/{{ $formateur->id }}">
                <div class="row list mt-1 pt-2 pb-2 bold-hover">
                    <div class="col-6">
                        {{ $formateur->first_name }}
                        {{ $formateur->last_name }}
                    </div>
                    <div class="col-3">
                        {{ $formateur->email }}
                    </div>
                    <div class="col-3">
                        {{ $formateur->created_at }}
                    </div>
                </div>
            </a>
            @endforeach
        @endif
</div>

