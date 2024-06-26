<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ParameterController;
use App\Models\Student;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('students', StudentController::class); // RUTA Alumnos

    Route::resource('products', ProductController::class); //Resource es propio de laravel , te crea directamente las rutas

    Route::get('addAssist', [StudentController::class, 'addAssist'])->name('students.addAssist'); //ruta que me lleva a la vista

    Route::post('findStudent', [StudentController::class, 'findStudent'])->name('students.findStudent'); // ruta para buscar el alumno
    
    Route::get('addParameters', [ParameterController::class, 'addParameters'])->name('Parameters.addParameters');

    Route::post('editParameters', [ParameterController::class, 'editParameters'])->name('Parameters.editParameters');

    Route::post('storeAssist', [StudentController::class, 'storeAssist'])->name('students.storeAssist'); // ruta para guardar la asistencia
    
    Route::get('showProduct', [ProductController::class, 'showProduct']);

    Route::get('showAssists/{id}', [StudentController::class, 'showAssists'])->name('students.showAssists');

    Route::get('downloadPDF/{id}', [StudentController::class, 'downloadPDF'])->name('students.downloadPDF');

    Route::get('downloadAllPDF', [StudentController::class, 'downloadAllPDF'])->name('students.downloadAllPDF');

    Route::get('downloadEXCEL/{id}', [StudentController::class, 'downloadEXCEL'])->name('students.downloadEXCEL');

    Route::get('admin', [StudentController::class, 'admin'])->middleware('admin')->name('students.admin');


});

require __DIR__.'/auth.php';
