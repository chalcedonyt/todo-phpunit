<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=> ['auth:api']], function(){

    /**
     * @param Request
     * @param Request.ids Comma separated string of ids
     */
    Route::get('/todos', function(\Illuminate\Http\Request $request){
        $ids = explode(',', $request->get('ids', ''));

        $query = \App\TodoList::with('items');

        if (count($ids) && !empty($ids[0])) {
            $query->whereIn('id', $ids);
        }
        return $query->get();
    });
});
