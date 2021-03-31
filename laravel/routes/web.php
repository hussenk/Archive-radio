<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategorySubController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PreparationController;
use App\Http\Controllers\PresenterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Routes Category  category  CategoryController
Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/{category_id}/', [CategoryController::class, 'showcategorysub'])->name('category.showcategorysub');
Route::get('/category/_id', [CategoryController::class, '_id'])->name('category._id');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::get('/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::get('/category/restore/{id}', [CategoryController::class, 'restore'])->name('category.restore');

//Routes CategorySub categorysub CategorySubController
Route::get('/categorysub', [CategorySubController::class, 'index'])->name('categorysub');
Route::get('/categorysub/trashed/', [CategorySubController::class, 'categorysubTrashed'])->name('categorysub.trashed');
Route::get('/categorysub/create', [CategorySubController::class, 'create'])->name('categorysub.create');
Route::post('/categorysub/store', [CategorySubController::class, 'store'])->name('categorysub.store');
Route::get('/categorysub/show/{id}', [CategorySubController::class, 'show'])->name('categorysub.show');
Route::get('/categorysub/edit/{id}', [CategorySubController::class, 'edit'])->name('categorysub.edit');
Route::post('/categorysub/update/{id}', [CategorySubController::class, 'update'])->name('categorysub.update');
Route::get('/categorysub/destroy/{id}', [CategorySubController::class, 'destroy'])->name('categorysub.destroy');
Route::get('/categorysub/restore/{id}', [CategorySubController::class, 'restore'])->name('categorysub.restore');

//Routes File file FileController
Route::get('/file', [FileController::class, 'index'])->name('file');
Route::get('/file/create', [FileController::class, 'create'])->name('file.create');
Route::post('/file/store', [FileController::class, 'store'])->name('file.store');
Route::get('/file/{category_id}/', [FileController::class, 'showcategory'])->name('file.showcategory');
Route::get('/file/edit/{category_id}/{id}', [FileController::class, 'edit'])->name('file.edit');
Route::post('/file/update/{id}', [FileController::class, 'update'])->name('file.update');
Route::get('/file/destroy/{id}', [FileController::class, 'destroy'])->name('file.destroy');
Route::get('/file/download/{id}', [FileController::class, 'download'])->name('file.download');


//Routes Log log LogController

//Routes Preparation preparation PreparationController
Route::get('/preparation', [PreparationController::class, 'index'])->name('preparation');
Route::get('/preparation/trashed/', [PreparationController::class, 'preparationTrashed'])->name('preparation.trashed');
Route::get('/preparation/create', [PreparationController::class, 'create'])->name('preparation.create');
Route::post('/preparation/store', [PreparationController::class, 'store'])->name('preparation.store');
Route::get('/preparation/edit/{id}', [PreparationController::class, 'edit'])->name('preparation.edit');
Route::post('/preparation/update/{id}', [PreparationController::class, 'update'])->name('preparation.update');
Route::get('/preparation/destroy/{id}', [PreparationController::class, 'destroy'])->name('preparation.destroy');
Route::get('/preparation/restore/{id}', [PreparationController::class, 'restore'])->name('preparation.restore');

//Routes Presenter presenter PresenterController
Route::get('/presenter', [PresenterController::class, 'index'])->name('presenter');
Route::get('/presenter/trashed/', [PresenterController::class, 'presenterTrashed'])->name('presenter.trashed');
Route::get('/presenter/create', [PresenterController::class, 'create'])->name('presenter.create');
Route::post('/presenter/store', [PresenterController::class, 'store'])->name('presenter.store');
Route::get('/presenter/edit/{id}', [PresenterController::class, 'edit'])->name('presenter.edit');
Route::post('/presenter/update/{id}', [PresenterController::class, 'update'])->name('presenter.update');
Route::get('/presenter/destroy/{id}', [PresenterController::class, 'destroy'])->name('presenter.destroy');
Route::get('/presenter/restore/{id}', [PresenterController::class, 'restore'])->name('presenter.restore');

//Routes Role role RoleController
Route::get('/role', [RoleController::class, 'index'])->name('role');
Route::get('/role/show/u{id}', [RoleController::class, 'show'])->name('role.show');
Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
Route::post('/role/update/{id}', [RoleController::class, 'update'])->name('role.update');
Route::post('/role/update/user/{id}', [RoleController::class, 'userRole'])->name('role.userRole');


//Routes Tag tag TagController
Route::get('/tag', [TagController::class, 'index'])->name('tag');
Route::get('/tag/trashed/', [TagController::class, 'tagTrashed'])->name('tag.trashed');
Route::get('/tag/create', [TagController::class, 'create'])->name('tag.create');
Route::post('/tag/store', [TagController::class, 'store'])->name('tag.store');
Route::get('/tag/edit/{id}', [TagController::class, 'edit'])->name('tag.edit');
Route::post('/tag/update/{id}', [TagController::class, 'update'])->name('tag.update');
Route::get('/tag/destroy/{id}', [TagController::class, 'destroy'])->name('tag.destroy');
Route::get('/tag/restore/{id}', [TagController::class, 'restore'])->name('tag.restore');

//Route Search search SearchController

Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::post('/search/search', [SearchController::class, 'search'])->name('search.search');




// Route::get('/newlogin', [Auth::class, 'index'])->name('search');

// Auth::routes();
