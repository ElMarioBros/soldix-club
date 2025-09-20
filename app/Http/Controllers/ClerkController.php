<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ClerkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('clerks.index', [
            'clerks' => User::where('role_id', Role::IS_CLERK)->where('corporate_id', auth()->user()->corporate_id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clerks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $corporate = auth()->user()->corporate;

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $email = $validated['username'] . '@' . $corporate->username . '.corp';

        if (User::where('email', $email)->exists()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['username' => 'Usuario ya registrado en el corporativo']);
        }

        $corporate->users()->create([
            'name'         => $validated['name'],
            'username'     => $validated['username'],
            'email'        => $email,
            'password'     => Hash::make($validated['password']),
            'role_id'      => Role::IS_CLERK,
        ]);

        return redirect()
            ->route('clerks.index')
            ->with('status', 'Capturista registrado.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
