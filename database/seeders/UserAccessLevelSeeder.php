<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAccessLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = [
    		[ 'name' => 'owner' , 'display_name' => 'Owner'],
    		[ 'name' => 'developer' , 'display_name' => 'Developer'],
    		[ 'name' => 'billing' , 'display_name' => 'Billing']
    	];

        if( DB::table('user_access_levels')->get()->count() == 0  )
        {
            DB::table('user_access_levels')->insert($data);
        }
    }
}
