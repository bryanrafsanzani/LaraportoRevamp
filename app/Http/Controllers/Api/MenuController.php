<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function __construt()
    {
        $this->middleware('jwt.verify');
    }

    public function index($results = [])
    {

        return $this->tree();

    }

     // develop
     protected function tree()
     {
         $menu_0 = Menu::where('prn',0)->orderBy('sort', 'asc')->get();
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
         $menu = Menu::where('prn',$parent)->get();
         $parent = Menu::where('id',$parent)->first();
         $subParents = Menu::where('prn', $parent->id)->orderBy('sort', 'asc')->get();
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

                 $subsubParent = Menu::where('prn', $ss->id)->orderBy('sort', 'asc')->get();
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
    // batas develop
}
