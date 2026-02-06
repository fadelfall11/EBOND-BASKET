<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer ou mettre à jour l'utilisateur admin
        User::updateOrCreate(
            ['email' => 'admin@ebond.sn'],
            [
                'name' => 'Admin EBOND',
                'email' => 'admin@ebond.sn',
                'password' => Hash::make('admin123'), // Mot de passe par défaut
                'email_verified_at' => now(),
                'is_admin' => true,
            ]
        );
        
        $this->command->info('Admin créé avec succès!');
        $this->command->info('Email: admin@ebond.sn');
        $this->command->info('Mot de passe: admin123');
    }
}
