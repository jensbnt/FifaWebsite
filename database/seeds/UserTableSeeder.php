<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User([
            'name' => 'jensbnt',
            'password' => bcrypt('pwd')
        ]);
        $user->save();

        $user = new \App\User([
            'name' => 'jellecox',
            'password' => bcrypt('pwd')
        ]);
        $user->save();

        $user = new \App\User([
            'name' => 'root',
            'password' => bcrypt('root')
        ]);
        $user->save();
    }
}
