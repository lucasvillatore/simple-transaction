<?php

use Illuminate\Database\Seeder;
use App\Domain\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  
        User::create([
            'name' => 'Lucas',
            'email' => 'lucas.blockv@gmail.com',
            'taxpayer_id' => '1234567890',
            'password' => bcrypt('senhafortissima'),
            'type' => 'common',
            'balance' => 123.0
        ]);
        User::create([
            'name' => 'Lucas',
            'email' => 'lucas.blockv2@gmail.com',
            'taxpayer_id' => '1234567891',
            'password' => bcrypt('senhafortissima'),
            'type' => 'common',
            'balance' => 123.0
        ]);
        User::create([
            'name' => 'Lucas',
            'email' => 'lucas.blockv3@gmail.com',
            'taxpayer_id' => '1234567892',
            'password' => bcrypt('senhafortissima'),
            'type' => 'shopkeeper',
            'balance' => 123.0
        ]);
    }
}
