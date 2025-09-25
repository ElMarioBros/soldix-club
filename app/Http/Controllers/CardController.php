<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cards.index', [
            'users' => auth()->user()->corporate->users()
                ->where('role_id', Role::IS_USER)
                ->orderBy('created_at', 'desc')
                ->paginate(30)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $occupations = [
            'ama_casa' => 'Ama de Casa',
            'personal_operativo' => 'Personal Operativo de Fábrica',
            'supervision_produccion' => 'Supervisión / Coordinación de Producción',
            'gerencia_industrial' => 'Gerencia / Dirección Industrial',
            'jubilado' => 'Jubilado',
            'desempleado' => 'Desempleado',
            'estudiante' => 'Estudiante',
            'cajero_abarrote' => 'Cajero / Abarrotista',
            'guardia' => 'Guardia de Seguridad',
            'contador' => 'Empleado de Oficina',
            'independiente' => 'Trabajador Independiente',
            'empresario' => 'Empresario',
            'profesional_salud' => 'Profesional de la Salud',
            'profesor' => 'Profesor / Docente',
            'policia' => 'Policía',
            'chofer' => 'Chofer / Conductor',
            'agricultor' => 'Agricultor / Campesino',
            'comerciante' => 'Comerciante',
            'otro' => 'Otro',
        ];

        return view('cards.create', ['occupations' => $occupations]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $corporate = auth()->user()->corporate;

        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'phone'       => ['unique:users,phone', 'required', 'digits:10'],
            'gender'      => ['required', 'in:masculino,femenino'],
            'age'         => ['required', 'integer', 'min:18', 'max:100'],
            'occupation'  => ['required', 'string', 'max:255'],
            'login_code'  => ['required', 'digits:4'],
            'public_code' => ['required', 'string', 'max:255', 'unique:cards,public_code'],
        ]);

        $user = $corporate->users()->create([
            'name'         => $validated['name'],
            'password'     => 'null',
            'role_id'      => Role::IS_USER,
            'phone'        => $validated['phone'],
            'gender'       => $request->gender,
            'age'          => $validated['age'],
            'occupation'   => $validated['occupation'],
        ]);

        $user->card()->create([
            'login_code'  => $validated['login_code'],
            'public_code' => $validated['public_code'],
        ]);

        return redirect()
            ->route('cards.index')
            ->with('status', 'Cliente y tarjeta registrados.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Card $card)
    {
        $card->load('user');

        return view('cards.show', compact('card'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Card $card)
    {
        $card->load('user');
        return view('cards.edit', compact('card'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Card $card)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'phone'       => ['required', 'digits:10'],
            'gender'      => ['required', Rule::in(['masculino','femenino'])],
            'age'         => ['required', 'integer', 'min:18', 'max:100'],
            'occupation'  => ['required', 'string', 'max:255'],
            'login_code'  => ['required', 'digits:4'],
            'public_code' => ['required', 'string', 'max:255', Rule::unique('cards', 'public_code')->ignore($card->id)],
        ]);

        DB::transaction(function () use ($card, $validated) {
            // Actualiza el user asociado
            $card->user->update([
                'name'       => $validated['name'],
                'phone'      => $validated['phone'],
                'gender'     => $validated['gender'],
                'age'        => $validated['age'],
                'occupation' => $validated['occupation'],
            ]);

            // Actualiza la card
            $card->update([
                'login_code'  => $validated['login_code'],
                'public_code' => $validated['public_code'],
            ]);
        });

        return redirect()->route('cards.show', $card)->with('status', 'Cliente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        //
    }
}
