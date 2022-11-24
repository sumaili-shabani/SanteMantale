<?php

use App\Http\Controllers\Backend\{CrudController};
use App\Http\Controllers\{ArticlesController};
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'App\Http\Controllers\UserController@register');
Route::post('/login', 'App\Http\Controllers\UserController@login');
Route::get('/user', 'App\Http\Controllers\UserController@getCurrentUser');
Route::post('/update', 'App\Http\Controllers\UserController@update');
Route::get('/logout', 'App\Http\Controllers\UserController@logout');




//get type_ie=3 articles where are welcome info
Route::get('/get_all_article/', [ArticlesController::class, 'welcomeInfo']);
Route::get('/get_type_article_type/', [ArticlesController::class, 'getTypeArticleType']);
Route::get('/fetch_sigle_article/{id}', [ArticlesController::class, 'fetch_sigle_article']);
Route::get('/fetch_search_article', [ArticlesController::class, 'fetch_search_article']);
Route::get('/fetch_getType_article/{type_id}', [ArticlesController::class, 'fetch_getType_article']);

/*
*
* mes scripts commencent
*=======================
*=======================
*
*/
//protection de route
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Route::get('/fetch_product', [CrudController::class, 'index']);
    Route::get('/fetch_sigle_product/{id}', [CrudController::class, 'show']);
    Route::post('/insert_product', [CrudController::class, 'store']);
    Route::post('/update_product/{id}', [CrudController::class, 'update']);
    Route::get('/delete_product/{id}', [CrudController::class, 'destroy']);
    Route::get('/search_product', [CrudController::class, 'search']);
    Route::post('/logout', [AuthController::class, 'logout']);

});


Route::get('/fetch_product', [CrudController::class, 'index']);
Route::post('/register', [AuthController::class, 'registerUser']);
Route::post('/login', [AuthController::class, 'loginUser']);

Route::get('/fetch_utilisateur', [CrudController::class, 'fetch_utilisateur']);
Route::post('/insert_utilisateur', [CrudController::class, 'insert_utilisateur']);
Route::post('/update_utilisateur/{id}', [CrudController::class, 'update_utilisateur']);
Route::get('/delete_utilisateur/{id}', [CrudController::class, 'delete_utilisateur']);

Route::get('/search_utilisateur', [CrudController::class, 'search_utilisateur']);

//news  




/*
*
* mes scripts commencent
*=======================
*=======================
*
*/

