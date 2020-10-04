<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           /**
             * Setting need
             * app_name
             * site_title
             * icon_site
             *  footer_content_cms
             * footer_content_public
             */
        $settings = [
            [
                'name'          =>  '',
                'option_name'   =>  '',
                'value'         =>  '',
                'default_value' =>  '',
                'description'   =>  '',
            ]
        ];
    }
}
