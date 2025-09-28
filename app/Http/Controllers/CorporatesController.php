<?php

namespace App\Http\Controllers;

use App\Models\Corporate;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CorporatesController extends Controller
{
    public function index()
    {
        $corporates = (auth()->user()->role_id == Role::IS_CORPORATE)
            ? auth()->user()->corporate->users()->where('role_id', Role::IS_CORPORATE)->get()
            : Corporate::all();

        return view('admin.corporates', ['corporates' => $corporates]);
    }

    public function store(Request $request)
    {
        $corporate = auth()->user()->corporate;

        $email = $request->username . '@' . $corporate->username . '.corp';

        if ($userconflict = User::where('email', $email)->first()) {
            return redirect()
                ->route('corporate.index')
                ->with('input_error', 'El usuario '. $userconflict->name . ' ya está registrado bajo el nombre de usuario "' . $request->username . '".')
                ->withInput();
        }

        if (
            $corporate->users()->create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $email,
                'phone' => $request->phone,
                'is_local_admin' => 0,
                'password' => Hash::make($request->password),
                'role_id' => Role::IS_CORPORATE,
            ])
        ) {
            return redirect()->route('corporate.index')->with('status', 'Usuario registrado con éxito');            
        }

        return redirect()->back()->with(['input_error' => 'Error no identificado al registrar usuario. Contacte con la administración.']);

    }

    public function store_local_admin(Request $request)
    {
        DB::beginTransaction();

        if ($userconflict = Corporate::where('username', $request->corporate_suffix)->first()) {
            return redirect()
                ->route('admin.corporate.index')
                ->with('input_error', 'El corporativo "'. $userconflict->name . '" ya está registrado bajo el identificador corporativo "' . $userconflict->username . '".')
                ->withInput();
        }

        $corporate = new Corporate();
        $corporate->name = $request->corporate_name;
        $corporate->username = $request->corporate_suffix;
        $corporate->save();

        $email = $request->username . '@' . $request->corporate_suffix . '.corp';

        if ($corporate->users()->create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $email,
            'phone' => $request->phone,
            'is_local_admin' => 1,
            'password' => Hash::make($request->password),
            'role_id' => Role::IS_CORPORATE,
        ])
        ) {
            DB::commit();

            return redirect()->route('admin.corporate.index')->with('status', 'Corporativo registrado con éxito');
        } else {
            DB::rollBack();

            return redirect()->route('admin.corporate.index')->with('input_error', 'Error al registrar corporativo');
        }
    }

    public function destroy($id)
    {
        $corporate = User::find($id);
        $corporate->delete();

        return redirect()->route('admin.corporate.index')->with('status', 'Corporativo eliminado con éxito');
    }
}
