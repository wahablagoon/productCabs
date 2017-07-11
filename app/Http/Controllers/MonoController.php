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


public function fileUpload(Request $request)

{

    $this->validate($request, [

        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

    ]);


    $image = $request->file('image');

    $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

    $destinationPath = public_path('/images');

    $image->move($destinationPath, $input['imagename']);


    $this->postImage->add($input);


    return back()->with('success','Image Upload successful');

}

}
