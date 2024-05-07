@extends('base')
@section('title')
    Invitation - Formeoo
@endsection
@vite(['resources/css/login.css'])

@section('content')
    <div class="container-fluid">
        <div class="row d-flex flex-row justify-content-center align-items-center mt-3 vh-100">
            <div class="col-md-12 col-lg-6 d-flex flex-column">
                <h5> Inviter un nouveau utisateur</h5>

                @if(session('error_msg'))
                    <div class="m-1 small text-danger">{{ session('error_msg') }}</div>
                @endif

                <div class="mt-1 p-1">
                    <!-- login form -->
                    <form method="post" action="{{ Route('new.invitation') }}">
                        @csrf
                        <div class="p-1 d-flex flex-row align-items-center">
                            <label for="role">Role </label>
                            <select id="role" name="role" class="form-control ml-2 w-25" required>
                                <option value="apprenant" selected>Apprenant</option>
                                <option value="formateur">Formateur</option>
                            </select>
                        </div>

                        <!-- apprenant-space -->
                        <div class="apprenant-space">
                            <input class="form-control rounded-5" type="text" name="first_name" id="first_name" placeholder="Nom" maxlength="100"  required/>

                            <input class="form-control rounded-5 mt-2" type="text" name="last_name" id="last_name" placeholder="Prénom" maxlength="100"  required/>
                        </div>
                        <!-- ./apprenant-space -->

                        <input class="form-control rounded-5 mt-4 " type="email" name="email" id="email" placeholder="Email" required />

                        <div class="row mt-3 p-3">
                            <input type="submit" class="btn text-white bg-primary-color" value="Inviter" />
                        </div>
                    </form>
                    <!-- ./login form -->
                </div>

            </div>

        </div>
    </div>
@endsection
