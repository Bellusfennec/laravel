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

use App\Task;
use App\User;
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'web'], function () {


    Route::get('/tasks', 'TaskController@index');

    /**
     * Add New Task
     */
    Route::post('/task/create', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/tasks')
                ->withInput()
                ->withErrors($validator);
        }
        // $user = Auth::user();
        $task = new Task;
        $task->name = $request->name;
        $task->save();

        return redirect('/tasks');
    });

    /**
     * Delete Task
     */
    Route::delete('/task/delete/{task}', function (Task $task) {
        $task->delete();

        return redirect('/tasks');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
