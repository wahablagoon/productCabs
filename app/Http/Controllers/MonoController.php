<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonoController extends Controller
{
    //

public function index()
{
    $myArray = ['id'=>1, 'name'=>'HD'];

    return response()->json($myArray);
}

public function rider_signup()
{

	$myArray = ['id'=>1, 'name'=>'rider signup'];

    return response()->json($myArray);

}

}
