<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller; // it is for extends Controller
use stdClass;

class UserController extends Controller
{
    public function showUserName() {

        return 'Ahmed Emam';

    }

    public function getIndex(){
        /*$data=[];
        $data['id']=5;
        $data['name']='Ahmed Emam';*/
        /*
        $obj = new \stdClass();

        $obj -> name = 'ahmed';
        $obj -> id = 5;
        $obj -> gender = 'male';

        return view('welcome',compact('obj'));//he make it such as varname: 'obj'*/

        $data=['ahmed' ,'bassem'];

        //return view('welcome') -> with('name','ahmed omar');

        return view('welcome',compact('data'));
    }
}
