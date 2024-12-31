<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TenantController extends Controller
{

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      return view('livewire.tenants.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view("livewire.tenants.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //      // Validate and create the tenant
    //      $validatedData = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:tenants,email',
    //     ]);

    //     Tenant::create($validatedData);

    //     return response()->json(['message' => 'Tenant registered successfully.']);
    // }
    // public function store(Request $request)
    // {
    //     dd($request->all());
    //     $validatedData = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:tenants,email',
    //         'password' => 'required|string|min:8|confirmed',
    //     ]);
    
    //     // Manually create a new Tenant instance and assign validated data
    //     $tenant = new Tenant();
    //     $tenant->name = $validatedData['name'];
    //     $tenant->email = $validatedData['email'];
    //     $tenant->password = $validatedData['password'];
    
    //     // Debugging: Check attribute values before saving
    //     // dd($tenant->attributesToArray());
    
    //     // Save the tenant to the database
    //     $tenant->save();
    
    //     // Redirect back with a success message
    //     return redirect()->route('tenants.index')->with('message', 'Tenant registered successfully.');
    // }
    public function store(Request $request){
        $validateData = $request->validate([
            'name'=> 'required|string|max:255',
            'email'=> 'required|email|max:255',
            'domain'=> 'required|string|max:255|unique:domains,domain',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $tenant = Tenant::create($validateData);
        $tenant->domains()->create([
            'domain'=>$validateData['domain'] . '.' . config('app.domain'),
        ]);

        return redirect()->route('tenants.index');
    }

    
    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        //
    }
}
