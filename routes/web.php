<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminVoucherController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackgroundImageController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SubAgentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UpazilaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\VoucherTypeController;
use App\Http\Controllers\WithdrawController;
use App\Models\BackgroundImage;
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

Route::match(['get', 'post'], '/register', [AuthController::class, 'register'])->name('register');




//Frontend Dependency selector
Route::get('api/fetch-users', [ApiController::class, 'users']);
Route::get('api/fetch-districts/{id}', [ApiController::class, 'districts']);
Route::get('api/fetch-upazilas/{id}', [ApiController::class, 'upazilas']);
Route::get('api/fetch-institutes/{id}', [ApiController::class, 'institutes']);
Route::get('api/component-budget/{id}', [ApiController::class, 'getComponentBudget']);
Route::get('api/component-institute-budget/{year_id}/{institute_id}', [ApiController::class, 'getComponentBudgetFromYearAndInstitute']);
Route::get('api/sub-component/{component_id}', [ApiController::class, 'getSubComponent']);


Route::get('/', [SiteController::class, 'home'])->name('home');



Route::get('/demo', function () {
  return view('site.demo');
})->name('demo');


Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('login');


Route::get('/reset-password/{token}', function ($token) {
  $data['images'] = BackgroundImage::where('status', BackgroundImage::$statusArray[0])->get();
  $data['token'] = $token;
  return view('admin.auth.reset-password', $data);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password/store/{token}', [AuthController::class, 'resetPassword'])
  ->middleware(['guest:' . config('fortify.guard')])
  ->name('password.reset.store');

//Route::get('/email/verify', function () {
//  $data['images'] = BackgroundImage::where('status', BackgroundImage::$statusArray[0])->get();
//  return view('admin.auth.verify-email', $data);
//})->middleware('auth')->name('verification.notice');
Route::get('/forgot-password', function () {
  $data['images'] = BackgroundImage::where('status', BackgroundImage::$statusArray[0])->get();
  return view('admin.auth.forget-password', $data);
})->middleware('guest')->name('password.request');

//Route::post('/email/verification-notification', function (Request $request) {
//  $request->user()->sendEmailVerificationNotification();
//  \Illuminate\Support\Facades\Session::put('email', $request->user()->email);
//  return redirect()->back();
//})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::post('/post/apply', [SiteController::class, 'postApply'])->name('ajax.post.apply');
Route::get('/admin/logout', [AdminController::class, 'logout'])->middleware('auth')->name('admin.logout');
Route::prefix('/admin')->name('admin.')->middleware(['auth'])->group(function () {
  Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
  Route::get('/profile', [AdminController::class, 'profile'])->name('profile.show');
  Route::post('/profile/update', [AdminController::class, 'profileUpdate'])->name('profile.update');
  Route::post('/password/update', [AdminController::class, 'passwordUpdate'])->name('password.update');
  Route::match(['get', 'post'], '/institute-profile', [AdminController::class, 'instituteProfile'])->name('instituteProfile');

  Route::prefix('ajax')->name('ajax.')->group(function () {
    //    Route::match(['get', 'post'], '/post/apply', [SiteController::class, 'postApply'])->name('post.apply');
    Route::get('/institute/from/type-and-division', [SearchController::class, 'searchInstituteFromTypeAndDivision'])->name('institute.from.type.and.division');
    Route::get('/user/from/institute', [SearchController::class, 'searchUserFromInstitute'])->name('user.from.institute');
    Route::prefix('search')->name('search.')->group(function () {
      Route::get('/participate/type', [SearchController::class, 'searchParticipateType'])->name('participate.type');
      Route::get('/building/name', [SearchController::class, 'searchBuildingName'])->name('building.name');
      Route::get('/block/name', [SearchController::class, 'searchBlockName'])->name('block.name');
      Route::get('/floor/name', [SearchController::class, 'searchFloorName'])->name('floor.name');
      Route::get('/room/name', [SearchController::class, 'searchRoomName'])->name('room.name');
      Route::get('/room/no', [SearchController::class, 'searchRoomNo'])->name('room.no');
      Route::get('/item/name', [SearchController::class, 'searchItemName'])->name('item.name');
      Route::get('/idea/student/name', [SearchController::class, 'searchUserName'])->name('idea.student.name');
    });
    //    Route::get('/get-student-prefix', [ProjectIdeaController::class, 'ajaxprojectIdeaStudent'])->name('get.student.prefix');
    Route::post('/make/{id}/-as-read', [NotificationController::class, 'ajaxUpdateAsRead'])->name('make.modal.as.read');
    Route::post('/permission-by-role', [PermissionController::class, 'getPermissionByRole'])->middleware('role_or_permission:Super Admin|Manage Permission')->name('get.permission.by.role');
    Route::post('/update/user/status', [UserController::class, 'ajaxUpdateStatus'])->middleware('role_or_permission:Super Admin|Manage User|Manage Institute User')->name('update.user.status');
    Route::post('/update/subagent/status', [SubAgentController::class, 'ajaxUpdateStatus'])->middleware('role_or_permission:Super Admin|Agent|Manage Sub Agent')->name('update.subagent.status');
    Route::post('/update/backgrouond/status', [BackgroundImageController::class, 'ajaxUpdateStatus'])->name('update.backgroundImage.status');
    Route::post('/update/payment/status', [PaymentController::class, 'ajaxUpdateStatus'])->name('update.payment.status');

    Route::post('/update/cashmanage/status', [WithdrawController::class, 'ajaxUpdateStatus'])->name('update.cashmanage.status');
    Route::post('/update/deposit/status', [DepositController::class, 'ajaxUpdateStatus'])->name('update.deposit.status');
    Route::post('/update/subagent/status', [SubAgentController::class, 'ajaxUpdateStatus'])->name('update.subagent.status');
  });


  #Division
  Route::prefix('division')->name('division.')->group(function () {
    Route::get('/create', [DivisionController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Division')->name('create');
    Route::post('/store', [DivisionController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Division|Manage Division')->name('store');
    Route::get('/manage/{id}', [DivisionController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Division')->name('manage');
    Route::get('/{id}/view', [DivisionController::class, 'view'])->middleware('role_or_permission:Super Admin|View Division')->name('view');
    Route::delete('/destroy', [DivisionController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Division')->name('destroy');
    Route::get('/list', [DivisionController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Division')->name('list');
  });




  #Sub Agent
  Route::prefix('subagent')->name('subagent.')->group(function () {
    Route::get('/create', [SubAgentController::class, 'create'])->middleware('role_or_permission:Super Admin|Agent|Create Sub Agent')->name('create');
    Route::post('/store', [SubAgentController::class, 'store'])->middleware('role_or_permission:Super Admin|Agent|Create Sub Agent|Manage Sub Agent')->name('store');
    Route::get('/manage/{id}', [SubAgentController::class, 'manage'])->middleware('role_or_permission:Super Admin|Agent|Manage Sub Agent')->name('manage');
    Route::get('/{id}/view', [SubAgentController::class, 'view'])->middleware('role_or_permission:Super Admin|Agent|View Sub Agent')->name('view');
    Route::delete('/destroy', [SubAgentController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Agent|Delete Sub Agent')->name('destroy');
    Route::get('/list', [SubAgentController::class, 'index'])->middleware('role_or_permission:Super Admin|Agent|List Sub Agent')->name('list');
  });




  #District
  Route::prefix('district')->name('district.')->group(function () {
    Route::get('/create', [DistrictController::class, 'create'])->middleware('role_or_permission:Super Admin|Sub Agent|Create District')->name('create');
    Route::post('/store', [DistrictController::class, 'store'])->middleware('role_or_permission:Super Admin|Sub Agent|Create District|Manage District')->name('store');
    Route::get('/manage/{id}', [DistrictController::class, 'manage'])->middleware('role_or_permission:Super Admin|Sub Agent|Manage District')->name('manage');
    Route::get('/{id}/view', [DistrictController::class, 'view'])->middleware('role_or_permission:Super Admin|Sub Agent|View District')->name('view');
    Route::delete('/destroy', [DistrictController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Sub Agent|Delete District')->name('destroy');
    Route::get('/list', [DistrictController::class, 'index'])->middleware('role_or_permission:Super Admin|Sub Agent|List Of District')->name('list');
  });


  #Division
  Route::prefix('upazila')->name('upazila.')->group(function () {
    Route::get('/create', [UpazilaController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Upazila')->name('create');
    Route::post('/store', [UpazilaController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Upazila|Manage Upazila')->name('store');
    Route::get('/manage/{id}', [UpazilaController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Upazila')->name('manage');
    Route::get('/{id}/view', [UpazilaController::class, 'view'])->middleware('role_or_permission:Super Admin|View Upazila')->name('view');
    Route::delete('/destroy', [UpazilaController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Upazila')->name('destroy');
    Route::get('/list', [UpazilaController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Upazila')->name('list');
  });


  #Users
  Route::prefix('user')->name('user.')->group(function () {
    Route::get('/create', [UserController::class, 'create'])->middleware('role_or_permission:Super Admin|Agent|Create Agent')->name('create');
    Route::post('/store', [UserController::class, 'store'])->middleware('role_or_permission:Super Admin|Agent|Create Agent|Manage Agent')->name('store');
    Route::get('/manage/{id}', [UserController::class, 'manage'])->middleware('role_or_permission:Super Admin|Agent|Manage Agent')->name('manage');
    Route::get('/{id}/view', [UserController::class, 'view'])->middleware('role_or_permission:Super Admin|Agent|View Agent')->name('view');
    Route::delete('/destroy', [UserController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Agent|Delete Agent')->name('destroy');
    Route::get('/list', [UserController::class, 'index'])->middleware('role_or_permission:Super Admin|Agent|List Of Agent')->name('list');
  });



  #Roles
  Route::prefix('role')->name('role.')->group(function () {
    Route::get('/create', [RoleController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Role')->name('create');
    Route::post('/store', [RoleController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Role|Manage Role')->name('store');
    Route::get('/manage/{id}', [RoleController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Role')->name('manage');
    Route::get('/{id}/view', [RoleController::class, 'view'])->middleware('role_or_permission:Super Admin|View Role')->name('view');
    Route::delete('/destroy', [RoleController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Role')->name('destroy');
    Route::get('/list', [RoleController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Role')->name('list');
  });

    #Withdraw
    Route::prefix('withdraw')->name('withdraw.')->group(function () {
        Route::get('/create', [WithdrawController::class, 'create'])->middleware('role_or_permission:Agent|Sub Agent|Create Withdraw')->name('create');
        Route::post('/store', [WithdrawController::class, 'store'])->middleware('role_or_permission:Agent|Sub Agent|Create Withdraw|Manage Withdraw')->name('store');
//        Route::get('/manage/{id}', [WithdrawController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Withdraw')->name('manage');
//        Route::get('/{id}/view', [WithdrawController::class, 'view'])->middleware('role_or_permission:Super Admin|View Withdraw')->name('view');
//        Route::delete('/destroy', [WithdrawController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Withdraw')->name('destroy');
        Route::get('/list', [WithdrawController::class, 'list'])->middleware('role_or_permission:Super Admin|List of Withdraw')->name('list');
    });

  #Permission
  Route::match(['get', 'post'], '/permission/manage', [PermissionController::class, 'managePermission'])->middleware('role_or_permission:Super Admin|Manage Permission')->name('permission.manage');

  // payment
  Route::prefix('/payment')->name('payment.')->group(function () {
    Route::get('/create', [PaymentController::class, 'create'])->middleware('role_or_permission:Super Admin|Agent|Sub Agent|Create payment')->name('create');
    Route::post('/store', [PaymentController::class, 'store'])->middleware('role_or_permission:Super Admin|Agent|Sub Agent|Create payment|Manage payment')->name('store');
    Route::delete('/destroy', [PaymentController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Agent|Sub Agent|Delete payment')->name('destroy');
  });


  //  Route::get('trainee/certificate/create', [CertificateController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Certificate')->name('trainee.certificate.create');

  #Voucher Type
  Route::prefix('voucher-type')->name('voucher.type.')->group(function () {
    Route::get('/create', [VoucherTypeController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Voucher Type')->name('create');
    Route::post('/store', [VoucherTypeController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Voucher Type|Manage Voucher Type')->name('store');
    Route::get('/manage/{id}', [VoucherTypeController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Voucher Type')->name('manage');
    Route::get('/{id}/view', [VoucherTypeController::class, 'view'])->middleware('role_or_permission:Super Admin|View Voucher Type')->name('view');
    Route::delete('/destroy', [VoucherTypeController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Voucher Type')->name('destroy');
    Route::get('/list', [VoucherTypeController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Voucher Type')->name('list');
  });

  #Voucher
  Route::prefix('voucher')->name('voucher.')->group(function () {
    Route::match(['get', 'post'], '/create', [VoucherController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Voucher')->name('create');
    Route::post('/store', [VoucherController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Voucher|Manage Voucher')->name('store');
    Route::match(['get', 'post'], '/manage/{id}', [VoucherController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Voucher')->name('manage');
    Route::get('/{id}/view', [VoucherController::class, 'view'])->middleware('role_or_permission:Super Admin|View Voucher')->name('view');
    Route::delete('/destroy', [VoucherController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Voucher')->name('destroy');
    Route::get('/list', [VoucherController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Voucher')->name('list');
  });

  Route::prefix('all-voucher')->name('all.voucher.')->group(function () {
    Route::get('/list', [AdminVoucherController::class, 'index'])->middleware('role_or_permission:Super Admin')->name('list');
    Route::get('/{id}/view', [AdminVoucherController::class, 'view'])->middleware('role_or_permission:Super Admin')->name('view');
  });



  #Background Image
  Route::match(['get', 'post'], '/background-image', [BackgroundImageController::class, 'createOrIndex'])->name('backgroundImage');
  Route::delete('/background-image/destroy', [BackgroundImageController::class, 'destroy'])->name('backgroundImage.destroy');


  #Cash
  Route::match(['get', 'post'], '/deposit', [DepositController::class, 'createOrIndex'])->name('deposit');
  Route::get('/deposit/list', [DepositController::class, 'depositList'])->name('deposit.list');

//   Route::get('/withdraw', function (){
//        return view('admin.cash.withdraw');
//    })->name('withdraw');

//    Route::get('/withdraw', [SiteController::class, 'withdraw'])->middleware('role_or_permission:Super Admin|Agent|Sub Agent|Create withdraw')->name('withdraw');

  // Route::get('/deposit', function () {
  //   return view('admin.cash.deposit');
  // })->name('deposit');

  Route::get('/withdraw', function () {
    return view('admin.cash.withdraw');
  })->name('withdraw');

//  Route::get('/transaction', function () {
//    return view('admin.cash.transaction');
//  })->name('transaction');

  Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction');

  #deposit
  // Route::match(['get', 'post'], '/deposit', [BackgroundImageController::class, 'createOrIndex'])->name('deposit');
  // Route::delete('/background-image/destroy', [BackgroundImageController::class, 'destroy'])->name('deposit.destroy');
});
