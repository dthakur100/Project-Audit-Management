<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\AuditReportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuditCheckpointController;
use App\Http\Controllers\AuditCategoryController;
Route::get('/', function () {
    return view('welcome');
});

//UnAuthenticated Routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'loginVerify']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

// Authenticated Routes
Route::middleware('auth')->group(function(){
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::patch('/projects/{project}/status',[ProjectController::class, 'updateStatus'])->name('projects.updateStatus');

    Route::get('/audits/start', [AuditController::class, 'start'])->name('audits.start');
    Route::post('/audits/start', [AuditController::class, 'begin'])->name('audits.begin');
    Route::get('/audits/{audit}/category/{category}', 
        [AuditController::class, 'checkpoints']
    )->name('audits.checkpoints');
    Route::post('/audits/{audit}/save', 
        [AuditController::class, 'saveResults']
    )->name('audits.save');
    Route::get('/audits/{audit}/report/json', [AuditReportController::class, 'json'])
        ->name('audits.report.json');
    Route::get('/audits/{audit}/report', [AuditReportController::class, 'html'])
        ->name('audits.report.html');

    //resource controller routes
    Route::resource('categories',AuditCategoryController::class);
    Route::resource('checkpoints',AuditCheckpointController::class);
    // Combined view (filter + datatable)
    Route::get('/category-checkpoints', 
        [AuditCheckpointController::class, 'indexByCategory']
    )->name('category.checkpoints');

    //restore deleted category and checkpoints
    Route::patch('/checkpoints/{checkpoint}/restore',[AuditCheckpointController::class, 'restore'])->name('checkpoints.restore');
    Route::patch('/categories/{category}/restore',[AuditCategoryController::class, 'restore'])->name('categories.restore');
    
    //Audit Export route
    Route::get('/projects/{project}/export', [AuditReportController::class, 'export'])->name('projects.export');


    //logout route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});



