<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\ExportExcelController;
use App\Http\Controllers\Admin\KompetisiFinal;
use App\Http\Controllers\Admin\KompetisiPenyisihan1;
use App\Http\Controllers\Admin\KompetisiPenyisihan2;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\MailController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PostImageController;
use App\Http\Controllers\Admin\TimController;
use App\Kategori;
use App\Mahasiswa;
use App\Ormawa;
use App\Penilaian;
use App\Peserta;
use App\Post;
use App\PostImage;
use App\Submission;
use App\Tim;
use App\User;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
Route::get('/config-cache', function() {
    Artisan::call('config:cache');
    return 'Config cache has been cleared';
});

Route::get('/migrate', function() {
    Artisan::call('migrate', ['--force' => true]);
    return nl2br(Artisan::output() ?: 'Migration executed successfully.');
});

Route::get('/', 'HomeController@index')->name('home');

Route::get('/faq', 'HomeController@faq')->name('faq');
Route::post('/faq/ask', 'HomeController@ask')->name('faq.ask');

Auth::routes();

// Route::get('/register', 'RegisterController@create')->name('register');
// Route::get('/register', function(){
//     // return redirect('/');
// });

Route::get('/post/{post}', 'Admin\PostController@show')->name('post.show');

Route::get('/kompetisi/{kategori}', 'KompetisiController@getPagesByCategory')->name('kompetisi.index');
Route::post('/kompetisi/{kategori}/store', 'Admin\KompetisiPenyisihan1@store')->name('kompetisi.store');
Route::get('/kompetisi/{kategori}/peserta', 'KompetisiController@getPesertasByCategory')->name('kompetisi.peserta');

Route::get('/submit/{token}', 'SubmissionController@getPageSubmit')->name('kompetisi.submit.index');
Route::post('/submit/{token}', 'SubmissionController@submitFile')->name('kompetisi.submit.store');


Route::get('/test', function (){

    $text = "lorem ipsum dolor sit amet";
    $mail = app()->make(Snowfire\Beautymail\Beautymail::class);
    $mail->send('mails.send', compact('text'), function($message){
        $message
            ->from('test' . '@idle.ilkom.unej.ac.id')
            ->to('inisaya7@yahoo.com', 'Miqdadyyy')
            ->subject('Pesan dari IDLe');
    });
});

