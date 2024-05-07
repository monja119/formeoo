<div class="p-3">
    <div class="row ">
        @foreach($formations as $formation)
            <div class="col-4 mt-1">
                <a href="{{ Route('show.formation', ['id' => $formation->id ]) }}">
                <div class="col-12 card hover-scale-1 shadow animation-slide-in animation-duration-1">
                    <div class="card-header d-flex flex-column">
                        <span class="card-title main-color">
                                {{ $formation->titre }}
                        </span>
                    </div>
                    <div class="card-body small">
                        <!-- formation information -->
                        <div class="">
                            <i class="fa  fa-user"></i>
                            <span class="opacity-75">{{ $formation->first_name.' '.$formation->last_name }} </span>
                        </div>
                        <div class="date">
                            <i class="fa fa-calendar-days main-color"></i>
                            <span class="opacity-75 ml-1"> {{ $formation->date }} </span>
                        </div>
                        <div class="time">
                            <i class="fa fa-clock main-color"></i>
                            <span class="opacity-75 ml-1 text-success"> {{ substr($formation->heure_debut,0, 5) }} - {{ substr($formation->heure_fin,0, 5) }} </span>
                        </div>
                        <div class="lieu">
                            <i class="fa fa-map-marker-alt main-color"></i>
                            <span class="opacity-75 ml-1"> {{ $formation->lieu }} </span>
                        </div>
                        <!-- ./formation information -->
                    </div>
                </div>
                </a>
            </div>
    @endforeach
    </div>
</div>
