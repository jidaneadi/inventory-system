<?php

use App\Http\Livewire\Aset\CreateAset;
use App\Http\Livewire\Aset\ManajemenAset;
use App\Http\Livewire\Aset\UpdateAset;
use App\Http\Livewire\BootstrapTables;
use App\Http\Livewire\Components\Buttons;
use App\Http\Livewire\Components\Forms;
use App\Http\Livewire\Components\Modals;
use App\Http\Livewire\Components\Notifications;
use App\Http\Livewire\Components\Typography;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Err404;
use App\Http\Livewire\Err500;
use App\Http\Livewire\ResetPassword;
use App\Http\Livewire\ForgotPassword;
use App\Http\Livewire\Lock;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Bahan\CreateBahan;
use App\Http\Livewire\Bahan\ManajemenBahan;
use App\Http\Livewire\Bahan\UpdateBahan;
use App\Http\Livewire\Divisi\CreateDivisi;
use App\Http\Livewire\Divisi\ManajemenDivisi;
use App\Http\Livewire\Divisi\UpdateDivisi;
use App\Http\Livewire\ForgotPasswordExample;
use App\Http\Livewire\Gedung\CreateGedung;
use App\Http\Livewire\Gedung\ManajemenGedung;
use App\Http\Livewire\Gedung\UpdateGedung;
use App\Http\Livewire\HistoryAset\CreateHistoryAset;
use App\Http\Livewire\HistoryAset\ManajemenHistoryAset;
use App\Http\Livewire\HistoryAset\UpdateHistoryAset;
use App\Http\Livewire\Index;
use App\Http\Livewire\JenisAset\CreateJenisAset;
use App\Http\Livewire\JenisAset\ManajemenJenisAset;
use App\Http\Livewire\JenisAset\UpdateJenisAset;
use App\Http\Livewire\LoginExample;
use App\Http\Livewire\Merk\CreateMerk;
use App\Http\Livewire\Merk\ManajamenMerk;
use App\Http\Livewire\Merk\UpdateMerk;
use App\Http\Livewire\Pic\CreatePic;
use App\Http\Livewire\Pic\ManajamenPic;
use App\Http\Livewire\Pic\UpdatePic;
use App\Http\Livewire\ProfileExample;
use App\Http\Livewire\RegisterExample;
use App\Http\Livewire\Transactions;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ResetPasswordExample;
use App\Http\Livewire\Ruangan\CreateRuangan;
use App\Http\Livewire\Ruangan\ManajemenRuangan;
use App\Http\Livewire\Ruangan\UpdateRuangan;
use App\Http\Livewire\UpgradeToPro;
use App\Http\Livewire\Users;

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

Route::redirect('/', '/login');

Route::get('/register', Register::class)->name('register');

Route::get('/login', Login::class)->name('login');

Route::get('/forgot-password', ForgotPassword::class)->name('forgot-password');

Route::get('/reset-password/{id}', ResetPassword::class)->name('reset-password')->middleware('signed');

Route::get('/404', Err404::class)->name('404');
Route::get('/500', Err500::class)->name('500');
Route::get('/upgrade-to-pro', UpgradeToPro::class)->name('upgrade-to-pro');

Route::middleware('auth')->group(function () {
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/profile-example', ProfileExample::class)->name('profile-example');
    Route::get('/users', Users::class)->name('users');
    Route::get('/login-example', LoginExample::class)->name('login-example');
    Route::get('/register-example', RegisterExample::class)->name('register-example');
    Route::get('/forgot-password-example', ForgotPasswordExample::class)->name('forgot-password-example');
    Route::get('/reset-password-example', ResetPasswordExample::class)->name('reset-password-example');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/transactions', Transactions::class)->name('transactions');
    Route::get('/bootstrap-tables', BootstrapTables::class)->name('bootstrap-tables');
    Route::get('/lock', Lock::class)->name('lock');
    Route::get('/buttons', Buttons::class)->name('buttons');
    Route::get('/notifications', Notifications::class)->name('notifications');
    Route::get('/forms', Forms::class)->name('forms');
    Route::get('/modals', Modals::class)->name('modals');
    Route::get('/typography', Typography::class)->name('typography');
    Route::get('/aset', ManajemenAset::class)->name('manajemen-aset');
    // Route::delete('/aset/delete/{id_aset}', [ManajemenAset::class, 'destroy'])->name('manajemen-aset');
    Route::get('/aset/create', CreateAset::class)->name('create-aset');
    Route::post('/aset/store', [CreateAset::class, 'store'])->name('create-aset');
    Route::get('/aset/update/{id_aset}', UpdateAset::class)->name('update-aset');
    Route::get('/ruangan', ManajemenRuangan::class)->name('manajemen-ruangan');
    Route::get('/ruangan/create', CreateRuangan::class)->name('create-ruangan');
    Route::post('/ruangan/store', [CreateRuangan::class, 'store'])->name('create-ruangan');
    Route::get('/ruangan/update/{id_ruang}', UpdateRuangan::class)->name('update-ruangan');
    Route::get('/gedung', ManajemenGedung::class)->name('manajemen-gedung');
    Route::get('/gedung/create', CreateGedung::class)->name('create-gedung');
    Route::post('/gedung/store', [CreateGedung::class, 'store'])->name('create-gedung');
    Route::get('/gedung/update/{id_gedung}', UpdateGedung::class)->name('update-gedung');
    Route::get('/jenis-aset', ManajemenJenisAset::class)->name('manajemen-jenis-aset');
    Route::get('/jenis-aset/create', CreateJenisAset::class)->name('create-jenis-aset');
    Route::post('/jenis-aset/store', [CreateJenisAset::class, 'store'])->name('create-jenis-aset');
    Route::get('/jenis-aset/update/{id_jenis}', UpdateJenisAset::class)->name('update-jenis-aset');
    Route::get('/divisi', ManajemenDivisi::class)->name('manajemen-divisi');
    Route::get('/divisi/create', CreateDivisi::class)->name('create-divisi');
    Route::post('/divisi/store', [CreateDivisi::class, 'store'])->name('create-divisi');
    Route::get('/divisi/update/{id_divisi}', UpdateDivisi::class)->name('update-divisi');
    Route::get('/bahan', ManajemenBahan::class)->name('manajemen-bahan');
    Route::get('/bahan/create', CreateBahan::class)->name('create-bahan');
    Route::post('/bahan/store', [Createbahan::class, 'store'])->name('create-bahan');
    Route::get('/bahan/update/{id_bahan}', UpdateBahan::class)->name('update-bahan');
    Route::get('/merk', ManajamenMerk::class)->name('manajemen-merk');
    Route::get('/merk/create', CreateMerk::class)->name('create-merk');
    Route::post('/merk/store', [Createmerk::class, 'store'])->name('create-merk');
    Route::get('/merk/update/{id_merk}', UpdateMerk::class)->name('update-merk');
    Route::get('/pic', ManajamenPic::class)->name('manajemen-pic');
    Route::get('/pic/create', CreatePic::class)->name('create-pic');
    Route::post('/pic/store', [Createpic::class, 'store'])->name('create-pic');
    Route::get('/pic/update/{id_pic}', UpdatePic::class)->name('update-pic');
    Route::get('/history-aset', ManajemenHistoryAset::class)->name('manajemen-history-aset');
    Route::get('/history-aset/create', CreateHistoryAset::class)->name('create-history-aset');
    Route::post('/history-aset/store', [CreateHistoryAset::class, 'store'])->name('create-history-aset');
    Route::get('/history-aset/update/{id}', UpdateHistoryAset::class)->name('update-history-aset');
});
