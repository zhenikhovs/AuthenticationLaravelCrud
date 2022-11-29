<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use \App\Http\Controllers\RubricController;
use \App\Http\Controllers\ArticleController;
use \App\Http\Middleware;


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


Route::get('/', [ViewController::class, 'GetIndexPage']);

Route::get('/article/add/{rubric_id}', [ViewController::class, 'AddArticleForm'])->name('addArticleForm')->middleware(['role:admin']);
Route::post('/article/add', [ArticleController::class, 'AddArticle'])->name('addArticle')->middleware(['role:admin']);

Route::get('/article/update/{article_id}', [ViewController::class, 'UpdateArticleForm'])->name('updateArticleForm')->middleware(['role:admin']);
Route::put('/article/{article_id}', [ArticleController::class, 'UpdateArticle'])->name('updateArticle')->middleware(['role:admin']);

Route::delete('/article/{article_id}', [ArticleController::class, 'DeleteArticle'])->name('deleteArticle')->middleware(['role:admin']);



Route::get('/article/{article_id}', [ViewController::class, 'GetArticlePage'])->name('articlePage');


Route::get('/rubric/{rubric_id}', [ViewController::class, 'GetRubricPage'])->name('rubricPage');


Route::get('/article', function () {
    return view('article');
});


//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
