<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PinController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\PengikutController;
use App\Http\Controllers\MengikutiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/register', [AuthController::class, 'register']);

Route::post('/registered', [AuthController::class, 'registered']);
Route::get('/login', function(){
    return view('login');
})->name('login');

Route::middleware('auth')->group(function(){
    Route::get('/explore', function(){
        return view('page.explore');
    });
    Route::get('/getDataExplore', [ExploreController::class, 'getdata']);
    Route::get('/getDataFavorite', [ExploreController::class, 'getdatafavorite']);
    Route::post('/likefotos', [ExploreController::class, 'likesfoto']);
    Route::post('/pinned', [ExploreController::class, 'pinned']);
    Route::get('/pinned', function(){
        return view('page.pinned');
    });

    Route::get('/pin', function(){
        return view('page.pin');
    });

    Route::get('/explore-detail/{id}', function(){
        return view('page.exporedetail');
    });
    Route::get('/explore-detail/{id}/getdatadetail', [ExploreController::class, 'getdatadetail']);
    Route::get('/other-pin/{id}', function(){
        return view('page.otherpin');
    });
    Route::get('/other-pin/getDataPin/{id}', [PinController::class, 'getdatapin']);
    Route::get('/explore-detail/getComment/{id}', [ExploreController::class, 'ambildatakomentar']);
    Route::get('/pengikut/{id}', function(){
        return view('page.pengikut');
    });

    Route::get('/getdataotherpinexplore/',[PinController::class, 'getdata']);
    Route::post('/explore-detail/ikuti', [ExploreController::class,'ikuti']);
    Route::post('/explore-detail/kirimkomentar', [ExploreController::class, 'kirimkomentar']);
    Route::get('/mengikuti/{id}', function(){
        return view('page.mengikuti');
    });

    Route::get('/mypin', function(){
        return view('page.mypin');
    });

    Route::get('/profil', function(){
        return view('page.profile');
    });

    Route::get('/changepassword', function(){
        return view('page.changepassword');
    });

    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/pengikut/getdatapengikut/{id}',[PengikutController::class, 'getdatapengikut']);
    Route::get('/mengikuti/getdatamengikuti/{id}',[MengikutiController::class, 'getdatamengikuti']);
    Route::get('/mypin/getdatapengikut',[PinController::class, 'getdatamypin']);
    Route::post('/savepin', [PinController::class, 'savepin']);
});
Route::post('/auth', [AuthController::class, 'auth']);
