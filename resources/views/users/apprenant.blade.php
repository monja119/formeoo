<style>
    .list:hover{
        border-bottom: 1px solid black;
    }
</style>
<div class="container-fluid">
        @if($apprenants->count() == 0)
            <div class="row mb-2 fw-bold main-color ">
                <div class="col-12 d-flex flex-row justify-content-center align-items-center">
                    Aucun apprenant
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
            @foreach($apprenants as $apprenant)
            <a href="/user/{{ $apprenant->id }}">
                <div class="row list mt-1 pt-2 pb-2 bold-hover">
                    <div class="col-6">
                        {{ $apprenant->first_name }}
                        {{ $apprenant->last_name }}
                    </div>
                    <div class="col-3 ellipsis">
                        {{ $apprenant->email }}
                    </div>
                    <div class="col-3">
                        {{ $apprenant->created_at }}
                    </div>
                </div>
            </a>
            @endforeach
        @endif
</div>

