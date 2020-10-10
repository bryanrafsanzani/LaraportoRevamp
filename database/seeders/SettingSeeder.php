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
             * footer_content_cms
             * footer_content_public
             * social media
             */
        $settings = [
            [
                'name'          =>  'Username',
                'option_name'   =>  'username',
                'value'         =>  'bryanrafsanzani',
                'default_value' =>  'bryanrafsanzani',
                'description'   =>  'usename for login user',
            ],
            [
                'name'          =>  'Password',
                'option_name'   =>  'password',
                'value'         =>  bcrypt('s3cr3t'),
                'default_value' =>  bcrypt('s3cr3t'),
                'description'   =>  'password for login user',
            ],
            [
                'name'          =>  'Application Name',
                'option_name'   =>  'app_name',
                'value'         =>  'Laraporto',
                'default_value' =>  'Laraporto',
                'description'   =>  'password for login user',
            ],
        ];

        foreach($settings as $setting){
            $data = \App\Models\Setting::where('option_name', $setting['option_name'])->first();

            if($data){
                $data->update($setting);
            }else{
                \App\Models\Setting::create($setting);
            }
        }
    }
}
