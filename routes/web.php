<?php

use App\Http\Controllers\User\UserLogicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Barber\BarberController;


Route::get('/', function () {
    return view('dashboard.user.index');
});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('user')->name('user.')->group(function(){
  
    Route::middleware(['guest:web','PreventBackHistory'])->group(function(){
          Route::view('/login','dashboard.user.login')->name('login');
          Route::view('/register','dashboard.user.register')->name('register');
          Route::post('/create',[UserController::class,'create'])->name('create');
          Route::post('/check',[UserController::class,'check'])->name('check');
    });

    Route::middleware(['auth:web','PreventBackHistory'])->group(function(){
          Route::view('/home','dashboard.user.index')->name('home');
          Route::post('/logout',[UserController::class,'logout'])->name('logout');
          Route::get('/add-new',[UserController::class,'add'])->name('add');
    });

});

// delete/appoinment/user/
Route::get('delete/appoinment/user/{id}', [UserLogicController::class, 'DeleteUserCancelAppinment']);
//account/permition/
Route::get('doctor/account/permition/{id}', [App\Http\Controllers\HomeController::class, 'DoctorAccountPermition']);


Route::post('doctor/search', [UserLogicController::class, 'SearchDoctor'])->name('doctor.search');
Route::get('view/profile/{id}', [UserLogicController::class, 'viewProfile']);
Route::get('appoinment/{id}', [UserLogicController::class, 'appoinmentDoctor']);
Route::post('doctor/appoinment/', [UserLogicController::class, 'appoinment'])->name('doctor.appoinment');

Route::get('user/profile/show', [UserLogicController::class, 'UserProfileShow'])->name('user.profile.show');
//user.profile.update
Route::get('user/profile/update/', [UserLogicController::class, 'UserProfileUpdate'])->name('user.profile.update');
//user.pass.change
Route::get('user/pass/change/', [UserLogicController::class, 'UserPassChange'])->name('user.pass.change');

Route::prefix('admin')->name('admin.')->group(function(){
       
    Route::middleware(['guest:admin','PreventBackHistory'])->group(function(){
          Route::view('/login','dashboard.admin.login')->name('login');
          Route::post('/check',[AdminController::class,'check'])->name('check');
    });

    Route::middleware(['auth:admin','PreventBackHistory'])->group(function(){
        Route::view('/home','dashboard.admin.deshbord')->name('home');
        Route::post('/logout',[AdminController::class,'logout'])->name('logout');
    });

});


// sliddder route here 
Route::get('/slider', [App\Http\Controllers\Admin\slidderController::class, 'index'])->name('slidder');
Route::post('store/slidder', [App\Http\Controllers\Admin\slidderController::class, 'storeslidder'])->name('store.slidder');
Route::get('all/slidder/', [App\Http\Controllers\Admin\slidderController::class, 'allslidder'])->name('all.slidder');
Route::get('edit/slidder/{id}', [App\Http\Controllers\Admin\slidderController::class, 'editslidder']);
Route::post('update/slidder/{id}', [App\Http\Controllers\Admin\slidderController::class, 'updateslidder']);
Route::get('delete/slidder/{id}', [App\Http\Controllers\Admin\slidderController::class, 'deleteslidder']); 

