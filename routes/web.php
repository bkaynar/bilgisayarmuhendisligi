<?php

use App\Http\Controllers\Admin\HaberController;
use App\Http\Controllers\Admin\HedefController;
use App\Http\Controllers\Admin\LaboratuvarController;
use App\Http\Controllers\Admin\MufredatController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\AkademikPersonelController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HaberlerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HakkimizdaController;
use App\Http\Controllers\Admin\EtkinlikController;


Route::get('/add-user', function () {
    $name = 'burak';
    $email = 'kaynar.burak@ogr.ahievran.edu.tr';
    $password = bcrypt('kaynar.burak@ogr.ahievran.edu.tr');

    // Veritabanına kullanıcıyı ekle
    DB::table('users')->insert([
        'name' => $name,
        'email' => $email,
        'password' => $password,
    ]);
    return view('dashboard');
});
Route::get('about', [HakkimizdaController::class, 'index'])
    ->name('about');

Route::get('academic-staff', [AkademikPersonelController::class, 'index'])->name('academic-staff');
Route::get('academic-staff/{id}', [AkademikPersonelController::class, 'show'])->name('academic-staff-details');

Route::get('labs',[App\Http\Controllers\LaboratuvarController::class, 'index'])->name('labs');
Route::get('labs/{id}', [App\Http\Controllers\LaboratuvarController::class, 'show'])
    ->name('labs-details');
Route::get('{locale}/labs/{id}', [App\Http\Controllers\LaboratuvarController::class, 'show'])
    ->where('locale', 'tr|en')
    ->name('labs-details-locale');


Route::get('news', [HaberlerController::class, 'index'])->name('news');

Route::get('news/{id}', [App\Http\Controllers\HaberlerController::class, 'show'])
    ->name('habers.show');

Route::get('contact', function () {
    return view('mainlayout.contact');
})->name('contact');
Route::post('contact-store', [ContactController::class, 'store'])->name('contact.store');

// Dil değiştirme rotası
Route::get('dil/{locale}', function ($locale) {
    if (in_array($locale, config('app.available_locales', ['tr', 'en']))) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('dil.degistir');


// Diğer rotalar...
Route::get('/', function () {
    return view('mainlayout.index');
})->name('home');

Route::get('/admin', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('admin');

Route::middleware('auth')->prefix('admin')->group(function () {

    // Admin panel
    Route::get('/hakkimizda/duzenle', [App\Http\Controllers\Admin\HakkimizdaController::class, 'edit'])
        ->name('hakkimizda.duzenle');

    Route::put('/hakkimizda/guncelle/{id}', [App\Http\Controllers\Admin\HakkimizdaController::class, 'update'])
        ->name('hakkimizda-guncelle');

    Route::get('/akademik-personel', [App\Http\Controllers\Admin\AkademikPersonelController::class, 'index'])
        ->name('akademik-personel');

    Route::get('akademik-personel/ekle', [App\Http\Controllers\Admin\AkademikPersonelController::class, 'create'])
        ->name('akademik-personel-ekle');

    Route::post('akademik-personel/kaydet', [App\Http\Controllers\Admin\AkademikPersonelController::class, 'store'])
        ->name('akademikEkle');

    Route::get('akademik-personel/duzenle/{id}', [App\Http\Controllers\Admin\AkademikPersonelController::class, 'edit'])
        ->name('akademik-personel-duzenle');

    Route::put('akademik-personel/guncelle/{id}', [App\Http\Controllers\Admin\AkademikPersonelController::class, 'update'])
        ->name('akademik-guncelle');

    Route::get('/slider', [SliderController::class, 'index'])->name('slider.index');
    Route::get('/slider/create', [SliderController::class, 'create'])->name('slider.create');
    Route::post('/slider', [SliderController::class, 'store'])->name('slider.store');
    Route::get('/slider/{id}/edit', [SliderController::class, 'edit'])->name('slider.edit');
    Route::put('/slider/{id}', [SliderController::class, 'update'])->name('slider.update');
    Route::delete('/slider/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');

    Route::resource('laboratuvar', LaboratuvarController::class);
    Route::resource('hedefler', HedefController::class);
    Route::resource('etkinlik', EtkinlikController::class);
    Route::resource('haber', HaberController::class);
    Route::resource('mufredat', MufredatController::class);

    Route::get('iletisim', [ContactController::class, 'index'])->name('iletisim.index');
    Route::get('iletisim/{id}', [ContactController::class, 'show'])->name('iletisim.show');

    Route::get('sifre-degistir',function(){
        return view('auth.sifre-degistir');
    })->name('sifre-degistir');

    Route::put('/password-update', [PasswordController::class,'update'])->name('password.update');


});

require __DIR__.'/auth.php';
