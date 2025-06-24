<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new Admin();

        $admin->name = 'Super Admin';
        $admin->email = 'superadmin@email.com';
        $admin->password = \Hash::make("Demo123!");
        $admin->status = 1;
        $admin->picture = 'avatar.png';

        $admin->save();
    }
}
