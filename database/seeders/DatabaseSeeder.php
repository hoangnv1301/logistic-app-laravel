<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make("00000000")
        ];

        User::create($user);

        for ($x = 0; $x <= 5; $x++) {
            Supplier::create(
                [
                    'name' => 'Supplier ' . $x,
                    'address' => 'Tokyo'
                ]
            );
        }

        for ($x = 0; $x <= 10; $x++) {
            Product::create(
                [
                    'supplier_id' => rand(1, 5),
                    'name' => 'Product ' . $x,
                    'price' => rand(100, 200)
                ]
            );
        }

        for ($x = 0; $x <= 3; $x++) {
            Warehouse::create(
                [
                    'name' => 'Warehouse ' . $x,
                    'address' => 'Tokyo'
                ]
            );
        }
    }
}
