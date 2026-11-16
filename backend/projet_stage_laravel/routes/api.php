<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\ModeleController;
use App\Http\Controllers\MoteurController;
use App\Http\Controllers\BoitevitesseController;
use App\Http\Controllers\EmbrayageController;
use App\Http\Controllers\FreinageController;
use Illuminate\Support\Facades\Route;

// ── Publiques ──────────────────────────────────────
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

Route::get('/marques',              [MarqueController::class, 'index']);
Route::get('/marques/{id}/modeles', [MarqueController::class, 'modeles']);
Route::get('/modeles/{id}/pieces',  [ModeleController::class, 'pieces']);
Route::get('/moteurs',              [MoteurController::class, 'index']);
Route::get('/moteurs/{id}',         [MoteurController::class, 'show']);
Route::get('/boites-vitesse',       [BoitevitesseController::class, 'index']);
Route::get('/boites-vitesse/{id}',  [BoitevitesseController::class, 'show']);
Route::get('/embrayages',           [EmbrayageController::class, 'index']);
Route::get('/embrayages/{id}',      [EmbrayageController::class, 'show']);
Route::get('/freinages',            [FreinageController::class, 'index']);
Route::get('/freinages/{id}',       [FreinageController::class, 'show']);

// ── Connecté (client + admin) ──────────────────────
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout',          [AuthController::class, 'logout']);
    Route::get('/me',               [AuthController::class, 'me']);
    Route::get('/mes-commandes',    [CommandeController::class, 'mesCommandes']);
    Route::post('/commandes',       [CommandeController::class, 'store']);
});

// ── Admin seulement ────────────────────────────────
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('moteurs',        MoteurController::class)->except(['index','show']);
    Route::apiResource('boites-vitesse', BoitevitesseController::class)->except(['index','show']);
    Route::apiResource('embrayages',     EmbrayageController::class)->except(['index','show']);
    Route::apiResource('freinages',      FreinageController::class)->except(['index','show']);
    Route::apiResource('users',          UserController::class)->except(['show']);
    Route::get('/commandes',             [CommandeController::class, 'index']);
    Route::patch('/commandes/{id}/statut',[CommandeController::class, 'updateStatut']);
});