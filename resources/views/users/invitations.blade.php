
<div class="container-fluid">
    @if($invitations->count() == 0)
        <div class="row mb-2 fw-bold main-color ">
            <div class="col-12 d-flex flex-row justify-content-center align-items-center">
                Aucune invitation envoyée
            </div>
        </div>
    @else
        <div class="row mb-2 fw-bold main-color">
            <div class="col-3">
                Nom complet
            </div>
            <div class="col-3">
                Email
            </div>
            <div class="col-3">
                Date
            </div>
            <div class="col-1">
                Status
            </div>
        </div>
        @foreach($invitations as $invitation)
            <div class="row list mt-1 pt-2 pb-2 bold-hover">
                <div class="col-3">
                    {{ $invitation->first_name }}
                    {{ $invitation->last_name }}
                </div>
                <div class="col-3 ellipsis">
                    {{ $invitation->email }}
                </div>
                <div class="col-3">
                    {{ $invitation->created_at }}
                </div>
                <div class="col-2">
                    @if($invitation->status == 'pending')
                        <span class="text-warning">
                    @elseif($invitation->status == 'accepted')
                        <span class="text-success">
                    @else
                        <span class="text-danger">
                    @endif
                        {{ $invitation->status }}
                        </span>
                </div>
                <div class="col-1 small">
                    @if($invitation->status == 'pending')
                        <i class="text-danger fa fa-cancel cursor-pointer"> </i>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>

