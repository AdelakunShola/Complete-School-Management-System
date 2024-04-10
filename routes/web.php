<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AccountantController;
use App\Http\Controllers\Backend\AlumniController;
use App\Http\Controllers\Backend\AwardController;
use App\Http\Controllers\Backend\CircularController;
use App\Http\Controllers\Backend\ClassController;
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
use App\Http\Controllers\Backend\JobApplicantController;
use App\Http\Controllers\Backend\ManageStudentController;
use App\Http\Controllers\Backend\PayrollController;
use App\Http\Controllers\Backend\SchoolHostelController;
use App\Http\Controllers\Backend\SchoolLeaveController;
use App\Http\Controllers\Backend\SectionController;
use App\Http\Controllers\Backend\SubjectController;
use App\Http\Controllers\Backend\SyllabusController;
use App\Http\Controllers\Backend\TeacherController;
use App\Http\Controllers\Backend\TimetableController;
use App\Http\Controllers\Backend\TransportationController;
use App\Http\Controllers\Backend\VacancyController;
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


///MANAGE TEACHER  All Route 
Route::controller(TeacherController ::class)->group(function(){
    Route::get('/all/teacher', 'AllTeacher')->name('all.teacher');
    Route::get('/add/teacher', 'AddTeacher')->name('add.teacher');
    Route::post('/store/teacher', 'StoreTeacher')->name('store.teacher');
    Route::get('/edit/teacher/{id}', 'EditTeacher')->name('edit.teacher');
    Route::get('/view/teacher/{id}', 'ViewTeacher')->name('view.teacher');
    Route::post('/update/teacher', 'UpdateTeacher')->name('update.teacher');
   Route::get('/delete/teacher/{id}', 'DeleteTeacher')->name('delete.teacher');

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
    Route::get('/all/expense/category', 'AllExpenseCategory')->name('all.expense.category');
    Route::post('/store/expense/category', 'StoreExpenseCategory')->name('store.expense.cat');
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

    Route::get('/designation/ajax/{department_id}' , 'GetDesignation');


});


///School Leave All Route 
Route::controller(SchoolLeaveController::class)->group(function(){
    Route::get('/school/leave', 'SchoolLeave')->name('school.leave');
    Route::post('/store/school/leave', 'StoreSchoolClub')->name('store.school.leave');
    Route::get('/edit/school/leave/{id}', 'EditSchoolLeave');
    Route::post('/update/school/leave', 'UpdateSchoolLeave')->name('update.school.leave');
    Route::get('/delete/school/leave/{id}', 'DeleteSchoolLeave')->name('delete.school.leave');

});


///MANAGE AWARD All Route 
Route::controller(AwardController::class)->group(function(){
    Route::get('/manage/award', 'ManageAward')->name('manage.award');
    Route::post('/store/award', 'StoreAward')->name('store.award');
    Route::get('/edit/award/{id}', 'EditAward');
    Route::post('/update/award', 'UpdateAward')->name('update.award');
    Route::get('/delete/award/{id}', 'DeleteAward')->name('delete.award');

});




///MANAGE VACANCIES All Route 
Route::controller(VacancyController::class)->group(function(){
    Route::get('/manage/vacancy', 'ManageVacancy')->name('manage.vacancy');
    Route::post('/store/vacancy', 'StoreVacancy')->name('store.vacancy');
    Route::get('/edit/vacancy/{id}', 'EditVacancy');
    Route::post('/update/vacancy', 'UpdateVacancy')->name('update.vacancy');
    Route::get('/delete/vacancy/{id}', 'DeleteVacancy')->name('delete.vacancy');

});



///ALL JOB APPLICATIONS  All Route 
Route::controller(JobApplicantController ::class)->group(function(){
    Route::get('/all/application', 'AllApplication')->name('all.application');
    Route::get('/add/application', 'AddApplication')->name('add.application');
    Route::post('/store/application', 'StoreApplication')->name('store.application');
    Route::get('/view/application/{id}', 'ViewApplication')->name('view.application');
    Route::post('/update/application', 'UpdateApplication')->name('update.application');
    Route::get('/edit/application/{id}', 'EditApplication')->name('edit.application');

    Route::get('/delete/application/{id}', 'DeleteApplication')->name('delete.application');

    Route::get('download/cover_letter/{id}', 'downloadCoverLetter')->name('download.cover_letter');
    Route::get('download/cv/{id}', 'downloadCV')->name('download.cv');
    

});



