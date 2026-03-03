<?php

use App\Models\Album;
use App\Models\SiteSetting;
use App\Models\AboutBcgSetting;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\DonationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $siteSetting = SiteSetting::first();
    $aboutBcgSetting = AboutBcgSetting::first();
    $featuredAlbums = Album::where('is_featured', true)
        ->latest('event_date')
        ->take(3)
        ->get();
    
    // Fallback if not enough featured albums
    if ($featuredAlbums->count() < 3) {
        $extraIds = $featuredAlbums->pluck('id')->toArray();
        $extraAlbums = Album::whereNotIn('id', $extraIds)
            ->latest('event_date')
            ->take(3 - $featuredAlbums->count())
            ->get();
        $featuredAlbums = $featuredAlbums->concat($extraAlbums);
    }

    $latestNotice = \App\Models\Notice::active()->latest()->first();

    return view('welcome', compact('siteSetting', 'featuredAlbums', 'aboutBcgSetting', 'latestNotice'));
})->name('home');

Route::get('/gallery', function () {
    $albums = Album::latest('event_date')->paginate(12);
    return view('gallery.index', compact('albums'));
})->name('gallery.index');

Route::get('/gallery/{album}', function (Album $album) {
    return view('gallery.show', compact('album'));
})->name('gallery.show');

Route::get('/donation', [DonationController::class, 'index'])->name('donation');
Route::post('/donation', [DonationController::class, 'store'])->name('donation.store');

Route::get('/about-us', function () {
    $aboutBcgSetting = AboutBcgSetting::first();
    return view('about-us', compact('aboutBcgSetting'));
})->name('about-us');

Route::get('/executive-committee', function () {
    $aboutBcgSetting = AboutBcgSetting::first();
    $executiveMembers = $aboutBcgSetting?->executive_members ?? [];
    return view('executive-committee', compact('executiveMembers'));
})->name('executive-committee');

Route::get('/general-members', function () {
    $aboutBcgSetting = AboutBcgSetting::first();
    $generalMembers = $aboutBcgSetting?->general_members ?? [];
    return view('general-members', compact('generalMembers'));
})->name('general-members');

Route::get('/news', function () {
    $newsSetting = \App\Models\NewsSetting::first();
    return view('news', compact('newsSetting'));
})->name('news');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/submit', [ContactController::class, 'store'])->name('contact.submit');

Route::get('/notice', [NoticeController::class, 'index'])->name('notice');

Route::get('/be-a-member', [\App\Http\Controllers\MembershipController::class, 'index'])->name('membership');
Route::post('/be-a-member/submit', [\App\Http\Controllers\MembershipController::class, 'store'])->name('membership.submit');
