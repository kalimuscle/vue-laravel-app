<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\CryptoController;

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

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signUp']);
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', [AuthController::class,'logout']);
        Route::get('user', [AuthController::class,'user']);

        Route::get('coins', [CryptoController::class,'coins']);

        Route::resource('operations', OperationController::class);

        /*****
         * 
         * 
         *  GET	/operations	index	operations.index
            GET	/operations/create	create	operations.create
            POST	/operations	store	operations.store
            GET	/operations/{operation}	show	operations.show
            GET	/operations/{operation}/edit	edit	operations.edit
            PUT/PATCH	/operations/{operation}	update	operations.update
            DELETE	/operations/{operation}	destroy	operations.destroy
         * 
         * ***** */
    });
});
