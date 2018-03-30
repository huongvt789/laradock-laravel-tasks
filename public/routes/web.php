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
use App\MyWork;
use Illuminate\Http\Request;


Route::get('/',function(){
	$list = MyWork::all();
    return view('listWork', [
        'list' => $list
    ]);
});

Route::delete('/list/{list}', function (MyWork $list) {
    $list->delete();

    return redirect('/');
});

Route::post('/listWork',function(Request $request) {
	$validator=Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

	//Bat loi 
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    $list=new MyWork();
    $list->name = $request->name;
    $list->save();
    return redirect('/');
});