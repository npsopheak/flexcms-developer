<?php

namespace FlexCMS\BasicCMS\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use FlexCMS\BasicCMS\Seeds\ItemTableSeeder;
use FlexCMS\BasicCMS\Seeds\SiteTableSeeder;
use FlexCMS\BasicCMS\Seeds\UserTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(ItemTableSeeder::class);
        $this->call(SiteTableSeeder::class);
        $this->call(UserTableSeeder::class);

        Model::reguard();
    }
}