///MANAGE PAYROLL All Route 
Route::controller(PayrollController::class)->group(function(){
    Route::get('/all/payroll', 'AllPayroll')->name('all.payroll');
    Route::get('/add/payroll', 'AddPayroll')->name('add.payroll');
    Route::post('/store/payroll', 'StorePayroll')->name('store.payroll');
    Route::get('/payroll/details/{id}', 'PayrollDetail')->name('payroll.detail');
    Route::get('/edit/payroll/{id}', 'EditPayroll')->name('payroll.edit');
    Route::get('/view/payroll/{id}', 'ViewPayroll')->name('view.payroll');
    Route::post('/update/payroll/{id}', 'UpdatePayroll')->name('update.payroll');

    Route::get('/getTeacher/ajax/{department_id}', 'GetEmployeeName');
    Route::get('/getSalary/ajax/{user_id}', 'GetSalary');

    Route::post('/update/payroll/mark-as-paid', 'MarkAsPaid')->name('update.paid');
    Route::post('/update/payroll/mark-as-unpaid', 'MarkAsUnpaid')->name('update.unpaid');


});




///Manage SECTION All Route 
Route::controller(SectionController::class)->group(function(){
    Route::get('/manage/section', 'ManageSection')->name('manage.section');
    Route::post('/store/section', 'StoreSection')->name('store.section');
    Route::get('/edit/section/{id}', 'EditSection');
    Route::post('/update/section', 'UpdateSection')->name('update.section');
    Route::get('/delete/section/{id}', 'DeleteSection')->name('delete.section');

});



///Manage Classes All Route 
Route::controller(ClassController::class)->group(function(){
    Route::get('/manage/class', 'ManageClasses')->name('manage.classes');
    Route::post('/store/class', 'StoreClass')->name('store.class');
    Route::get('/edit/class/{id}', 'EditClass');
    Route::post('/update/class', 'UpdateClass')->name('update.class');
    Route::get('/delete/class/{id}', 'DeleteClass')->name('delete.class');

});



///Manage Subject All Route 
Route::controller(SubjectController::class)->group(function(){
    Route::get('/manage/subject', 'ManageSubject')->name('manage.subject');
    Route::post('/store/subject', 'StoreSubject')->name('store.subject');
    Route::get('/edit/subject/{id}', 'EditSubject');
    Route::post('/update/subject', 'UpdateSubject')->name('update.subject');
    Route::get('/delete/subject/{id}', 'DeleteSubject')->name('delete.subject');

});




///Manage TIMETABLE or CLASS ROUTINE All Route 
Route::controller(TimetableController::class)->group(function(){
    Route::get('/all/timetable', 'AllTimetable')->name('all.timetable');
    Route::get('/add/timetable', 'AddTimetable')->name('add.timetable');
    Route::post('/store/timetable', 'StoreTimetable')->name('store.timetable');
    Route::get('/edit/timetable/{id}', 'EditTimetable')->name('edit.timetable');
    Route::post('/update/timetable', 'UpdateTimetable')->name('update.timetable');
    Route::get('/view/timetable/{class_id}/{section_id}', 'ViewTimetable')->name('view.timetable');
    Route::get('/delete/timetable/{id}', 'DeleteTimetable')->name('delete.timetable');
   
    Route::get('/class/details/{class_id}', 'ShowDetails')->name('class.details');

    Route::get('/subject/ajax/{class_id}' , 'GetSubject');
    Route::get('/section/ajax/{class_id}' , 'getSectionsByClass');
    Route::get('/get/timetable', 'GetTimetable');

});



///hostel CATEGORY All Route 
Route::controller(SchoolHostelController::class)->group(function(){
    Route::get('/hostel/category', 'HostelCategory')->name('hostel.category');
    Route::post('/store/hostel/category', 'StoreHostelCategory')->name('store.hostel.category');
    Route::get('/edit/hostel/category/{id}', 'EditHostelCategory');
    Route::post('/update/hostel/category', 'UpdateHostelCategory')->name('update.hostel.category');
    Route::get('/delete/hostel/category/{id}', 'DeleteHostelCategory')->name('delete.hostel.category');

});



///hostel ROOM All Route 
Route::controller(SchoolHostelController::class)->group(function(){
    Route::get('/hostel/room', 'HostelRoom')->name('hostel.room');
    Route::post('/store/hostel/room', 'StoreHostelRoom')->name('store.hostel.room');
    Route::get('/edit/hostel/room/{id}', 'EditHostelRoom');
    Route::post('/update/hostel/room', 'UpdateHostelRoom')->name('update.hostel.room');
    Route::get('/delete/hostel/room/{id}', 'DeleteHostelRoom')->name('delete.hostel.room');

});



///SCHOOL HOSTEL All Route 
Route::controller(SchoolHostelController::class)->group(function(){
    Route::get('/all/hostel', 'AllHostel')->name('all.hostel');
    Route::get('/add/hostel', 'AddHostel')->name('add.hostel');
    Route::post('/store/hostel', 'StoreHostel')->name('store.hostel');
    Route::get('/edit/hostel/{id}', 'EditHostel')->name('edit.hostel');
    Route::post('/update/hostel', 'UpdateHostel')->name('update.hostel');
    Route::get('/delete/hostel/{id}', 'DeleteHostel')->name('delete.hostel');

    Route::get('/view/hostel/{id}', 'ViewHostel')->name('view.hostel');
    
});



