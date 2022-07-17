<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\KondisiRumahController;
use App\Http\Controllers\JenisBeasiswaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\TernakDetailController;
use App\Http\Controllers\PenghasilanController;
use App\Http\Controllers\RumahDetailController;
use App\Http\Controllers\AsuransiController;
use App\Http\Controllers\TanggunganAnakController;
use App\Http\Controllers\AssetsDetailController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\BeasiswaController;


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

Auth::routes();

Route::get('/', function () {
    return view('beranda');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/daftar-beasiswa', [App\Http\Controllers\BeasiswaController::class, 'index']);

Route::resource('/daftar-beasiswa/post', BeasiswaController::class);
Route::get('/hasil-pengumuman', [App\Http\Controllers\BeasiswaController::class, 'hasilPengumuman']);


Route::group(['middleware' => ['auth']], function() {
    Route::resource('admin/role', RoleController::class);
    Route::resource('admin/user', UserController::class);

    // Route  orang tua
    Route::resource('admin/orangtua', OrangTuaController::class);
    Route::get('admin/hapusortu/{id}', [OrangTuaController::class , 'hapusortu' ]);
    Route::get('admin/ubahortu/{id}', [OrangTuaController::class , 'ubahortu' ]);

    // Route  kondisi tempat tinggal
    Route::resource('admin/kondisi' , KondisiRumahController::class );
    Route::get('admin/hapuskondisi/{id}', [KondisiRumahController::class , 'hapuskondisi' ]);
    Route::get('admin/editkondisi/{id}', [KondisiRumahController::class , 'edit' ]);

    // Route  jenis beasiswa
    Route::resource('admin/beasiswa' , JenisBeasiswaController::class );
    Route::get('admin/getBeasiswa' , [JenisBeasiswaController::class , 'getBeasiswa'] );

    // Route  siswa
    Route::resource('admin/siswa' , SiswaController::class );
    Route::get('admin/hapussiswa/{id}' , [SiswaController::class , 'hapussiswa' ]);

    // Route priode beasiswa
    Route::resource('admin/periode' , PeriodeController::class );
    Route::get('admin/hapusperiode/{id}', [PeriodeController::class , 'hapusperiode' ]);
    Route::get('admin/ubahperiode/{id}', [PeriodeController::class , 'ubahperiode' ]);

    // Route pendaftaran
    Route::resource('admin/pendaftar' , PendaftarController::class );
    Route::get('admin/hapuspendaftar/{id}', [PendaftarController::class , 'hapuspendaftar' ]);

    // Route poperti / assets
    Route::get('admin/assets', [AssetsDetailController::class, 'index'])->name('poperti.index');
    Route::get('admin/getassets' , [AssetsDetailController::class , 'getassets']);
    Route::get('admin/assets/create' , [AssetsDetailController::class , 'create' ]);
    Route::post('admin/simpanasstes' , [AssetsDetailController::class , 'simpanasstes' ]);
    Route::post('admin/simpanassetsdetail/{id}' , [AssetsDetailController::class , 'simpanassetsdetail' ]);
    Route::get('admin/editassets/{id}', [AssetsDetailController::class, 'showedit']);
    Route::get('admin/ubahassets/{id}', [AssetsDetailController::class, 'ubahassets']);
    Route::get('admin/ubahassetsdetail/{id}', [AssetsDetailController::class, 'ubahassetsdetail']);

    // Route asuransi kesehatan
    Route::resource('admin/asuransi' , AsuransiController::class );
    Route::get('admin/hapusasuransi/{id}', [AsuransiController::class , 'hapusasuransi' ]);
    Route::get('admin/ubahasuransi/{id}', [AsuransiController::class , 'ubahasuransi' ]);

    // Route tanggungan anak sekolah
    Route::resource('admin/tanggungan' , TanggunganAnakController::class );
    Route::get('admin/hapustanggungan/{id}', [TanggunganAnakController::class , 'hapustanggungan' ]);
    Route::get('admin/ubahtanggungan/{id}', [TanggunganAnakController::class , 'ubahtanggungan' ]);

    // Route penghasilan ortu
    Route::resource('admin/penghasilan' , PenghasilanController::class );
    Route::get('admin/hapuspenghasilan/{id}', [PenghasilanController::class , 'hapuspenghasilan' ]);
    Route::get('admin/ubahpenghasilan/{id}', [PenghasilanController::class , 'ubahpenghasilan' ]);

    // Route ternak detail
    // Route::get('admin/ternak' , [TernakDetailController::class , 'index' ]);
    Route::get('admin/ternak', [TernakDetailController::class, 'index'])->name('ternak.index');
    Route::get('admin/getternak' , [TernakDetailController::class , 'getternak']);
    Route::get('admin/ternak/create' , [TernakDetailController::class , 'create' ]);
    Route::post('admin/simpanternak' , [TernakDetailController::class , 'simpanternak' ]);
    Route::post('admin/simpanternakdetail/{id}' , [TernakDetailController::class , 'simpanternakdetail' ]);
    Route::get('admin/editternak/{id}', [TernakDetailController::class, 'showedit']);
    Route::get('admin/ubahternak/{id}', [TernakDetailController::class, 'ubahternak']);
    Route::get('admin/ubahternakdetail/{id}', [TernakDetailController::class, 'ubahternakdetail']);

    // Route rumah / kondisi
    Route::get('admin/rumah', [RumahDetailController::class, 'index'])->name('rumah.index');
    Route::get('admin/getrumah' , [RumahDetailController::class , 'getrumah']);
    Route::get('admin/rumah/create' , [RumahDetailController::class , 'create' ]);
    Route::post('admin/simpanrumah' , [RumahDetailController::class , 'simpanrumah' ]);
    Route::post('admin/simpanrumahdetail/{id}' , [RumahDetailController::class , 'simpanrumahdetail' ]);

    // Route penilaian
    Route::resource('admin/penilaian' , PenilaianController::class );
    Route::post('admin/acc-beasiswa' , [PenilaianController::class, 'accBeasiswa'] );
    Route::get('admin/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
    Route::get('admin/hitungpenilaian', [PenilaianController::class, 'hitungpenilaian'])->name('penilaian.hitung');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

