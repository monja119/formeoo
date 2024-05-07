@extends('base')
@section('title')
    Notifications - formeoo
@endsection

@section('content')
    <div class="row mt-3">
        <div class="col-3">
            <h1>
                Notifications
            </h1>
        </div>
        <div class="col-9 ">
            <form method="post" action="{{ Route('rechercher') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mt-2 justify-content-end align-items-center">
                    <div class="col-8">
                        <input type="text" class="form-control rounded-5" name="recherche" id="recherche" required/>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="rounded-5 btn btn-primary w-100 p-2">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- notifications -->
    <div class="row mt-3">
        <div class="col-12 small">

            <!-- item -->
            @foreach($notifications as $notification)
                <a href="{{ $notification->lien }}">
                    <div class="row p-1 mt-1 d-flex flex-row flex-nowrap border-bottom bold-hover cursor-pointer"
                        style="background-color: {{ $notification->statut == 'non lu' ? '#e6e6e6' : 'none' }};"
                    >
                        <div class="col-1 text-center">
                            @if($notification->type === 'module')
                                <i class="fa fa-book text-primary fa-2x mb-2"></i>
                            @elseif($notification->type === 'formation')
                                <i class="fa fa-suitcase text-primary fa-2x"></i>
                            @elseif($notification->type === 'reminder')
                                <i class="fa fa-clock-four text-warning fa-2x"></i>
                            @elseif($notification->type === 'dashbord')
                                <i class="fa fa-dashboard text-success fa-2x"></i>
                            @elseif($notification->type === 'user')
                                <i class="fa fa-user fa-2x"></i>
                            @endif
                        </div>
                        <div class="col-10  align-items-center">
                            {{ $notification->contenu }}
                        </div>
                    </div>
                </a>
            @endforeach
            <!-- ./item -->
            <!-- item -->
            <div class="row p-1 mt-1 d-flex flex-row flex-nowrap border-bottom bold-hover cursor-pointer ">
                <div class="col-1 text-center">
                    <i class="fa fa-suitcase text-primary fa-2x"></i>
                </div>
                <div class="col-10  align-items-center">
                    Une nouvelle formation sur  <span class="fw-bold ml-1 main-color"> Cybersecurité </span> a été ajoutée
                    qui aura lieu le <span class="fw-bold ml-1"> 12/08/2023 </span> à <span class="fw-bold ml-1"> 12:00 </span>
                    jusqu'à <span class="fw-bold ml-1"> 14:00 </span> dans <span class="fw-bold ml-1"> la salle 12 </span>
                </div>
            </div>
            <div class="row p-1 mt-1 d-flex flex-row flex-nowrap border-bottom bold-hover cursor-pointer ">
                <div class="col-1 text-center">
                    <i class="fa fa-suitcase text-primary fa-2x"></i>
                </div>
                <div class="col-10  align-items-center">
                    Une nouvelle formation sur  <span class="fw-bold ml-1 main-color"> Le leadership </span> a été ajoutée
                    qui aura lieu le <span class="fw-bold ml-1"> 12/08/2023 </span> à <span class="fw-bold ml-1"> 12:00 </span>
                    jusqu'à <span class="fw-bold ml-1"> 14:00 </span> à <span class="fw-bold ml-1">ESTI Antanimena </span>
                </div>
            </div>
            <div class="row p-1  mt-2 mb-3 pb-3 d-flex flex-row flex-nowrap border-bottom bold-hover cursor-pointer ">
                <div class="col-1 text-center">
                    <i class="fa fa-clock-four text-warning fa-2x"></i>
                </div>
                <div class="col-10  align-items-center">
                    Une formation aura lieu aujourd'hui  <span class="fw-bold ml-1 main-color"> Le leadership </span>  à <span class="fw-bold ml-1"> 12:00 </span>
                    jusqu'à <span class="fw-bold ml-1"> 14:00 </span> à <span class="fw-bold ml-1">ESTI Antanimena </span>
                </div>
            </div>
            <div class="row p-1  mt-1 pb-3 d-flex flex-row flex-nowrap border-bottom bold-hover cursor-pointer ">
                <div class="col-1 text-center">
                    <i class="fa fa-user fa-2x"></i>
                </div>
                <div class="col-10  align-items-center">
                    Vous avez été inscrit à la formation <span class="fw-bold ml-1 main-color"> Le leadership </span>  à <span class="fw-bold ml-1"> 12:00 </span>
                    jusqu'à <span class="fw-bold ml-1"> 14:00 </span> à <span class="fw-bold ml-1">ESTI Antanimena </span>
                </div>
            </div>
            <div class="row p-1  mt-2 mb-3 pb-3 d-flex flex-row flex-nowrap border-bottom bold-hover cursor-pointer ">
                <div class="col-1 text-center">
                    <i class="fa fa-dashboard text-success fa-2x"></i>
                </div>
                <div class="col-10  align-items-center">
                    Voir votre <span class="fw-bold ml-1 main-color"> Dashboard </span> pour plus de détails sur vos formations, vos inscriptions et vos évolutions
                </div>
            </div>
            <div class="row p-1 mt-1 d-flex flex-row flex-nowrap border-bottom bold-hover cursor-pointer ">
                <div class="col-1 text-center">
                    <i class="fa fa-suitcase text-primary fa-2x"></i>
                </div>
                <div class="col-10  align-items-center">
                    Une nouvelle formation sur  <span class="fw-bold ml-1 main-color"> Le leadership </span> a été ajoutée
                    qui aura lieu le <span class="fw-bold ml-1"> 11/08/2023 </span> à <span class="fw-bold ml-1"> 12:00 </span>
                    jusqu'à <span class="fw-bold ml-1"> 14:00 </span> à <span class="fw-bold ml-1">ESTI Antanimena </span>
                </div>
            </div>
            <div class="row p-1  mt-2 mb-3 pb-3 d-flex flex-row flex-nowrap border-bottom bold-hover cursor-pointer ">
                <div class="col-1 text-center">
                    <i class="fa fa-clock-four text-warning fa-2x"></i>
                </div>
                <div class="col-10  align-items-center">
                    Une formation aura lieu aujourd'hui  <span class="fw-bold ml-1 main-color"> Cybersécurité </span>  à <span class="fw-bold ml-1"> 14:00 </span>
                    jusqu'à <span class="fw-bold ml-1"> 16:00 </span> à <span class="fw-bold ml-1"> salle 12 </span>
                </div>
            </div>
            <div class="row p-1  mt-2 mb-3 pb-3 d-flex flex-row flex-nowrap border-bottom bold-hover cursor-pointer ">
                <div class="col-1 text-center">
                    <i class="fa fa-clock-four text-warning fa-2x"></i>
                </div>
                <div class="col-10  align-items-center">
                    Une formation aura lieu aujourd'hui  <span class="fw-bold ml-1 main-color"> Le leadership </span>  à <span class="fw-bold ml-1"> 12:00 </span>
                    jusqu'à <span class="fw-bold ml-1"> 14:00 </span> à <span class="fw-bold ml-1">ESTI Antanimena </span>
                </div>
            </div>
            <div class="row p-1  mt-1 pb-3 d-flex flex-row flex-nowrap border-bottom bold-hover cursor-pointer ">
                <div class="col-1 text-center">
                    <i class="fa fa-user fa-2x"></i>
                </div>
                <div class="col-10  align-items-center">
                    Vous avez été inscrit à la formation <span class="fw-bold ml-1 main-color"> Le leadership </span>  à <span class="fw-bold ml-1"> 12:00 </span>
                    jusqu'à <span class="fw-bold ml-1"> 14:00 </span> à <span class="fw-bold ml-1">ESTI Antanimena </span>
                </div>
            </div>
            <div class="row p-1 mt-1 d-flex flex-row flex-nowrap border-bottom bold-hover cursor-pointer ">
                <div class="col-1 text-center">
                    <i class="fa fa-suitcase text-primary fa-2x"></i>
                </div>
                <div class="col-10  align-items-center">
                    Une nouvelle formation sur  <span class="fw-bold ml-1 main-color"> Cybersecurité </span> a été ajoutée
                    qui aura lieu le <span class="fw-bold ml-1"> 12/08/2023 </span> à <span class="fw-bold ml-1"> 12:00 </span>
                    jusqu'à <span class="fw-bold ml-1"> 14:00 </span> dans <span class="fw-bold ml-1"> la salle 12 </span>
                </div>
            </div>
            <!-- ./item -->
        </div>
    </div>
    <!-- ./notifications -->
@endsection
