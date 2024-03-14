<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AccountantController;
use App\Http\Controllers\Backend\AlumniController;
use App\Http\Controllers\Backend\CircularController;
use App\Http\Controllers\Backend\EnquiryController;
use App\Http\Controllers\Backend\ExpenseCategoryController;
use App\Http\Controllers\Backend\HostelManagerController;
use App\Http\Controllers\Backend\HRMController;
use App\Http\Controllers\Backend\ParentController;
use App\Http\Controllers\Backend\SchoolClubController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\LibrarianController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;




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
///Route::group(
   // [
     //   'prefix' => LaravelLocalization::setLocale(),
      //  'middleware' => ['web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
   // ], function(){ //...
   
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/


	
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




///MANAGE CIRCULARS  All Route 
Route::controller(CircularController::class)->group(function(){
    Route::get('/manage/circular', 'ManageCircular')->name('manage.circular');
    Route::post('/store/circular', 'StoreCircular')->name('store.circular');
    Route::get('/edit/circular/{id}', 'EditCircular');
    Route::post('/update/circular', 'UpdateCircular')->name('update.circular');
    Route::get('/delete/circular/{id}', 'DeleteCircular')->name('delete.circular');
});



///MANAGE PARENT  All Route 
Route::controller(ParentController::class)->group(function(){
    Route::get('/all/parent', 'AllParent')->name('all.parent');
    Route::get('/add/parent', 'AddParent')->name('add.parent');
    Route::post('/store/parent', 'StoreParent')->name('store.parent');
    Route::get('/edit/parent/{id}', 'EditParent')->name('edit.parent');
    Route::get('/view/parent/{id}', 'ViewParent')->name('view.parent');
    Route::post('/update/parent', 'UpdateParent')->name('update.parent');
    Route::get('/delete/parent/{id}', 'DeleteParent')->name('delete.parent');

 //   Route::post('/parent/update/password', 'ParentUpdatePassword')->name('parent.update.password');
});


///MANAGE LIBRARIAN  All Route 
Route::controller(LibrarianController ::class)->group(function(){
    Route::get('/all/librarian', 'AllLibrarian')->name('all.librarian');
    Route::get('/add/librarian', 'AddLibrarian')->name('add.librarian');
    Route::post('/store/librarian', 'StoreLibrarian')->name('store.librarian');
    Route::get('/edit/librarian/{id}', 'EditLibrarian')->name('edit.librarian');
    Route::get('/view/librarian/{id}', 'ViewLibrarian')->name('view.librarian');
    Route::post('/update/librarian', 'UpdateLibrarian')->name('update.librarian');
   Route::get('/delete/librarian/{id}', 'DeleteLibrarian')->name('delete.librarian');

});


///MANAGE Hostel Manager  All Route 
Route::controller(HostelManagerController ::class)->group(function(){
    Route::get('/all/hostel/manager', 'AllHostelManager')->name('all.hostelmanager');
    Route::get('/add/hostel/manager', 'AddHostelManager')->name('add.hostelmanager');
    Route::post('/store/hostel/manager', 'StoreHostelManager')->name('store.hostelmanager');
    Route::get('/edit/hostel/manager/{id}', 'EditHostelManager')->name('edit.hostelmanager');
    Route::get('/view/hostel/manager/{id}', 'ViewHostelManager')->name('view.HostelManager');
    Route::post('/update/hostel/manager', 'UpdateHostelManager')->name('update.hostelmanager');
   Route::get('/delete/hostel/manager/{id}', 'DeleteHostelManager')->name('delete.hostelmanager');

});


///MANAGE HRM  All Route 
Route::controller(HRMController ::class)->group(function(){
    Route::get('/all/hrm', 'AllHrm')->name('all.hrm');
    Route::get('/add/hrm', 'AddHrm')->name('add.hrm');
    Route::post('/store/hrm', 'StoreHrm')->name('store.hrm');
    Route::get('/edit/hrm/{id}', 'EditHrm')->name('edit.hrm');
    Route::get('/view/hrm/{id}', 'ViewHrm')->name('view.hrm');
    Route::post('/update/hrm', 'UpdateHrm')->name('update.hrm');
   Route::get('/delete/hrm/{id}', 'DeleteHrm')->name('delete.hrm');

   // Inside your routes/web.php
  Route::get('/download', 'Download')->name('download');


});


///MANAGE ACCOUNTANT  All Route 
Route::controller(AccountantController ::class)->group(function(){
    Route::get('/all/accountant', 'AllAccountant')->name('all.accountant');
    Route::get('/add/accountant', 'AddAccountant')->name('add.accountant');
    Route::post('/store/accountant', 'StoreAccountant')->name('store.accountant');
    Route::get('/edit/accountant/{id}', 'EditAccountant')->name('edit.accountant');
    Route::get('/view/accountant/{id}', 'ViewAccountant')->name('view.accountant');
    Route::post('/update/accountant', 'UpdateAccountant')->name('update.accountant');
   Route::get('/delete/accountant/{id}', 'DeleteAccountant')->name('delete.accountant');

});



///MANAGE ALUMNI  All Route 
Route::controller(AlumniController::class)->group(function(){
    Route::get('/all/alumni', 'AllAlumni')->name('all.alumni');
    Route::get('/add/alumni', 'AddAlumni')->name('add.alumni');
    Route::post('/store/alumni', 'StoreAlumni')->name('store.alumni');
    Route::get('/edit/alumni/{id}', 'EditAlumni')->name('edit.alumni');
    Route::get('/view/alumni/{id}', 'ViewAlumni')->name('view.alumni');
    Route::post('/update/alumni', 'UpdateAlumni')->name('update.alumni');
    Route::get('/delete/alumni/{id}', 'DeleteAlumni')->name('delete.alumni');

});



///Expense Category All Route 
Route::controller(ExpenseCategoryController::class)->group(function(){
    Route::get('/expense/category', 'ExpenseCategory')->name('expense.category');
    Route::post('/store/expense/category', 'StoreExpenseCategory')->name('store.expense.category');
    Route::get('/edit/expense/category/{id}', 'EditExpenseCategory');
    Route::post('/update/expense/category', 'UpdateExpenseCategory')->name('update.expense.category');
    Route::get('/delete/expense/category/{id}', 'DeleteExpenseCategory')->name('delete.expense.category');

});



///Expenses All Route 
Route::controller(ExpenseController::class)->group(function(){
    Route::get('/all/expense', 'AllExpense')->name('all.expense');
    Route::get('/add/expense', 'AddExpense')->name('add.expense');
    Route::post('/store/expense', 'StoreExpense')->name('store.expense');
    Route::get('/edit/expense/{id}', 'EditExpense')->name('edit.expense');
    Route::get('/view/expense/{id}', 'ViewExpense')->name('view.expense');
    Route::post('/update/expense', 'UpdateExpense')->name('update.expense');
    Route::get('/delete/expense/{id}', 'DeleteExpense')->name('delete.expense');

});



///DEPARTMENT All Route 
Route::controller(DepartmentController::class)->group(function(){
    Route::get('/all/department', 'AllDepartment')->name('all.department');
    Route::get('/add/department', 'AddDepartment')->name('add.department');
    Route::post('/store/expense/category', 'StoreDepartment')->name('store.department');
    Route::get('/edit/department/{id}', 'EditDepartment')->name('edit.department');
    Route::post('/update/department/{id}', 'UpdateDepartment')->name('update.department');
    Route::get('/delete/department/{id}', 'DeleteDepartment')->name('delete.department');

});


});///END GROUP ADMIN MIDDLEWARE



//});////localization