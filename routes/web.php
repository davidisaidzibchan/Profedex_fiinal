<?php

use App\Models\Consejo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
})->name('welcome');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('authprofex');


Route::get('profesores/{id}', function ($id) {
    return view('profedex.profesor-info', ['id' => $id]);
})->name('profesores.show')->middleware('auth');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/profile', function () {
        return view('profedex.perfil');
    })->name('profile');
});

Route::get('consejos/{id}', function ($id) {
    return view('profedex.consejo-info', ['id' => $id]);
})->name('consejo.show')->middleware(['auth']);

Route::get('notificaciones', function () {
    return view('profedex.notificaciones');
})->name('notificaciones')->middleware('auth');

Route::get('products', function () {
    return view('profedex.productos');
})->name('products')->middleware('auth');

Route::get('acercade', function () {
    return view('profedex.sobre-nosotros');
})->name('acercade');

Route::get('pendientes', function () {
    return view('profedex.pendientes-list');
})->name('pendientes')->middleware(['auth', 'checkrole:curador']);

Route::get('consejos/{consejo}/edit', function ($id) {
    return view('profedex.editar-consejo', ['id' => $id]);
})->name('consejos.edit')->middleware(['auth', 'checkrole:curador']);

Route::get('gestion/{section}', function ($section) {
    return view('profedex.gestiones', compact('section'));
})->name('gestion')->middleware(['auth', 'checkrole:admin']);
