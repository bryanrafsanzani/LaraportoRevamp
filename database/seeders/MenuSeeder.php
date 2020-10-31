<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sidebars = [
            [
                'id'    =>  '1',
                'prn'   =>  '0',
                'name'  =>  'Dashboard',
                'sort'  =>  '0',
                'icon'  =>  null,
                'route' =>  '#',
                'route_target'  =>  '#',
            ],
            [
                'id'    =>  '2',
                'prn'   =>  '0',
                'name'  =>  'Logs',
                'sort'  =>  '0',
                'icon'  =>  null,
                'route' =>  '#',
                'route_target'  =>  '#',
            ],
            [
                'id'    =>  '3',
                'prn'   =>  '0',
                'name'  =>  'Settings',
                'sort'  =>  '0',
                'icon'  =>  null,
                'route' =>  '#',
                'route_target'  =>  '#',
            ],
            [
                'id'    =>  '4',
                'prn'   =>  '0',
                'name'  =>  'Media',
                'sort'  =>  '0',
                'icon'  =>  null,
                'route' =>  '#',
                'route_target'  =>  '#',
            ],
            [
                'id'    =>  '5',
                'prn'   =>  '4',
                'name'  =>  'Gallery',
                'sort'  =>  '0',
                'icon'  =>  null,
                'route' =>  '#',
                'route_target'  =>  '#',
            ],
            [
                'id'    =>  '6',
                'prn'   =>  '4',
                'name'  =>  'Uploads',
                'sort'  =>  '0',
                'icon'  =>  null,
                'route' =>  '#',
                'route_target'  =>  '#',
            ],
            [
                'id'    =>  '7',
                'prn'   =>  '0',
                'name'  =>  'Dynamic Forms',
                'sort'  =>  '0',
                'icon'  =>  null,
                'route' =>  '#',
                'route_target'  =>  '#',
            ],
            [
                'id'    =>  '8',
                'prn'   =>  '0',
                'name'  =>  'Dynamic Filled',
                'sort'  =>  '0',
                'icon'  =>  null,
                'route' =>  '#',
                'route_target'  =>  '#',
            ],
        ];

        foreach($sidebars as $sidebar)
        {
            Menu::create($sidebar);
        }
    }
}
