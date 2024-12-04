<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MatkulController;
/*
|-------------------------------------------------------------
-------------
| API Routes
|-------------------------------------------------------------
-------------
|
| Here is where you can register API routes for your application.
These
| routes are loaded by the RouteServiceProvider within a group
which
| is assigned the "api" middleware group. Enjoy building your
API!
|
*/
Route::post('/register',
[\App\Http\Controllers\Api\AuthController::class,
'register']);
Route::post('/login',
[\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function
(Request $request) {
 return $request->user();
});
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout',
   [\App\Http\Controllers\Api\AuthController::class, 'logout']);
   });

Route::middleware('auth:sanctum')->post('/mahasiswa/create', [MahasiswaController::class, 'store']);
Route::get('/mahasiswa/read', [MahasiswaController::class, 'index']); // Read All
Route::get('/mahasiswa/read/{id}', [MahasiswaController::class, 'show']); // Read By ID
Route::put('/mahasiswa/update/{id}', [MahasiswaController::class, 'update']); // Update
Route::delete('/mahasiswa/delete/{id}', [MahasiswaController::class, 'destroy']); // Delete

// CRUD Dosen
Route::post('/dosen/create', [DosenController::class, 'store']); // Create
Route::get('/dosen/read', [DosenController::class, 'index']); // Read All
Route::get('/dosen/read/{id}', [DosenController::class, 'show']); // Read By ID
Route::put('/dosen/update/{id}', [DosenController::class, 'update']); // Update
Route::delete('/dosen/delete/{id}', [DosenController::class, 'destroy']); // Delete

// CRUD Matkul
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/matkul/create', [MatkulController::class, 'store']);
    Route::get('/matkul/read', [MatkulController::class, 'index']);
    Route::get('/matkul/read/{id}', [MatkulController::class, 'show']);
    Route::put('/matkul/update/{id}', [MatkulController::class, 'update']);
    Route::delete('/matkul/delete/{id}', [MatkulController::class, 'destroy']);
});