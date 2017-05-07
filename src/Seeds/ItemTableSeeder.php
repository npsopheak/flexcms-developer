<?php

namespace FlexCMS\BasicCMS\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use FlexCMS\BasicCMS\Models\Item;

class ItemTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
    {
        \DB::table('items')->delete();

        $now = new \DateTime('NOW');

        // Post Type

        $item = Item::create([
            'id' => 1,
        	'display_name' => 'Post',
        	'name' => 'post',
        	'description' => 'Post record is categorized as one news post, or events post, etc... That is normally a big section. Composed of many sections',
        	'parent_id' => 0,
        	'item_type' => 'type',
        	'indeletable' => 1,
        	'created_by' => 1,
        	'updated_by' => 1,
            'status' => 'active'
        ]);

        $item = Item::create([
            'id' => 2,
            'display_name' => 'Section',
            'name' => 'section',
            'description' => 'Section record is a piece of information such as overview paragraph, address paragraph',
            'parent_id' => 0,
            'item_type' => 'type',
            'indeletable' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'status' => 'active'
        ]);

        $item = Item::create([
            'id' => 10,
            'display_name' => 'News',
            'name' => 'news-type',
            'description' => 'News type to cover the categories under this type of content.',
            'parent_id' => 0,
            'item_type' => 'type',
            'indeletable' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'status' => 'active'
        ]);


        $item = Item::create([
            'id' => 12,
        	'display_name' => 'Tags',
        	'name' => 'tag-type',
        	'description' => 'Tags type for article',
        	'parent_id' => 0,
        	'item_type' => 'type',
        	'indeletable' => 1,
        	'created_by' => 1,
        	'updated_by' => 1,
            'status' => 'active'
        ]);

        // Post category - Section Post

        $item = Item::create([
            'id' => 3,
        	'display_name' => 'General',
        	'name' => 'general',
        	'description' => 'General section paragraph that can be retrieved quickly to display on small locations',
        	'parent_id' => 2,
        	'item_type' => 'category',
        	'indeletable' => 1,
        	'created_by' => 1,
        	'updated_by' => 1,
            'status' => 'active'
        ]);

        $item = Item::create([
            'id' => 4,
        	'display_name' => 'Footer',
        	'name' => 'footer',
        	'description' => 'Footer section paragraph that can be used on footer section.',
        	'parent_id' => 2,
        	'item_type' => 'category',
        	'indeletable' => 1,
        	'created_by' => 1,
        	'updated_by' => 1,
            'status' => 'active'
        ]);

        $item = Item::create([
            'id' => 5,
        	'display_name' => 'Header',
        	'name' => 'header',
        	'description' => 'Header section paragraph that can be used on header section.',
        	'parent_id' => 2,
        	'item_type' => 'category',
        	'indeletable' => 1,
        	'created_by' => 1,
        	'updated_by' => 1,
            'status' => 'active'
        ]);

        $item = Item::create([
            'id' => 6,
            'display_name' => 'Piece',
            'name' => 'piece',
            'description' => 'Piece section paragraph that can be small text.',
            'parent_id' => 2,
            'item_type' => 'category',
            'indeletable' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'status' => 'active'
        ]);

        $item = Item::create([
            'id' => 13,
            'display_name' => 'About Us',
            'name' => 'about-us',
            'description' => 'About Us section paragraph that can be small text.',
            'parent_id' => 2,
            'item_type' => 'category',
            'indeletable' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'status' => 'active'
        ]);

        $item = Item::create([
            'id' => 14,
            'display_name' => 'Operations',
            'name' => 'operations',
            'description' => 'Operations section paragraph that can be small text.',
            'parent_id' => 2,
            'item_type' => 'category',
            'indeletable' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'status' => 'active'
        ]);

        $item = Item::create([
            'id' => 15,
            'display_name' => 'Objective',
            'name' => 'objective',
            'description' => 'Objective section paragraph that can be small text.',
            'parent_id' => 2,
            'item_type' => 'category',
            'indeletable' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'status' => 'active'
        ]);

        $item = Item::create([
            'id' => 16,
        	'display_name' => 'Do you know?',
        	'name' => 'do-you-know',
        	'description' => 'Do you know? section paragraph that can be small text.',
        	'parent_id' => 2,
        	'item_type' => 'category',
        	'indeletable' => 1,
        	'created_by' => 1,
        	'updated_by' => 1,
            'status' => 'active'
        ]);

        // Post Category - Post

        $item = Item::create([
            'id' => 7,
        	'display_name' => 'Article',
        	'name' => 'article',
        	'description' => 'Article content paragraph used to retrieve on page',
        	'parent_id' => 1,
        	'item_type' => 'category',
        	'indeletable' => 1,
        	'created_by' => 1,
        	'updated_by' => 1,
            'status' => 'active'
        ]);

        $item = Item::create([
            'id' => 8,
        	'display_name' => 'News',
        	'name' => 'news',
        	'description' => 'News content paragraph used to display as news or blog',
        	'parent_id' => 1,
        	'item_type' => 'category',
        	'indeletable' => 1,
        	'created_by' => 1,
        	'updated_by' => 1,
            'status' => 'active'
        ]);

        $item = Item::create([
            'id' => 9,
            'display_name' => 'Job Vacancy',
            'name' => 'job-vacancy',
            'description' => 'Job vacancy post can be used to display as job posts',
            'parent_id' => 1,
            'item_type' => 'category',
            'indeletable' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'status' => 'active'
        ]);

        $item = Item::create([
            'id' => 11,
        	'display_name' => 'General News',
        	'name' => 'general-news',
        	'description' => 'General News',
        	'parent_id' => 10,
        	'item_type' => 'category',
        	'indeletable' => 1,
        	'created_by' => 1,
        	'updated_by' => 1,
            'status' => 'active'
        ]);

        // Category of document or directory or staff or donor or activities

        $item = Item::create([
            'display_name' => 'Primary Education',
            'name' => 'primary-education',
            'description' => '',
            'parent_id' => 0,
            'item_type' => 'directory_category',
            'indeletable' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'status' => 'active'
        ]);

        $item = Item::create([
            'display_name' => 'Permanent Staff',
            'name' => 'permanent-staff',
            'description' => '',
            'parent_id' => 0,
            'item_type' => 'directory_staff',
            'indeletable' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'status' => 'active'
        ]);

        $item = Item::create([
            'display_name' => 'Contract Staff',
            'name' => 'contract-staff',
            'description' => '',
            'parent_id' => 0,
            'item_type' => 'directory_staff',
            'indeletable' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'status' => 'active'
        ]);

        $item = Item::create([
            'display_name' => 'Volunteer Staff',
            'name' => 'volunteer-staff',
            'description' => '',
            'parent_id' => 0,
            'item_type' => 'directory_staff',
            'indeletable' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'status' => 'active'
        ]);

        $item = Item::create([
            'display_name' => 'Executive Director',
            'name' => 'executive-director',
            'description' => '',
            'parent_id' => 0,
            'item_type' => 'directory_position',
            'indeletable' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'status' => 'active'
        ]);
    }

}
