<?php

namespace FlexCMS\BasicCMS\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
// use App\User;
// use App\Role;
use FlexCMS\BasicCMS\Models\User;
use FlexCMS\BasicCMS\Models\Role;

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
    {
        \DB::table('users')->delete();

        $now = new \DateTime('NOW');

        $user = User::create([
            'id' => 1,
        	'email' => 'admin',
            'role' => 'admin',
        	'name' => 'System Administrator',
        	'password' => \Hash::make('fT@20!5ech'),
            'site_id' => 1
        ]);

        // if ($user){
        //     $admin = Role::where('name', '=', 'administrator')->first();
        //     $user->roles()->attach($admin->id); // id only
        // }

        $user = User::create([
            'id' => 2,
            'email' => 'user',
            'role' => 'user',
            'name' => 'User Access',
            'password' => \Hash::make('123@user!'),
            'site_id' => 1
        ]);

        // if ($user){
        //     $client = Role::where('name', '=', 'client')->first();
        //     $user->roles()->attach($client->id); // id only
        // }

        $user = User::create([
            'id' => 3,
            'email' => 'client',
            'role' => 'member',
            'name' => 'Client Access',
            'password' => \Hash::make('123@$client'),
            'site_id' => 1
        ]);

        // if ($user){
        //     $client = Role::where('name', '=', 'client')->first();
        //     $user->roles()->attach($client->id); // id only
        // }

        // $user = User::create([
        //     'id' => 4,
        //     'email' => 'sopheak',
        //     'name' => 'Promsopheak Nuon',
        //     'password' => Hash::make('123N@Pheak!'),
        //     'site_id' => 1,
        //     'title' => '',
        //     'description' => '',
        //     'photo_url' => ''
        // ]);

        // $user = User::create([
        //     'id' => 5,
        //     'email' => 'panhna',
        //     'name' => 'Panhna Seng',
        //     'password' => Hash::make('P456@Nak$'),
        //     'site_id' => 1,
        //     'title' => '',
        //     'description' => '',
        //     'photo_url' => ''
        // ]);

        // $user = User::create([
        //     'id' => 6,
        //     'email' => 'ponnak',
        //     'name' => 'Ponnak Prak',
        //     'password' => Hash::make('S908@Panhna@'),
        //     'site_id' => 1,
        //     'title' => '',
        //     'description' => '',
        //     'photo_url' => ''
        // ]);
    }

}
