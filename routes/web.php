<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\CalculController;
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ObjectifController;
use App\Http\Controllers\ParametreController;
use App\Http\Controllers\ParticipationController;
use App\Http\Controllers\PrerequisController;
use App\Http\Controllers\RechercherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthentificationController;
use App\Http\Controllers\UserController;


// group profile controller
Route::controller(UserController::class)->group(function () {
    Route::get('/profile', 'profile')->name('profile')->middleware('auth');
    Route::get('/user/{id}', 'user')->name('profile.user')->middleware('auth');

    // users all
    Route::get('/users', 'index')->name('users')->middleware('auth', 'can:admin');
    Route::get('/users/apprenants', 'allApprenant')->name('all.apprenant')->middleware('auth', 'can:admin');
    Route::get('/users/formateurs', 'allFormateur')->name('all.formateur')->middleware('auth', 'can:admin');

    Route::get('/getformateur/', 'getFormateurByName')->name('getformateur.name')->middleware('auth');
    Route::get('/getapprenant/', 'getApprenantByName')->name('getfoapprenant.name')->middleware('auth');
});

Route::controller(EntityController::class)->group(function () {
    Route::get('/entity/{id}', 'index')->name('profile.entity')->middleware('auth');
    Route::get('/entity/{id}/rapport', 'rapport')->name('profile.rapport')->middleware('auth');
});

Route::controller(MailController::class)->group(function () {
    Route::get('/email/send', 'sendMail')->name('sendMail')->middleware('auth', 'can:admin');
});


Route::controller(AuthentificationController::class)->group(function () {
    Route::match(['get', 'post'], '/login', 'login',)->name('login');
    Route::match(['get', 'post'], '/users/new', 'register')->name('register')->middleware('auth', 'can:admin');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(InvitationController::class)->group(function () {
    Route::get('/invitation/new', 'index')->name('new.invitation')->middleware('auth', 'can:admin');
    Route::post('/invitation/new', 'sendInvitation')->name('new.invitation')->middleware('auth', 'can:admin');
    Route::get('/invitation/accept', 'accept')->name('accepted.invitation')->middleware('auth');

    Route::get('/users/invitations', 'allInvitation')->name('all.invitations')->middleware('auth', 'can:admin');
});


// group formation controller
Route::controller(FormationController::class)->group(function () {
    Route::get('/', 'index')->name('home')->middleware('auth');
    Route::get('/formation', 'index')->name('formations')->middleware('auth');
    Route::get('/formation/all', 'all')->name('all.formation')->middleware('auth');
    Route::get('/formation/modules', 'modules')->middleware('auth');
    Route::get('/formation/{id}', 'show')->name('show.formation')->middleware('auth');

    Route::get('/planifier', 'create')->name('planifier')->middleware('auth','can:admin');
    Route::post('/planifier', 'createFormation')->name('planifier')->middleware('auth','can:admin');

});


// group module controller
Route::controller(ModuleController::class)->group(function () {
    Route::get('/module', 'index')->name('index.modules')->middleware('auth');
    Route::get('/module/new', 'create')->name('new.module')->middleware('auth', 'can:admin');
    Route::post('/module/new', 'createModule')->name('new.module')->middleware('auth', 'can:admin');

    Route::get('/modules', 'all')->name('all.modules')->middleware('auth');
    Route::get('/module/{id}', 'show')->name('show.module')->middleware('auth');
    Route::get('/module/{module_id}/signin/{apprenant_id}', 'inscription')->name('inscription.module')->middleware('auth');
    Route::get('/module/{module_id}/signout/{apprenant_id}', 'quitter')->name('quitter.module')->middleware('auth');

    Route::get('/getmodule/', 'getByTitre')->name('getbytritre.module')->middleware('auth');
});

// participation controller
Route::controller(ParticipationController::class)->group(function () {
    Route::get('/participation/{formation_id}/participate/{apprenant_id}', 'participer')->name('participer.participation')->middleware('auth', 'can:formateur');
    Route::get('/participation/{formation_id}/annuller/{apprenant_id}', 'annuler')->name('annuller.participation')->middleware('auth', 'can:formateur');
});


// group objectif controller
Route::controller(ObjectifController::class)->group(function () {
    Route::post('/objectif/new', 'create')->name('new.objectif')->middleware('auth', 'can:admin');
});

// competence controller
Route::controller(CompetenceController::class)->group(function () {
    Route::post('/competence/new', 'create')->name('new.competence')->middleware('auth', 'can:admin');
});

// prerequis controller
Route::controller(PrerequisController::class)->group(function () {
    Route::post('/prerequis/new', 'create')->name('new.prerequis')->middleware('auth', 'can:admin');
});

// group notifications controller
Route::controller(NotificationController::class)->group(function () {
    Route::get('/notifications', 'index')->name('notifications')->middleware('auth');
});

// group parametre controller
Route::controller(ParametreController::class)->group(function () {
    Route::get('/parametre', 'all')->name('parametres')->middleware('auth');
});

// group rechercher controller
Route::controller(RechercherController::class)->group(function () {
    Route::get('/rechercher', 'all')->name('rechercher')->middleware('auth');
});

// groype agenda controller
Route::controller(AgendaController::class)->group(function () {
    Route::get('/agenda', 'all')->name('agenda')->middleware('auth');
});


// calcul controller
Route::controller(CalculController::class)->group(function () {
    // frequenation session
    Route::get('/calcul/frequentation/session/{module_id}', 'frequentationSessionByModule')->name('frequentation.session')->middleware('auth');
});
