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
Auth::routes();
Route::match(["GET", "POST"], "/register", function(){
    return redirect("/login");
    })->name("register");
Route::get('/', function () {
    $events = \App\Event::inRandomOrder()->paginate(4);
    $articles = \App\Article::inRandomOrder()->paginate(3);
    $cobas1 = \App\Event::inRandomOrder()->paginate(1);
    $cobas2 = \App\Event::inRandomOrder()->paginate(1);
    $cobas3 = \App\Event::inRandomOrder()->paginate(1);
    return view('welcome', ['articles' => $articles, 'events' => $events, 'cobas1' => $cobas1, 'cobas2' => $cobas2, 'cobas3' => $cobas3]);
});


Route::get('/event', function () {
    $events = \App\Event::All();
    return view('event', ['events' => $events]);
});
Route::get('/article', function () {
    $articles = \App\Article::All();
    return view('article', ['articles' => $articles]);
});

Route::resource("users", "UserController");

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/categories/trash', 'CategoryController@trash')->name('categories.trash');
Route::get('/categories/{id}/restore', 'CategoryController@restore')->name('categories.restore');
Route::delete('/categories/{id}/delete-permanent', 'CategoryController@deletePermanent')->name('categories.delete-permanent');
Route::resource('categories', 'CategoryController');

Route::get('/ajax/categories/search', 'CategoryController@ajaxSearch');

Route::get('/events/trash', 'EventController@trash')->name('events.trash');
Route::post('/events/{id}/restore', 'EventController@restore')->name('events.restore');
Route::delete('/events/{id}/delete-permanent', 'EventController@deletePermanent')->name('events.delete-permanent');
Route::resource('events', 'EventController');

Route::get('/articles/trash', 'ArticleController@trash')->name('articles.trash');
Route::post('/articles/{id}/restore', 'ArticleController@restore')->name('articles.restore');
Route::delete('/articles/{id}/delete-permanent', 'ArticleController@deletePermanent')->name('articles.delete-permanent');
Route::resource('articles', 'ArticleController');


Route::get('/another/{id}', 'AnotherController@showevent')->name('anothers.showevent');
Route::resource('anothers', 'AnotherController');
