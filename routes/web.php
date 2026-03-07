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

Route::get('/about/speech', function () {
    $aboutBcgSetting = AboutBcgSetting::first();
    return view('speech', compact('aboutBcgSetting'));
})->name('speech');

Route::get('/about/membership-policy', function () {
    $aboutBcgSetting = AboutBcgSetting::first();
    return view('membership-policy', compact('aboutBcgSetting'));
})->name('membership.policy');

Route::get('/news', function (\Illuminate\Http\Request $request) {
    $newsSetting = \App\Models\NewsSetting::first();
    
    $newsItems = collect($newsSetting?->news_items ?? []);

    if ($request->filled('month')) {
        $month = sprintf('%02d', $request->month);
        $newsItems = $newsItems->filter(function ($item) use ($month) {
            if (empty($item['published_date'])) return false;
            return \Carbon\Carbon::parse($item['published_date'])->format('m') === $month;
        });
    }

    if ($request->filled('year')) {
        $year = $request->year;
        $newsItems = $newsItems->filter(function ($item) use ($year) {
            if (empty($item['published_date'])) return false;
            return \Carbon\Carbon::parse($item['published_date'])->format('Y') == $year;
        });
    }

    if ($newsSetting) {
        $newsSetting->news_items = $newsItems->values()->all();
    }

    return view('news', compact('newsSetting'));
})->name('news');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/submit', [ContactController::class, 'store'])->name('contact.submit');

Route::get('/notice', [NoticeController::class, 'index'])->name('notice');

Route::get('/be-a-member', [\App\Http\Controllers\MembershipController::class, 'index'])->name('membership');
Route::post('/be-a-member/submit', [\App\Http\Controllers\MembershipController::class, 'store'])->name('membership.submit');
