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

use Illuminate\Foundation\Application;
use Inertia\Inertia;
use App\Actions\Pages;
use App\Actions\Podcasts;
use App\Http\Controllers\DoNotTrackPolicyController;
use App\Http\Livewire;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

if (App::environment(['production', 'staging'])) {
    URL::forceScheme('https');
}

$playerUrl = explode(':', config('app.player_domain'))[0]; // Remove port number in dev

// Player
Route::domain($playerUrl)->group(function () {
    Route::get('/', Podcasts\Episodes\Dynamic::class)->name('podcasts.episodes.dynamic');
    Route::get('episodes/{episode}/{color?}', Podcasts\Episodes\Show::class)->name('podcasts.episodes.show');
    Route::get('embed', Podcasts\Episodes\Embed::class)->name('podcasts.episodes.embed');
});

// Player Builder
Route::get('/', Livewire\PlayerBuilder::class)->name('player.builder');

// Ramen Games
Route::get('ramengames', Pages\RamenGames::class);
Route::domain('ramengames.'.config('app.host'))->group(fn () => Route::redirect('/', config('app.url').'/ramengames')); // Redirect old subdomain

// Pages (Inertia)
Route::get('dnt', [DoNotTrackPolicyController::class, 'show'])->name('dnt');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::inertia('dashboard','Dashboard')->name('dashboard');
    Route::inertia('artwork', 'Artwork')->name('artwork');
});
