<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\EnquiryController;
use App\Http\Controllers\Backend\SchoolClubController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

//Route::get('/dashboard', function () {
  //  return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

//Route::middleware('auth')->group(function () {
  //  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

require __DIR__.'/auth.php';

/// Admin Dashboard
Route::middleware(['auth', 'role:admin'])->group(function(){

Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
Route::post('/admin/profile/update', [AdminController::class, 'AdminProfileUpdate'])->name('admin.profile.update');
Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('update_password');


});




// Admin Group Middleware 
Route::middleware(['auth','role:admin'])->group(function(){


///Settings All Route 
Route::controller(SettingsController::class)->group(function(){
    Route::get('/site/settings', 'SiteSettings')->name('settings');
    Route::post('/update/site/settings', 'UpdateSiteSettings')->name('update.site.settings');
    Route::get('/social/links', 'SocialLinks')->name('social.links');
    Route::post('/update/social/links', 'UpdateSocialLinks')->name('update.social.links'); 
});



///Enquiry Category All Route 
Route::controller(EnquiryController::class)->group(function(){

    Route::get('/enquiry/category', 'EnquiryCategory')->name('enquiry.category');
    Route::post('/store/enquiry/category', 'StoreEnquiryCategory')->name('store.enquiry.category');
    Route::get('/edit/enquiry/category/{id}', 'EditEnquiryCategory');
    Route::post('/update/enquiry/category', 'UpdateEnquiryCategory')->name('update.enquiry.category');
    Route::get('/delete/enquiry/category/{id}', 'DeleteEnquiryCategory')->name('delete.enquiry.category');

    ///Enquiry List

    Route::get('/enquiry/list', 'EnquiryList')->name('enquiry.list');
    Route::get('/delete/enquiry/list/{id}', 'DeleteEnquiryList')->name('delete.enquiry.list');
    Route::get('/view/enquiry/list/{id}', 'ViewEnquiryList');
});



///School Club All Route 
Route::controller(SchoolClubController::class)->group(function(){
    Route::get('/school/club', 'SchoolClub')->name('school.club');
    Route::post('/store/school/club', 'StoreSchoolClub')->name('store.school.club');
    Route::get('/edit/school/club/{id}', 'EditSchoolClub');
    Route::post('/update/school/club', 'UpdateSchoolClub')->name('update.school.club');
    Route::get('/delete/school/club/{id}', 'DeleteSchoolClub')->name('delete.school.club');

});


});