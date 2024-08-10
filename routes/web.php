<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutPageController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OrganizationDetailsController;
use App\Http\Controllers\OrganizationMembersController;

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


Auth::routes();
Route::get('register', [RegisterController::class, 'showRegistrationForm'])
    ->name('register');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [IndexController::class, 'index'])->name('index');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class)->middleware('role:Admin');
    Route::get('organizations.OrgDetails/{id?}' , [OrganizationController::class , 'details'])->name('details');
    Route::get('organizations.index' , [OrganizationDetailsController::class , 'index'])->name('organizationsview');
    Route::get('profile/index' , [ProfileController::class , 'index'])->name('profile');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('organizations.allOrganizations' , [OrganizationDetailsController::class , 'allOrganization'])->name('allOrganizationsView');
    Route::post('/organization/destroy/{id}', [OrganizationDetailsController::class, 'destroy'])
    ->name('organizationdetail.destroy')->middleware('role:Admin|organization|organization member');
    Route::post('submitDetails/{id?}' , [OrganizationController::class , 'submitDetails'])->name('submitDetails');
    Route::get('allmembers' , [OrganizationMembersController::class , 'members'])->name('allmembers');
    Route::delete('member/destroy/{id}', [OrganizationMembersController::class, 'destroyMember'])->name('member.destroy');
    Route::get('members/{id}' , [OrganizationMembersController::class , 'index'])->name('members');
    Route::get('AlertForm/{id}' , [AlertController::class , 'index'])->name('AlertForm');
    Route::get('alerts' , [AlertController::class , 'alerts'])->name('alerts');
    Route::post('alert/store/{id}' , [AlertController::class , 'store'])->name('alert.store');
    Route::get('showOrganizationMembers/{id}' , [OrganizationMembersController::class , 'showOrgMembers'])->name('showOrgMembers');
    Route::post('members/store/{id}/{user_id}' , [OrganizationMembersController::class , 'store'])->name('members.store');
    Route::post('proceed_alert', [AlertController::class, 'proceed_alert'])->name('proceed_alert');
    Route::get('sended_alerts', [AlertController::class, 'sended_alerts'])->name('sended_alerts');
    Route::get('organizationAlerts/{organization_id}', [AlertController::class, 'organizationAlerts'])->name('organizationAlerts');
    Route::get('edit_profile', [ProfileController::class, 'edit_profile'])->name('edit_profile');
    Route::put('profile.update', [ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::get('about-page/{organization_id}', [AboutPageController::class, 'index'])->name('about-pages.index');
    Route::get('/organizations/{organization_id}/about-page/create', [AboutPageController::class, 'create'])->name('about-pages.create');
    Route::post('/organizations/{organization_id}/about-page', [AboutPageController::class, 'store'])->name('about-pages.store');
    // middleware('role:organization')
    Route::resource('organizations', OrganizationController::class);
    // Route::get('org' , [OrganizationController::class , 'org'] );
});