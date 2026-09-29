<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ContainerTelemetryController;
use App\Http\Controllers\ContainersController;
use App\Http\Controllers\employeeDash;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MaterialsController;
use App\Http\Controllers\StudentDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth','role:admin'])->group(function(){  //Admin Onlhy
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/students/index',[AdminDashboardController::class,'student'])->name('students_index');
    
    Route::controller(CatalogController::class)->group(function(){   //admin
    Route::get('/catalog_index','index')->name('catalog.index');
    Route::post('/catalog_store','store')->name('catalog.store');
    Route::delete('/catalog_destroy/{catalog}','destroy')->name('catalog.destroy');
    Route::put('/catalog_update/{catalog}','update')->name('catalog.update');
    });
    
    Route::controller(ContainersController::class)->group(function(){  
        Route::get('/containers/create','create')->name('containers.create');
        Route::get('/containers/index','index')->name('containers.index');
        Route::get('/containers/edit/{containers}','edit')->name('containers.edit');
        Route::post('/containers/store','store')->name('containers.store');
        Route::put('/containers/update/{containers}','update')->name('containers.update');
        Route::delete('/containers/destroy/{containers}','destroy')->name('containers.destroy');
        });
        Route::controller(LoginController::class)->group(function(){            // start admin
        Route::get('/employee/index','employee')->name('employee_index');
        Route::get('/employee/create','create')->name('employee_create');
        Route::post('/employee/store','store')->name('employee_store');
        Route::post('/employee/show/{login}','show')->name('employee_show');
        Route::delete('/employee/destroy/{login}','destroy')->name('employee_destroy');
        });

    Route::controller(MaterialsController::class)->group(function(){ //admin
        Route::get('/materials/index','index')->name('materials.index');
        Route::post('/materials/update/{material}','update')->name('materials_update');
        });
});

//***************************************************************************************************** Admin&Eymp
Route::middleware(['auth','role:admin,employee'])->group(function(){  
    Route::get('/containers/index',[ContainersController::class,'index'])->name('containers.index'); //admin& eymp
});
//***************************************************************************************************** Eymp
Route::middleware(['auth','role:employee'])->group(function(){  
    // Route::get('employee',[employeeDash::class,'index'])->name('employee'); // eymp
    Route::get('/employee/operations', [employeeDash::class, 'index'])->name('employee.operations');
    Route::put('/containers/{id}/empty', [employeeDash::class, 'markEmptied'])->name('containers.empty');
});
//*****************************************************************************************************ALL
Route::middleware(['auth','role:student'])->group(function(){  
    Route::get('index/student/{id}',[StudentDashboardController::class,'index'])->name('student.dashboard');
});
//*****************************************************************************************************ALL
Route::controller(ForgetPasswordController::class)->group(function(){       //All
    Route::get('/forget_page','forget_page')->name('forget_page');
    Route::get('/show_reset_pass','show_reset_pass')->name('show_reset_pass');
    Route::get('/show_verify_otp_page','show_verify_otp_page')->name('show_verify_otp_page');
    Route::post('/send_otp','send_otp')->name('send_otp');
    Route::post('/verify_otp','verify_otp')->name('verify_otp');
    Route::post('/show_verify_otp_page','show_verify_otp_page')->name('show_verify_otp_page');
    Route::post('/reset_pass','reset_pass')->name('reset_pass');
});
    // --------------------------------------------------------------------------ALL
Route::controller(LoginController::class)->group(function(){            // start admin
    Route::post('/login/register','register')->name('register');
    Route::get('/login/registerform','registerform')->name('register_page');
    Route::get('/login','loginform')->name('login');
    Route::post('/login','login')->name('login.submit');
    Route::post('/login/logout','logout')->name('logout');
});

Route::post('/waste-telemetry', [ContainerTelemetryController::class, 'store']);
