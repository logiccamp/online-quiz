<?php

use Illuminate\Support\Facades\Route;

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
    return view('main.home');
});

Auth::routes();

Route::get('/welcome', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/loginPostPage', [App\Http\Controllers\HomeController::class, 'login'])->name('loginPage');
Route::get('/start-quiz', [App\Http\Controllers\HomeController::class, 'startquiz'])->name('startquiz');


Route::get('/mock/{title}', [App\Http\Controllers\ExamController::class, 'index'])->name('mock');
Route::get('/submit/{id}', [App\Http\Controllers\ExamController::class, 'store'])->name('submitMock');
Route::get('/details/{id}', [App\Http\Controllers\ExamController::class, 'show'])->name('detailsMock');
Route::get('/results', [App\Http\Controllers\ExamController::class, 'results'])->name('results');
Route::get('/destroyExam/{id}', [App\Http\Controllers\ExamController::class, 'destroy'])->name('destroyExam');

Route::get('/get-questions-fresh/{id}/{title}', [App\Http\Controllers\ExamController::class, 'getQuestions'])->name('getQuestions');
Route::get('/get-questions/{id}/{examid}', [App\Http\Controllers\ExamController::class, 'getExam'])->name('getExam');
Route::get('/answer/{question}/{option}/{examid}', [App\Http\Controllers\ExamController::class, 'answer'])->name('answer');
Route::get('/update-time/{current}/{examid}', [App\Http\Controllers\ExamController::class, 'updateTime'])->name('updateTime');
Route::post('/get-details/', [App\Http\Controllers\ExamController::class, 'getdetails'])->name('updateTime');


// admin
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('adminhome');
Route::get('/admin/questions', [App\Http\Controllers\QuestionsController::class, 'index'])->name('questions');
Route::get('/admin/questions/view/{id}', [App\Http\Controllers\QuestionsController::class, 'viewquestions'])->name('viewquestion');
Route::get('/admin/questions/edit/{id}', [App\Http\Controllers\QuestionsController::class, 'edit'])->name('viewquestion');
Route::get('/admin/questions/add/{id}', [App\Http\Controllers\QuestionsController::class, 'create'])->name('addquestions');
Route::post('/admin/questions/add', [App\Http\Controllers\QuestionsController::class, 'store'])->name('addQuestion');
Route::post('/admin/questions/update/{id}', [App\Http\Controllers\QuestionsController::class, 'update'])->name('addQuestion');
Route::get('/admin/subjects', [App\Http\Controllers\QuestionsController::class, 'subjects'])->name('subjects');
Route::get('/admin/subject/add', [App\Http\Controllers\SubjectsController::class, 'create'])->name('addsubjectget');
Route::post('/admin/subjects/add/', [App\Http\Controllers\SubjectsController::class, 'store'])->name('addSubject');
Route::post('/admin/subjects/update/{id}', [App\Http\Controllers\AdminController::class, 'update'])->name('updateQuestion');
Route::get('/admin/students/', [App\Http\Controllers\AdminController::class, 'students'])->name('students');
Route::get('/admin/students/add', [App\Http\Controllers\AdminController::class, 'Addstudent'])->name('addstudent');
Route::post('/admin/students/add', [App\Http\Controllers\AdminController::class, 'AddstudentStore'])->name('AddstudentStore');


// categories 
Route::get('/get-categories', [App\Http\Controllers\CategoriesController::class, 'get'])->name('getcategory');
Route::get('/get-categories-bytitle/{id}', [App\Http\Controllers\CategoriesController::class, 'getbytitle'])->name('getcategorybytitle');

// vue
Route::get('/get-question-group/{subject}', [App\Http\Controllers\QuestionGroupsController::class, 'get'])->name('getQustionGroup');
Route::get('/get-question-byid/{id}', [App\Http\Controllers\QuestionsController::class, 'getQuestionById'])->name('getQuestionById');

Route::post('/add-question-group', [App\Http\Controllers\QuestionGroupsController::class, 'store'])->name('addQuestionGroup');

