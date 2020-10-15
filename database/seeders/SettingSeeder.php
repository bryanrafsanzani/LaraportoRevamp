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
            // Setting web
            [
                'name'          =>  'Application Name',
                'option_name'   =>  'app_name',
                'value'         =>  'Laraporto',
                'default_value' =>  'Laraporto',
                'description'   =>  'Main name Application Website',
            ],
            [
                'name'          =>  'Title',
                'option_name'   =>  'title',
                'value'         =>  'Laraporto Revamp',
                'default_value' =>  'Laraporto Developmetn',
                'description'   =>  'Title web',
            ],
            [
                'name'          =>  'Icon Web',
                'option_name'   =>  'main_icon',
                'value'         =>  'default-icon.ico',
                'default_value' =>  'default-icon.ico',
                'description'   =>  'General Icon web',
            ],
            [
                'name'          =>  'Footer CMS',
                'option_name'   =>  'footer_cms',
                'value'         =>  'Copyright &copy; 2020 <b>Laraporto Revamp</b> <br> Developed By <a href="https://right-jet.com/">Bryan Rafsanzani - Fullstack Web Developer</a>',
                'default_value' =>  'Copyright &copy; 2020 <b>Laraporto Revamp</b> <br> Developed By <a href="https://right-jet.com/">Bryan Rafsanzani - Fullstack Web Developer</a>',
                'description'   =>  'Footer for Cms',
            ],
            [
                'name'          =>  'Footer Public',
                'option_name'   =>  'footer_public',
                'value'         =>  'Copyright &copy; 2020 <b>Laraporto Revamp</b> <br> Developed By <a href="https://right-jet.com/">Bryan Rafsanzani - Fullstack Web Developer</a>',
                'default_value' =>  'Copyright &copy; 2020 <b>Laraporto Revamp</b> <br> Developed By <a href="https://right-jet.com/">Bryan Rafsanzani - Fullstack Web Developer</a>',
                'description'   =>  'Footer for Cms',
            ],
            // Contact web
            [
                'name'          =>  'Email',
                'option_name'   =>  'email',
                'value'         =>  'bryanrafsanzani46@gmail.com',
                'default_value' =>  'bryanrafsanzani46@gmail.com',
                'description'   =>  'Main email information website',
            ],
            [
                'name'          =>  'Phone Number',
                'option_name'   =>  'phone_number',
                'value'         =>  '087775211019',
                'default_value' =>  '087775211019',
                'description'   =>  'Main Phone Number information website',
            ],
            [
                'name'          =>  'Linkedin',
                'option_name'   =>  'linkedin',
                'value'         =>  '087775211019',
                'default_value' =>  '087775211019',
                'description'   =>  'Main Phone Number information website',
            ],
            [
                'name'          =>  'Current Address',
                'option_name'   =>  'current_address',
                'value'         =>  'Jakarta',
                'default_value' =>  'Jakarta',
                'description'   =>  'Current position working/place home',
            ],
            //Account Login
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
