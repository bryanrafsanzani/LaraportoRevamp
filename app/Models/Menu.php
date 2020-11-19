<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = "menus";
    protected $primaryKey = "id";

    protected $fillable = [
        'id',
        'prn',
        'name',
        'sort',
        'icon',
        'route',
        'route_target',
        'created_at',
        'updated_at',
    ];

    private function parent($prn = 0){
        $menu_0 = self::where('prn',0)->get();
        foreach ($menu_0 as $key) {
          child($key->id, 0);
        }
    }

    // develop
    protected function tree()
    {
        $menu_0 = self::where('prn',0)->orderBy('sort', 'asc')->get();
        $data = '<div class="dd" id="nestable">
                    <ol class="dd-list">';

        foreach ($menu_0 as $key) {
            $data .= $this->dataIndexChild($key->id, 0);
        }

        $data .= '</ol></div>';
        return $data;
    }

    protected function dataIndexChild($parent=0, $level=0)
    {
        $result = null;
        $menu = self::where('prn',$parent)->get();
        $parent = self::where('id',$parent)->first();
        $subParents = self::where('prn', $parent->id)->orderBy('sort', 'asc')->get();
        $lv = $level;

        if($lv === 0){
            $result .=
            '<li class="dd-item" data-id="'.$parent->id.'">
               <div class="dd-handle"><i class="fa fa-bars"></i> '.$parent->name.'
                    <a  class="collapse-link navbar-right dd-nodrag " data-toggle="collapse" href="#collapse-'.$parent->id.'" role="button" aria-expanded="false" aria-controls="collapse-'.$parent->id.'"><i class="fa fa-chevron-up"></i></a>

                    <div class="collapse" id="collapse-'.$parent->id.'">
                    --test 0--
                    </div>
                </div>';

            if(sizeof($subParents)<=0){
                $result .= '</li>';
            }

        }

        if(sizeof($subParents)>0){
            $result .= '<ol class="dd-list">';
            foreach($subParents as $ss) {

                $result .= '<li class="dd-item" data-id="'.$ss->id.'">
                                <div class="dd-handle"><i class="fa fa-bars"></i> '.$ss->name.'
                                    <a  class="collapse-link navbar-right dd-nodrag " data-toggle="collapse" href="#collapse-'.$ss->id.'" role="button" aria-expanded="false" aria-controls="collapse-'.$ss->id.'"><i class="fa fa-chevron-up"></i></a>

                                    <div class="collapse" id="collapse-'.$ss->id.'">
                                    --test child--
                                    </div>

                                </div>';

                                if(sizeOf($menu)<=0){
                                    $result.='</li>';

                                }

                $subsubParent = self::where('prn', $ss->id)->orderBy('sort', 'asc')->get();
                if(sizeOf($menu)>0){

                    $level +=1;
                    $result .= $this->dataIndexChild($ss->id, $level);
                    $result .= '</li>';

                }

            }
            $result .= ' </ol>';
        }

        return $result;

    }




}
