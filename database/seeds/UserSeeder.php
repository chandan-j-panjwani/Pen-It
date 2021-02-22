<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::where('email','muskan@gmail.com')->get()->first();
        if(!$user){
            \App\User::create([
                'name'=>'Muskaan Aswani',
                'email'=>'muskan@gmail.com',
                'password'=>Hash::make('12345'),
                'role'=>'admin'
            ]);
        }else{
            $user->update(['role'=>'admin']);
        }

        \App\User::create([
            'name'=>'John Doe',
            'email'=>'john@gmail.com',
            'password'=>Hash::make('12345'),
        ]);

        \App\User::create([
            'name'=>'Isha Joglekar',
            'email'=>'isha@gmail.com',
            'password'=>Hash::make('12345'),
        ]);
    }
}
