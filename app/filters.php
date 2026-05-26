<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

Route::filter('role', function($route, $request, $role) {
    if (!Auth::check() || Auth::user()->role != $role) {
        return Redirect::to('login')->with('error','Accès refusé');
    }
});
