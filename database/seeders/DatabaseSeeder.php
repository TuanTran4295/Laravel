<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('tasks')->insert([
            ['title'=>'tasks 1' ,  'description'=>'Đây là tasks 1' , 'photo'=>''],
            ['title'=>'tasks 2' ,  'description'=>'Đây là tasks 2' , 'photo'=>''],
            ['title'=>'tasks 3' ,  'description'=>'Đây là tasks 3' , 'photo'=>''],
            ['title'=>'tasks 4' ,  'description'=>'Đây là tasks 4' , 'photo'=>''],
        ]);
        DB::table('users')->insert([
            ['name'=>'Nguyen Van A' ,  'email'=>'nva@gmail.com' , 'photo'=>'', Hash::make('password')],
            ['name'=>'Nguyen Van B' ,  'email'=>'nvb@gmail.com' , 'photo'=>'', Hash::make('password')],
            ['name'=>'Nguyen Van C' ,  'email'=>'nvc@gmail.com' , 'photo'=>'', Hash::make('password')],
            ['name'=>'Nguyen Van D' ,  'email'=>'nvd@gmail.com' , 'photo'=>'', Hash::make('password')],
            ['name'=>'Nguyen Van E' ,  'email'=>'nve@gmail.com' , 'photo'=>'', Hash::make('password')],
            ['name'=>'Nguyen Van F' ,  'email'=>'nvf@gmail.com' , 'photo'=>'', Hash::make('password')], 
        ]);
        DB::table('news')->insert([
            
        ]);
    }
}
