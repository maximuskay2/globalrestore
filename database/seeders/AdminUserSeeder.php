<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@restoreglobalinitiative.com')],
            [
                'name' => 'Site Admin',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'ChangeMeNow!')),
                'role' => UserRole::Admin,
            ],
        );

        User::query()->updateOrCreate(
            ['email' => env('EDITOR_EMAIL', 'editor@restoreglobalinitiative.com')],
            [
                'name' => 'Content Editor',
                'password' => Hash::make(env('EDITOR_PASSWORD', 'ChangeMeNow!')),
                'role' => UserRole::Editor,
            ],
        );
    }
}