// category route here 
Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category');
Route::post('store/category', [App\Http\Controllers\Admin\CategoryController::class, 'storecategory'])->name('store.category');
Route::get('all/category/', [App\Http\Controllers\Admin\CategoryController::class, 'allcategory'])->name('all.category');
Route::get('edit/category/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'editcategory']);
Route::post('update/category/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'updatecategory']);
Route::get('delete/category/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'deletecategory']); 


// User Delete route here 
Route::get('/doctor/create', [App\Http\Controllers\Admin\PatentController::class, 'AddDoctor'])->name('create.doctor');
Route::get('/doctor/list', [App\Http\Controllers\Admin\PatentController::class, 'AllDoctor'])->name('all.doctor');
Route::get('delete/doctor/{id}', [App\Http\Controllers\Admin\PatentController::class, 'deletedoctor']);
// Doctor Delete route here 
Route::get('/patent', [App\Http\Controllers\Admin\PatentController::class, 'AllPatent'])->name('patent');
Route::get('delete/patent/{id}', [App\Http\Controllers\Admin\PatentController::class, 'deletepatent']);



//settings route here
Route::get('settings/', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
Route::get('all/settings/', [App\Http\Controllers\SettingsController::class, 'allsettings'])->name('all.settings');
Route::post('store/settings', [App\Http\Controllers\SettingsController::class, 'storesettings'])->name('store.settings');
Route::get('edit/settings/{id}', [App\Http\Controllers\SettingsController::class, 'editsettings']);
Route::post('update/settings/{id}', [App\Http\Controllers\SettingsController::class, 'updatesettings']);
Route::get('delete/settings/{id}', [App\Http\Controllers\SettingsController::class, 'deletesettings']);



// team route here
Route::get('team/', [App\Http\Controllers\TeamController::class, 'index'])->name('team');
Route::get('all/team/', [App\Http\Controllers\TeamController::class, 'allteam'])->name('all.team');
Route::post('store/team', [App\Http\Controllers\TeamController::class, 'storeteam'])->name('store.team');
Route::get('edit/team/{id}', [App\Http\Controllers\TeamController::class, 'editteam']);
Route::post('update/team/{id}', [App\Http\Controllers\TeamController::class, 'updateteam']);
Route::get('delete/team/{id}', [App\Http\Controllers\TeamController::class, 'deleteteam']);

Route::prefix('barber')->name('barber.')->group(function(){

       Route::middleware(['guest:doctor','PreventBackHistory'])->group(function(){
            Route::view('/login','dashboard.barber.login')->name('login');
            Route::view('/register','dashboard.barber.register')->name('register');
            Route::post('/create',[BarberController::class,'create'])->name('create');
            Route::post('/check',[BarberController::class,'check'])->name('check');
       });

       Route::middleware(['auth:doctor','PreventBackHistory'])->group(function(){
           
            Route::post('logout',[BarberController::class,'logout'])->name('logout');
            Route::get('/home',[BarberController::class,'home'])->name('home');
       });

});
//user-profile-update-account
Route::post('barber-profile-update-account/', [App\Http\Controllers\Barber\UpdateBarberController::class, 'userProfileUpdateAccount'])->name('user-profile-update-account');
//user-passchange
Route::post('password/change/', [App\Http\Controllers\Barber\UpdateBarberController::class, 'PassChange'])->name('user-passchange');
//
Route::get('barber-profile/', [App\Http\Controllers\Barber\UpdateBarberController::class, 'doctorprofile'])->name('barber.profile');
Route::post('barber-profile-update/', [App\Http\Controllers\Barber\UpdateBarberController::class, 'updatedoctor'])->name('barber-profile-update');
//profile-stores
Route::post('barber-store/', [App\Http\Controllers\Barber\UpdateBarberController::class, 'storesDoctor'])->name('barber-profile-stores');
Route::get('all-barber.appoinmemt/', [App\Http\Controllers\Barber\UpdateBarberController::class, 'allDoctorAppoinment'])->name('all.barber.appoinmemt');
Route::get('confirm/appoinment/{id}', [App\Http\Controllers\Barber\UpdateBarberController::class, 'ConfirmAppoinment']);
Route::get('cencel/appoinment/{id}', [App\Http\Controllers\Barber\UpdateBarberController::class, 'CancelAppoinment']);
Route::get('delete/appoinment/{id}', [App\Http\Controllers\Barber\UpdateBarberController::class, 'DeleteAppoinment']);

//done/appoinment/
Route::get('done/appoinment/{id}', [App\Http\Controllers\Barber\UpdateBarberController::class, 'DoneAppoinment']);

//category/doctor/list route here 
Route::get('category/barber/list/{id}', [App\Http\Controllers\Barber\UpdateBarberController::class, 'category_doctor_list']);

