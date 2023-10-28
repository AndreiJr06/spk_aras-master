<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Bobot;
use App\Models\Kriteria;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'admin',
            'username' => 'Admin',
            'email' => 'test@example.com',
            'password' => bcrypt('admin'),
            'email_verified_at' => now(),
        ]);
    }
}
