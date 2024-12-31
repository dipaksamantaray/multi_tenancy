<?php

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,   // Ensures we're in tenant context
    PreventAccessFromCentralDomains::class, // Prevents central domain access
])->group(function () {
    
    // Tenant's welcome page
    Route::get('/', function () {
        // dd(tenant()); 
        return view('tenantwelcome');
    });

    // Other tenant-specific routes can go here
    Route::view('tenantdashboard', 'dashboard')
        ->middleware(['auth', 'verified']);
    
    // Include tenant authentication routes (if needed)
    require __DIR__ . '/tenant-auth.php';

    // Other routes you want to load for tenant domains
});



