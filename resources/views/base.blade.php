<html lang="fr">
<?php
    use Illuminate\Support\Facades\DB;

    $notifications = DB::table('notifications')
        ->where('user_id', session()->get('user')->id)
        ->where('statut', 'non lu')
        ->get()
        ->count();
?>
<head>
    <title>@yield('title')</title>
    @vite(['resources/css/bootstrap.min.css'])
    @vite(['resources/css/fontawesome-free/css/all.min.css'])
    @vite(['resources/css/base.css'])
    @vite(['resources/css/responsive.css'])
</head>
<body>


<div class="container-fluid">
    <div class="row">
        <!-- navbar -->
        <div id="navbar" class="position-fixed col-sm-12 col-md-3 col-lg-3 border">
            <a href="{{ Route('home') }}">
                <img src="{{ asset('storage/images/logo.png')  }}" alt="logo"/>
            </a>
            <div class="nav-container">
                <!-- navitems -->
                <a href="{{ Route('formations') }}">
                    <div class="nav-group">
                        <div>
                            <i class="fa fa-navbar fa-suitcase "></i>
                        </div>
                        <span class="d-none d-lg-block nav-item"> Formations </span>
                    </div>
                </a>
                @can('admin')
                <a href="{{ Route('users') }}">
                    <div class="nav-group">
                        <div>
                            <i class="fa fa-navbar fa-users"></i>
                        </div>
                        <span class="d-none d-lg-block nav-item"> Utilisateurs </span>
                    </div>
                </a>
                @endcan
                <a href="{{ Route('rechercher') }}">
                    <div class="nav-group ">
                        <div>
                            <i class="fa fa-navbar fa-search "></i>
                        </div>
                        <span class="d-none d-lg-block nav-item"> Rechercher </span>
                    </div>
                </a>

                <a href="{{ Route('notifications') }}">
                    <div class="nav-group">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            @if($notifications > 0)
                                <div class="mb-3 ml-5 position-absolute bg-danger text-white rounded-circle" style="width: 20px; height: 20px;font-size: 13px">
                                    {{ $notifications }}
                                </div>
                            @endif
                            <i class="fa fa-navbar fa-bell "></i>
                        </div>
                        <span class="d-none d-lg-block nav-item"> Notifications </span>
                    </div>
                </a>
                <a href="{{ Route('parametres') }}">
                    <div class="nav-group">
                        <div>
                            <i class="fa fa-navbar fa-cog "></i>
                        </div>
                        <span class="d-none d-lg-block nav-item"> Paramètres </span>
                    </div>
                </a>
                <!-- ./navitems -->

                @cannot('admin')
                    <div class="mt-3 shadow rounded border d-flex flex-column align-items-center justify-content-center" style="height: 40vh; box-shadow: black">
                        <span class="main-color fw-bolder" style="font-size: 25px">
                            Leadership
                        </span>
                        <span class="mt-1 small"> En cours... </span>
                        <button class="btn mt-1 border btn-primary">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                @endcannot

                <!-- planifier -->
                @can('admin')
                    <a href="{{ Route('planifier') }}">
                        <div id="planifier" class="d-none d-lg-block mt-3 rounded-5">
                            Planifier
                        </div>
                    </a>
                @endif
                <!-- ./planifier -->

            </div>

            <a href="{{ Route('profile') }}">
                <div id="navbar-profile" class=" d-flex flex-row flex-nowrap  align-items-center">
                    <div>
                        <i class="fa fa-navbar fa-user "></i>
                    </div>
                    <span class="d-none d-lg-block nav-item ellipsis">
                            @if(session()->get('user') !== null)
                                {{ session()->get('user')->first_name }} {{ session()->get('user')->last_name }}
                           @endif
                        </span>
                </div>
            </a>

        </div>
        <!-- ./navbar -->

        <!-- main container -->
        <div id="main-container" class="position-absolute float-start col-sm-12 col-md-12 col-lg-9">
            @yield('content')
        </div>
        <!-- ./main container -->

    </div>

</div>
</body>
</html>
