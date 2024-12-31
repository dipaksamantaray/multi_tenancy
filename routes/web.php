<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantController;

// Central domains from config
// $centralDomains = config('tenancy.central_domains');



Route::group(['domain'=>config('tenancy.central_domains.0')],function(){

Route::group(['middleware' => 'web'], function (){
    // Check if we are on a central domain
   
        // Central domain routes
        Route::view('/', 'welcome');
        
        // Other central domain routes like dashboard, profile, etc.
        Route::view('dashboard', 'dashboard')
            ->middleware(['auth', 'verified'])
            ->name('dashboard');
        
        Route::view('profile', 'profile')
            ->middleware(['auth'])
            ->name('profile');

        // Tenant management routes
        Route::resource('tenants', TenantController::class)->middleware('auth');
        
        // Authentication routes
        require __DIR__ . '/auth.php';
    
});
});
