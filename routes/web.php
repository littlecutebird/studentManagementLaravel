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

// Show Register Page & Login Page. If logged in redirect to home else go to login
Route::get('/login', 'LoginController@show')-> name('login') ->middleware('guest');
Route::get('/redirect', 'SocialAuthFacebookController@redirect') -> name('facebookRedirect');
Route::get('/callback', 'SocialAuthFacebookController@callback') -> name('facebookCallback');

// Register & Login User
Route::post('/login', 'LoginController@authenticate');


// Protected Routes - allows only logged in users
Route::middleware('auth')->group(function () {
    Route::get('/', function() {
        return view('index');
    })->name('index');

    Route::get('/logout', 'LoginController@logout') -> name('logout');
    Route::get('/users', 'UserController@listUser') -> name('listUser');
    Route::get('/profile', 'UserController@getProfile') -> name('profile');
    Route::get('/profile/edit', 'UserController@editProfile') -> name('editProfile');
    Route::post('/profile/edit', 'UserController@updateProfile');
    Route::get('/profile/changePassword', 'UserController@changePassword') -> name('changePassword');
    Route::post('/profile/changePassword', 'UserController@updatePassword');
    Route::get('/users/sendMsg/{id}', 'UserController@sendMsg') -> name('sendMsg');
    Route::post('/users/sendMsg/{id}', 'UserController@insertMsg');
    Route::get('/users/deleteMsg/{id}', 'UserController@deleteMsg') -> name('deleteMsg');
    Route::get('/users/editMsg/{id}/{receiveId}', 'UserController@editMsg') -> name('editMsg');
    Route::post('/users/editMsg/{id}/{receiveId}', 'UserController@updateMsg');
    Route::get('/exercises', 'ExerciseController@listExercise') -> name('listExercise');
    Route::get('/challenges', 'ChallengeController@listChallenge') -> name('listChallenge');

    // features for teacher only
    Route::middleware('isTeacher') -> group(function() {
        Route::get('/users/addStudent', function() {
            return view('users.register');
        }) -> name('addStudent');
        Route::post('/users/addStudent', 'UserController@addNewStudent');
        Route::get('/users/editStudent/{id}', 'UserController@editStudentProfile') -> name('editStudentProfile');
        Route::post('/users/editStudent/{id}', 'UserController@updateStudentProfile');
        Route::get('/users/deleteStudent/{id}', 'UserController@deleteStudentProfile') -> name('deleteStudentProfile');
        Route::get('/exercises/add', function() {
            return view('exercises.addExercise');
        }) -> name('addExercise');
        Route::post('/exercises/add', 'ExerciseController@insertExercise');
        Route::get('/exercises/delete/{id}', 'ExerciseController@deleteExercise') -> name('deleteExercise');
        Route::get('/exercises/grade/{exerciseId}', 'ExerciseController@seeSubmissions') -> name('seeSubmissions');
        Route::get('/challenges/delete/{challengeId}', 'ChallengeController@deleteChallenge') -> name('deleteChallenge');
        Route::get('/challenges/add', function() {
            return view('challenges.addChallenge');
        }) -> name('addChallenge');
        Route::post('/challenges/add', 'ChallengeController@insertChallenge');
    });

    // features for student only 
    Route::middleware('isStudent') -> group(function() {
        Route::get('/exercises/submit/{id}', 'ExerciseController@submitExercise') -> name('submitExercise');
        Route::post('/exercises/submit/{id}', 'ExerciseController@insertSubmitexercise');
        Route::get('/challenges/submit/{challengeId}', 'ChallengeController@submitChallenge') -> name('submitChallenge');
        Route::post('/challenges/submit/{challengeId}', 'ChallengeController@submitAnswer');
    });

});
