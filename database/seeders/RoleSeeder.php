<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            1 => 'user',
            2 => 'cashier',
            3 => 'corporate',
            4 => 'admin',
            5 => 'developer',
            6 => 'clerk',
        ];

        foreach ($roles as $id => $name) {
            Role::updateOrCreate(
                ['id' => $id],
                ['name' => $name]
            );
        }
    }
}