///STUDENT HOUSE All Route 
Route::controller(ManageStudentController::class)->group(function(){
    Route::get('/student/house', 'StudentHouse')->name('student.house');
    Route::post('/store/student/house', 'StoreStudentHouse')->name('store.student.house');
    Route::get('/edit/student/house/{id}', 'EditStudentHouse');
    Route::post('/update/student/house', 'UpdateStudentHouse')->name('update.student.house');
    Route::get('/delete/student/house/{id}', 'DeleteStudentHouse')->name('delete.student.house');

});




///STUDENT CATEGORY All Route 
Route::controller(ManageStudentController::class)->group(function(){
    Route::get('/student/category', 'StudentCategory')->name('student.category');
    Route::post('/store/student/category', 'StoreStudentCategory')->name('store.student.category');
    Route::get('/edit/student/category/{id}', 'EditStudentCategory');
    Route::post('/update/student/category', 'UpdateStudentCategory')->name('update.student.category');
    Route::get('/delete/student/category/{id}', 'DeleteStudentCategory')->name('delete.student.category');

});



///MANAGE STUDENT INFORMATION All Route 
Route::controller(ManageStudentController::class)->group(function(){
    Route::get('/all/student', 'AllStudent')->name('all.student');
    Route::get('/add/student', 'AddStudent')->name('add.student');
    Route::post('/store/student', 'StoreStudent')->name('store.student');
    Route::get('/edit/student/{id}', 'EditStudent')->name('edit.student');
    Route::post('/update/student', 'UpdateStudent')->name('update.student');
    Route::get('/delete/student/{id}', 'DeleteStudent')->name('delete.student');

    Route::post('/view/student/{id}', 'ViewStudent')->name('view.student');
    Route::get('/sections/ajax/{class_id}' , 'getSectionByClass');

});




///TRANSPORTATION All Route 
Route::controller(TransportationController::class)->group(function(){
    Route::get('/manage/transport', 'ManageTransport')->name('manage.transport');
    Route::post('/store/transport', 'StoreTransport')->name('store.transport');
    Route::get('/edit/transport/{id}', 'EditTransport');
    Route::post('/update/transport', 'UpdateTransport')->name('update.transport');
    Route::get('/delete/transport/{id}', 'DeleteTransport')->name('delete.transport');

});



///Manage Vehicle All Route 
Route::controller(TransportationController::class)->group(function(){
    Route::get('/manage/vehicle', 'ManageVehicle')->name('manage.vehicle');
    Route::post('/store/vehicle', 'StoreVehicle')->name('store.vehicle');
    Route::get('/edit/vehicle/{id}', 'EditVehicle');
    Route::post('/update/vehicle', 'UpdateVehicle')->name('update.vehicle');
    Route::get('/delete/vehicle/{id}', 'DeleteVehicle')->name('delete.vehicle');

});



///Transport Route All Route 
Route::controller(TransportationController::class)->group(function(){
    Route::get('/transport/route', 'TransportRoute')->name('transport.route');
    Route::post('/store/transport/route', 'StoreTransportRoute')->name('store.transport.route');
    Route::get('/edit/transport/route/{id}', 'EditTransportRoute');
    Route::post('/update/transport/route', 'UpdateTransportRoute')->name('update.transport.route');
    Route::get('/delete/transport/route/{id}', 'DeleteTransportRoute')->name('delete.transport.route');

});



///Manage Driver All Route 
Route::controller(TransportationController::class)->group(function(){
    Route::get('/manage/driver', 'ManageDriver')->name('manage.driver');
    Route::post('/store/driver', 'StoreDriver')->name('store.driver');
    Route::get('/edit/driver/{id}', 'EditDriver')->name('edit.driver');
    Route::post('/update/driver', 'UpdateDriver')->name('update.driver');
    Route::get('/delete/driver/{id}', 'DeleteDriver')->name('delete.driver');

});



///SCHOOL SYLLABUS All Route 
Route::controller(SyllabusController::class)->group(function(){
    Route::get('/all/syllabus', 'AllSyllabus')->name('all.syllabus');
    Route::get('/add/syllabus', 'AddSyllabus')->name('add.syllabus');
    Route::post('/store/syllabus', 'StoreSyllabus')->name('store.syllabus');
   
    Route::post('/update/syllabus', 'UpdateSyllabus')->name('update.syllabus');
    Route::get('/delete/syllabus/{id}', 'DeleteSyllabus')->name('delete.syllabus');

    Route::get('/view/syllabus/{id}', 'ViewSyllabus')->name('view.syllabus');
    
});



});///END GROUP ADMIN MIDDLEWARE



//});////localization