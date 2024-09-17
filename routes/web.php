<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use app\Notifications\CardCreatedNotification;
use app\Notifications\CardApprovalNotification;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});
// routes/web.php
Route::get('/notifications/{id}/redirect', [App\Http\Controllers\NotificationController::class, 'readAndRedirect'])->name('notifications.readAndRedirect');

Route::auth();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Categories and Subjects
    Route::get('/categories/{category}/subjects', [App\Http\Controllers\CategoryController::class, 'getSubjects'])
        ->middleware('permission:categories.index');
    Route::get('/categories/{category}/subjects/{subject}', [App\Http\Controllers\CategoryController::class, 'getSubjectDetails'])
        ->middleware('permission:categories.index');

    // Cards
    Route::resource('cards',  App\Http\Controllers\CardController::class);
       
    Route::get('requests', [App\Http\Controllers\CardController::class, 'requests'])->name('cards.requests')
        ->middleware('permission:cards.index');
    Route::get('exp', [App\Http\Controllers\CardController::class, 'exp'])->name('cards.exp')
        ->middleware('permission:cards.index');
    Route::post('paid', [App\Http\Controllers\CardController::class, 'paid'])->name('paid')
        ->middleware('permission:cards.index');
    
    // Categories
    Route::resource('categories', App\Http\Controllers\CategoryController::class)
        ->middleware('permission:categories.index');

    // Users (Only accessible by super admin | admin and admin)
    Route::resource('users', App\Http\Controllers\UserController::class);
      

    // Attachments
    Route::get('attachments/download/{folder}/{name}', [App\Http\Controllers\CardController::class, 'downloadAttachment'])
        ->name('attachments.downloadAttachment')
        ->middleware('permission:cards.index');

    // PDF Download
    Route::get('/download-pdf/{card}', 'App\Http\Controllers\PDFController@download')
        ->middleware('permission:cards.show');

    // Public Card Display
    Route::get('/card/{id}', [App\Http\Controllers\CardController::class, 'showpublic'])->name('card');
    // Routes outside authentication
    Route::resource('subjects', App\Http\Controllers\SubjectController::class)
        ->middleware('permission:subjects.index');
    
    Route::resource('examSchedules', App\Http\Controllers\ExamScheduleController::class)
        ->middleware('permission:examSchedules.index');
    
    Route::resource('examScheduleItems', App\Http\Controllers\ExamScheduleItemController::class)
        ->middleware('permission:examScheduleItems.index');
        Route::post('/admin/check-card-availability', [App\Http\Controllers\UserController::class, 'checkCardAvailability'])
    ->name('admin.checkCardAvailability');
    Route::get('/admin/scan-qr', [App\Http\Controllers\UserController::class, 'showQrScanner'])->name('admin.scanQr');
    Route::post('/admin/verify-card', [App\Http\Controllers\UserController::class, 'verifyCard'])->name('admin.verifyCard');
    Route::post('/cards/{id}/reject', [App\Http\Controllers\CardController::class, 'reject'])->name('cards.reject');
    Route::resource('notifications', App\Http\Controllers\NotificationController::class);

    // routes/web.php



    

});


    Route::middleware(['auth', 'role:student'])->group(function () {
        Route::get('/my-card', [App\Http\Controllers\CardController::class, 'myCard'])->name('my.card');
        Route::get('/my-subjects', [App\Http\Controllers\SubjectController::class, 'index'])->name('my.subjects');
        Route::get('/my-exam-schedule', [App\Http\Controllers\ExamScheduleController::class, 'mySchedule'])->name('my.examSchedule');
        Route::get('/my-profile', [App\Http\Controllers\UserController::class, 'show'])->name('my.profile');
        Route::get('/edit-my-profile', [App\Http\Controllers\UserController::class, 'edit'])->name('edit.my.profile');

        Route::patch('/update-my-profile', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('my-profile.update');

    });
    
    Route::middleware(['auth', 'role:student'])->group(function () {
        Route::get('student/subjects', [App\Http\Controllers\SubjectController::class, 'showAddSubjectsForm'])->name('student.subjects.add');
        Route::post('student/subjects', [App\Http\Controllers\SubjectController::class, 'addSubject'])->name('student.subjects.store');
    });
    Broadcast::routes(['middleware' => ['auth']]);


Route::resource('notifications', App\Http\Controllers\NotificationController::class);


Route::resource('roles', App\Http\Controllers\RoleController::class);