Route::group(['namespace' => 'Admin', 'as' => 'admin.', 'prefix' => 'admin', 'middleware' =>['auth']], function(){

    Route::get('/', 'AdminController@index')->name('dashboard');
    Route::get('chpwd', 'AdminController@ChangePassword')->name('chpwd');
    Route::post('chpwd', 'AdminController@PostPassword')->name('post.chpwd');

    Route::resource('mahasiswa', 'MahasiswaController');
    Route::resource('tim', 'TimController');
    Route::post('tim/star/{tim}', 'TimController@tandai')->name('tim.tandai');
    Route::resource('post-image', 'PostImageController');
    Route::get('penyisihan-1/set-nilai', 'KompetisiPenyisihan1@getSetNilaiPages')->name('penyisihan-1.set-nilai');
    Route::get('penyisihan-2/set-nilai', 'KompetisiPenyisihan2@getSetNilaiPages')->name('penyisihan-2.set-nilai');
    Route::get('final/set-nilai', 'KompetisiFinal@getSetNilaiPages')->name('final.set-nilai');
    Route::post('penyisihan-1/destroy/{tim}', 'KompetisiPenyisihan1@destroy')->name('tim.destroy');

    Route::group(['middleware' => ['ormawa']], function (){


       // Route::get('penyisihan-1/create/{kategori}', 'KompetisiPenyisihan1@create')->name('penyisihan-1.create');
        Route::post('penyisihan-1/store/{kategori}', 'KompetisiPenyisihan1@store')->name('penyisihan-1.store');
        Route::post('penyisihan-1/update/{kategori}', 'KompetisiPenyisihan1@update')->name('penyisihan-1.update');
        Route::get('penyisihan-1/{kategori}', 'KompetisiPenyisihan1@index')->name('penyisihan-1.index');

        Route::post('penyisihan-2/down/{kategori}/{tim}', 'KompetisiPenyisihan2@destroy')->name('penyisihan-2.destroy');
        Route::get('penyisihan-2/create/{kategori}', 'KompetisiPenyisihan2@create')->name('penyisihan-2.create');
        Route::post('penyisihan-2/store/{kategori}', 'KompetisiPenyisihan2@store')->name('penyisihan-2.store');
//        Route::post('penyisihan-2/update/{kategori}', 'KompetisiPenyisihan2@update')->name('penyisihan-2.update');
        Route::get('penyisihan-2/{kategori}', 'KompetisiPenyisihan2@index')->name('penyisihan-2.index');

        Route::post('final/down/{kategori}/{tim}', 'KompetisiFinal@destroy')->name('final.destroy');
        Route::get('final/create/{kategori}', 'KompetisiFinal@create')->name('final.create');
        Route::post('final/store/{kategori}', 'KompetisiFinal@store')->name('final.store');
//        Route::post('final/update/{kategori}', 'KompetisiFinal@update')->name('final.update');
        Route::get('final/{kategori}', 'KompetisiFinal@index')->name('final.index');

    });

    Route::get('ajax/penyisihan-1/{kategori}', 'AjaxController@getPenyisihan1Tim')->name('ajax.penyisihan1');
    Route::get('ajax/penyisihan-2/{kategori}', 'AjaxController@getPenyisihan2Tim')->name('ajax.penyisihan2');
    Route::get('ajax/final/{kategori}', 'AjaxController@getFinalTim')->name('ajax.final');
    Route::get('ajax/mahasiswas', 'AjaxController@getMahasiswas')->name('ajax.mahasiswa');
    Route::get('ajax/tims', 'AjaxController@getTims')->name('ajax.tim');
    Route::get('ajax/nilai/{id}/{babak}', 'AjaxController@getNilai')->name('ajax.get-nilai');
    Route::post('ajax/nilai', 'AjaxController@setNilai')->name('ajax.set-nilai');
    Route::get('ajax/download/{path}', 'AjaxController@downloadFile')->name('ajax.download');
    Route::get('ajax/images', 'AjaxController@getImages')->name('images.ajax');

    Route::get('post/', 'PostController@index')->name('post.index');
    Route::get('post/create', 'PostController@create')->name('post.create');
    Route::post('post/store', 'PostController@store')->name('post.store');
    Route::get('post/{post}/edit', 'PostController@edit')->name('post.edit');
    Route::post('post/update/{post}', 'PostController@update')->name('post.update');
    Route::post('post/destroy/{post}', 'PostController@destroy')->name('post.destroy');

    Route::get('mail/', 'MailController@getMailPage')->name('mail.page');
    Route::post('mail/mahasiswa', 'MailController@sendMailMahasiswa')->name('mail.mahasiswa');
    Route::post('mail/tim', 'MailController@sendMailTim')->name('mail.tim');
    Route::post('mail/tim-p', 'MailController@sendMailTimParticipation')->name('mail.tim-participation');

    Route::get('export/penyisihan-1/{kategori}', 'ExportExcelController@exportPenyisihan1')->name('export.penyisihan-1');
    Route::get('export/penyisihan-2/{kategori}', 'ExportExcelController@exportPenyisihan2')->name('export.penyisihan-2');
    Route::get('export/final/{kategori}', 'ExportExcelController@exportFinal')->name('export.final');
    Route::get('export/tims', 'ExportExcelController@exportTims')->name('export.tims');
    Route::get('export/mahasiswas', 'ExportExcelController@exportMahasiswas')->name('export.mahasiswas');
});

Route::get('/testmail', 'Admin\MailController@testing');
Route::get('email', 'PHPMailerController@email')->name('email');
 
Route::post('send-email', 'PHPMailerController@composeEmail')->name('send-email');