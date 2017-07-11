<?php

Route::group(['middleware' => 'web'], function () {
 Route::get('fileUpload', function () {

    return view('welcome');

});

Route::post('fileUpload', ['as'=>'welcome','uses'=>'MonoController@fileUpload']);
});
?>
