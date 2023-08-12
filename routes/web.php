<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;


Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    } else {
        return view('login');
    }
})->name('login');

Route::middleware('web')->group(function () {
    Route::get('/login', function () {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        } else {
            return view('login');
        }
    })->name('login');

    Route::get('/register', function () {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        } else {
            return view('register');
        }
    })->name('register');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('api-docs');
        })->name('dashboard');
    });
});

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/product',[ProductController::class,'product'])->name('product');
Route::get('/cart',[CartController::class,'cart'])->name('cart');
Route::post('/cart/add/{product_id}',[CartController::class,'addToCart'])->name('cart.add');



//Admin
Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

Route::delete('/cart/id}',[CartController::class,'addToCart'])->name('cart.delete');


Route::get('/brand-admin',[BrandController::class,'view'])->name('brand.view');
Route::post('/brand/save',[BrandController::class,'save'])->name('brand.save');
Route::delete('/brand/{id}',[BrandController::class,'delete'])->name('brand.delete');

Route::get('/category-admin',[CategoryController::class,'view'])->name('category.view');
Route::post('/category/save',[CategoryController::class,'save'])->name('category.save');
Route::delete('/category/{id}',[CategoryController::class,'delete'])->name('category.delete');

Route::get('/product-admin',[ProductController::class,'view'])->name('product.view');
Route::post('/product/save',[ProductController::class,'save'])->name('product.save');
Route::delete('/product/{id}',[ProductController::class,'delete'])->name('product.delete');

Route::get('/manage', [ManageController::class, 'index'])->name('manage');
Route::post('/manage/search', [ManageController::class, 'search'])->name('user.search');
Route::get('/delete/user/{id}', [ManageController::class, 'delete'])->name('user.delete');
Route::post('/manage/update/{id}', [ManageController::class, 'update'])->name('user.update');