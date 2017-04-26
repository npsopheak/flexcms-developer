<?php

namespace FlexCMS\BasicCMS\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
// use App\Site;
use FlexCMS\BasicCMS\Models\Site;

class SiteTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
    {
        \DB::table('sites')->delete();

        $now = new \DateTime('NOW');

        $site = Site::create([
            'id' => 1,
        	'name' => 'FlexiTech [dot] IO',
        	'description' => 'FlexiTech [dot] IO',
        	'logo_id' => 0,
            'website' => 'http://www.flexitech.io',
            'supports' => 'info@flexitech.io'
        ]);
    }

}
