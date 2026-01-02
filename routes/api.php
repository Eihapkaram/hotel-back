<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MaintenanceRequestController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectFeatureController;
use App\Http\Controllers\ProjectImageController;
use App\Http\Controllers\ProjectInterestController;
use App\Http\Controllers\ProjectLocationController;
use App\Http\Controllers\ProjectWarrantyController;
use Illuminate\Support\Facades\Route;

// -------------------------
// imge show
// -------------------------
// Route to serve project main images
Route::get('/projects/{filename}', function ($filename) {
    $path = storage_path('app/public/projects/'.$filename);

    if (! file_exists($path)) {
        abort(404, 'Image not found.');
    }

    return response()->file($path);
});

// Route to serve project sub-images
Route::get('/project-images/files/{filename}', function ($filename) {
    $path = storage_path('app/public/project_images/'.$filename);

    if (! file_exists($path)) {
        abort(404, 'Image not found.');
    }

    return response()->file($path);
});
// -------------------------
// Public Auth
// -------------------------
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// -------------------------
// Public Routes (عرض فقط)
// -------------------------
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{project}', [ProjectController::class, 'show']);

Route::get('/maintenance-requests', [MaintenanceRequestController::class, 'index']);
Route::get('/maintenance-requests/{maintenanceRequest}', [MaintenanceRequestController::class, 'show']);

Route::get('/project-images', [ProjectImageController::class, 'index']);
Route::get('/project-images/{projectImage}', [ProjectImageController::class, 'show']);

Route::get('/project-features', [ProjectFeatureController::class, 'index']);
Route::get('/project-features/{projectFeature}', [ProjectFeatureController::class, 'show']);

Route::get('/project-warranties', [ProjectWarrantyController::class, 'index']);
Route::get('/project-warranties/{projectWarranty}', [ProjectWarrantyController::class, 'show']);

Route::get('/project-locations', [ProjectLocationController::class, 'index']);
Route::get('/project-locations/{projectLocation}', [ProjectLocationController::class, 'show']);

Route::get('/project-interests', [ProjectInterestController::class, 'index']);
Route::get('/project-interests/{projectInterest}', [ProjectInterestController::class, 'show']);

// -------------------------
// Protected Routes (إنشاء، تعديل، حذف) - Passport
// -------------------------
Route::middleware('auth:api')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Projects
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::put('/projects/{project}', [ProjectController::class, 'update']);
    Route::patch('/projects/{project}', [ProjectController::class, 'update']);
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy']);

    // Maintenance Requests
    Route::post('/maintenance-requests', [MaintenanceRequestController::class, 'store']);
    Route::put('/maintenance-requests/{maintenanceRequest}', [MaintenanceRequestController::class, 'update']);
    Route::patch('/maintenance-requests/{maintenanceRequest}', [MaintenanceRequestController::class, 'update']);
    Route::delete('/maintenance-requests/{maintenanceRequest}', [MaintenanceRequestController::class, 'destroy']);

    // Project Images
    Route::post('/project-images', [ProjectImageController::class, 'store']);
    Route::put('/project-images/{projectImage}', [ProjectImageController::class, 'update']);
    Route::patch('/project-images/{projectImage}', [ProjectImageController::class, 'update']);
    Route::delete('/project-images/{projectImage}', [ProjectImageController::class, 'destroy']);

    // Project Features
    Route::post('/project-features', [ProjectFeatureController::class, 'store']);
    Route::put('/project-features/{projectFeature}', [ProjectFeatureController::class, 'update']);
    Route::patch('/project-features/{projectFeature}', [ProjectFeatureController::class, 'update']);
    Route::delete('/project-features/{projectFeature}', [ProjectFeatureController::class, 'destroy']);

    // Project Warranties
    Route::post('/project-warranties', [ProjectWarrantyController::class, 'store']);
    Route::put('/project-warranties/{projectWarranty}', [ProjectWarrantyController::class, 'update']);
    Route::patch('/project-warranties/{projectWarranty}', [ProjectWarrantyController::class, 'update']);
    Route::delete('/project-warranties/{projectWarranty}', [ProjectWarrantyController::class, 'destroy']);

    // Project Locations
    Route::post('/project-locations', [ProjectLocationController::class, 'store']);
    Route::put('/project-locations/{projectLocation}', [ProjectLocationController::class, 'update']);
    Route::patch('/project-locations/{projectLocation}', [ProjectLocationController::class, 'update']);
    Route::delete('/project-locations/{projectLocation}', [ProjectLocationController::class, 'destroy']);

    // Project Interests
    Route::post('/project-interests', [ProjectInterestController::class, 'store']);
    Route::put('/project-interests/{projectInterest}', [ProjectInterestController::class, 'update']);
    Route::patch('/project-interests/{projectInterest}', [ProjectInterestController::class, 'update']);
    Route::delete('/project-interests/{projectInterest}', [ProjectInterestController::class, 'destroy']);
});
