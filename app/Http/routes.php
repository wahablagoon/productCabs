<?php
Route::get('/api/v1/products/{id?}', ['middleware' => 'auth.basic', function($id = null) {
if ($id == null) {
    $products = App\Product::all(array('id', 'name', 'price'));
} else {
    $products = App\Product::find($id, array('id', 'name', 'price'));
}
return Response::json(array(
            'error' => false,
            'products' => $products,
            'status_code' => 200
        ));
}]);

Route::get('/api/v1/categories/{id?}', ['middleware' => 'auth.basic', function($id = null) {
if ($id == null) {
    $categories = App\Category::all(array('id', 'name'));
} else {
    $categories = App\Category::find($id, array('id', 'name'));
}
return Response::json(array(
            'error' => false,
            'user' => $categories,
            'status_code' => 200
        ));
}]);
?>
