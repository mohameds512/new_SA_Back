<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\Users\UsersController;
use \App\Http\Controllers\Api\System\RolesController;
use \App\Http\Controllers\Api\System\SettingController;
use \App\Http\Controllers\Api\System\DashboardController;
use App\Http\Controllers\Api\System\LookupController;

use App\Http\Controllers\Api\pgc\pgcController;



Route::get('submission/image/{submission_id}/{img}/{no_cache}', [pgcController::class, 'submissionImages'])->name('image');
Route::get('submission/includes/image/{submission_id}/{img}/{no_cache}', [pgcController::class, 'submissionIncludesImages'])->name('includes_image');
Route::get('dashboard/img/{img}/{no_cache}', [pgcController::class, 'dashMapImage'])->name('dashboard_map');


Route::group(['prefix' => '', 'middleware' => ['auth:api', 'json.response']], function () {

    Route::post('dataLookups', [pgcController::class, 'lookups']);

    Route::post('build_desc', [pgcController::class, 'get_build_desc']);
});

Route::group(['prefix' => 'store', 'middleware' => ['auth:api', 'json.response']], function () {
    Route::post('add/submission', [pgcController::class, 'add']);
    Route::put('save_submission/{sub}', [pgcController::class, 'save_submission']);
    Route::get('show/{submission}', [pgcController::class, 'show']);
    Route::post('save_includes', [pgcController::class, 'save_includes']);
    Route::post('delete_inc', [pgcController::class, 'delete_inc']);
    Route::post('add_notes', [pgcController::class, 'add_notes']);
    Route::post('approve', [pgcController::class, 'approve_sub']);
    Route::post('forced_area', [pgcController::class, 'forced_area']);
    Route::post('submitFloor', [pgcController::class, 'save_floor']);
    Route::post('save/signature/{submission}', [pgcController::class, 'saveSignature']);
    Route::post('change/status/{submission}', [pgcController::class, 'changeStatus']);
    Route::post('map/{submission}', [pgcController::class, 'storeMap']);
    Route::post('updateDashMap', [pgcController::class, 'update_dash_map']);


});
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth:api', 'json.response']], function () {

    Route::post('getSubmissions', [pgcController::class, 'getSub']);
    Route::post('showSub/{id}', [pgcController::class, 'show_sub']);
    Route::put('edit_desc/{desc?}', [pgcController::class, 'edit_desc']);
    Route::post('submissions', [pgcController::class, 'dashboard']);

});
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth:api', 'json.response']], function () {

    Route::post('getInc/{id}', [pgcController::class, 'get_incs']);
    Route::post('getSubmissions', [pgcController::class, 'getSub']);
    Route::post('showSub/{id}', [pgcController::class, 'show_sub']);

});




Route::group(['prefix' => '', 'middleware' => ['json.response']], function () {
    Route::post('login', [UsersController::class, 'login']);
    Route::get('{user}', [UsersController::class, 'get']);
    Route::get('photo/{user}', [UsersController::class, 'photo']);




});

/*
|--------------------------------------------------------------------------
| Users API
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'users', 'middleware' => ['auth:api', 'json.response']], function () {

    Route::post('', [UsersController::class, 'users']);
    Route::put('{user?}', [UsersController::class, 'put']);
    Route::put('set/access/{user}', [UsersController::class, 'setAccess']);
    Route::post('photo/{user?}', [UsersController::class, 'updatePhoto']);
    Route::get('profile', [UsersController::class, 'details']);
    Route::get('{user?}', [UsersController::class, 'details']);
    Route::put('password/{user?}', [UsersController::class, 'changePassword']);
    Route::delete('{user}', [UsersController::class, 'remove']);
    Route::post('reset/{user}', [UsersController::class, 'reset']);
    Route::post('restore/{user}', [UsersController::class, 'restore']);
    Route::post('logout', [UsersController::class, 'logout']);


});



/*
|--------------------------------------------------------------------------
| Settings API
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'settings', 'middleware' => ['auth:api', 'json.response']], function () {

    Route::post('', [SettingController::class, 'settings']);
    Route::put('{setting?}', [SettingController::class, 'put']);
    Route::get('{setting}/{details?}', [SettingController::class, 'get']);
    Route::delete('{setting}', [SettingController::class, 'remove']);
});








/*
|--------------------------------------------------------------------------
| Roles API
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'roles', 'middleware' => ['auth:api', 'json.response']], function () {

    Route::post('', [RolesController::class, 'roles']);
    Route::get('{role?}', [RolesController::class, 'get']);
    Route::put('{role?}', [RolesController::class, 'put']);
    Route::delete('{role}', [RolesController::class, 'delete']);
    Route::put('user/{user}', [RolesController::class, 'sync']);
    Route::get('user/{user}', [RolesController::class, 'user']);
});





Route::group(['prefix' => 'dashboard', 'middleware' => ['auth:api', 'json.response']], function () {

    Route::post('counts', [DashboardController::class, 'index']);
    Route::post('faculty', [DashboardController::class, 'faculty']);
    Route::post('payment', [DashboardController::class, 'payment']);
    Route::post('activities', [DashboardController::class, 'activities']);
});
