<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Auth\AuthenticationController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TwilioSMSController;
use App\Http\Controllers\InfobipSMSController;
use App\Http\Controllers\PaystackController;
use App\Http\Controllers\DeploymentController;
use App\Http\Controllers\LogViewerController;





Route::group(['prefix' => 'portal', 'as' => 'portal.'], function () {
    Route::get('/transactions', [PaystackController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{transaction}', [PaystackController::class, 'show'])->name('transactions.show');
});

Route::get('/deploy', [DeploymentController::class, 'index'])->name('deploy.index');
Route::post('/deploy', [DeploymentController::class, 'deploy'])->name('deploy.start');
Route::post('/revert', [DeploymentController::class, 'revert'])->name('deploy.revert');

Route::get('/console', [LogViewerController::class, 'index']);
Route::get('/console/{fileName}', [LogViewerController::class, 'show']);

// Route::get('sendSMS', [TwilioSMSController::class, 'index']);

Route::post('api/send-sms', [InfobipSMSController::class, 'sendSMS']);


//Paystack Route
Route::get('api/paystack-onboard', [PaystackController::class, 'redirectToGateway'])
    ->name('paystack.init')
    ->withoutMiddleware('auth:sanctum');

Route::get('api/paystack-payment-success', [PaystackController::class, 'handleGatewayCallback'])
    ->name('paystack.success')
    ->withoutMiddleware('auth:sanctum');


    Route::post('/api/events/pay', [PaystackController::class, 'eventPayment']);
    Route::post('/api/contributions/pay', [PaystackController::class, 'makeContribution']);

// User routes
Route::post('/api/register', [UserController::class, 'register']);
Route::post('/api/login', [UserController::class, 'login']);
Route::post('/api/validate-otp', [UserController::class, 'validateOtp']);
Route::get('/api/profile', [UserController::class, 'profile']);
Route::post('/api/reset-password', [UserController::class, 'resetPassword']);


// Contribution routes
Route::get('/api/contributions', [ContributionController::class, 'index']);
Route::get('/api/user/contributions', [ContributionController::class, 'userContributions']);
Route::post('/api/contributions', [ContributionController::class, 'store']);



Route::get('/api/user/profile', [UserController::class, 'fetchProfile']);



// Event routes
Route::get('/api/events', [EventController::class, 'index']);
Route::get('/api/user/events', [EventController::class, 'userEvents']);
Route::post('/api/events', [EventController::class, 'store']);




///
Route::middleware('auth')->get('/', [DashboardController::class, 'dashboard'])->name('portal.dashboard');


Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login.post');
Route::post('/logout', function () {
    Auth::logout();
    toast('You have been logged out.','success');
    return redirect()->route('login');
})->name('logout');

Route::middleware(['auth'])->prefix('portal')->name('portal.')->group(function () {
    // Dashboard

    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/all', [UserController::class, 'all'])->name('users.all');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/portal/show/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/portal/settings/{id}', [UserController::class, 'settings'])->name('users.settings');
    Route::post('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
// Route to show the edit form
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

    Route::post('/store/user', [UserController::class, 'store'])->name('users.store');

// Route to update the user data
    Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');


    // Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');

    Route::get('contributions/{contribution}', [ContributionController::class, 'contributionEdit'])->name('contributions.edit');

    Route::post('contributions/{contribution}/toggle-status', [ContributionController::class, 'toggleStatus'])->name('contributions.toggle-status');
    Route::get('/portal/index', [ContributionController::class, 'portalIndex'])->name('Pcontributions.index');
    // Route::get('/portal/edit/contribution', [ContributionController::class, 'viewEdit'])->name('Pcontributions.edit');

    Route::get('/portal/Pcontributions/{id}/edit', [ContributionController::class, 'viewEdit'])->name('Pcontributions.edit');
    Route::put('/portal/Pcontributions/{id}', [ContributionController::class, 'update'])->name('Pcontributions.update');



    Route::get('/portal/create/contribution', [ContributionController::class, 'createContribution'])->name('Pcontribution.index');
    Route::post('/post/create/contribution', [ContributionController::class, 'storeContribution'])->name('Pcontributions.store');


    Route::get('/portal/reports', [ReportController::class, 'portalReport'])->name('reports.index');




    Route::get('portal/events', [EventController::class, 'portalIndex'])->name('Pevents.index');
    Route::post('portal/events/{event}/toggle-status', [EventController::class, 'toggleStatus'])->name('events.toggle-status');
    // Route to show the edit form
    Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
        // Route to handle the form submission for updating the event
    Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::get('/portal/events/create', [EventController::class, 'portalCreateEvent'])->name('Pevents.create');
    Route::post('/portal/events/post', [EventController::class, 'portalEventStore'])->name('events.store');




    // Route::post('users/{id}', [UserController::class, 'portalIndex'])->name('portal.contribution.index');


    // Contributions
    Route::prefix('contributions')->name('contributions.')->group(function () {
        Route::get('/', [ContributionController::class, 'index'])->name('index');
        Route::get('/all', [ContributionController::class, 'all'])->name('all');
        Route::get('/create', [ContributionController::class, 'create'])->name('create');
        Route::get('/approved', [ContributionController::class, 'approved'])->name('approved');
        Route::get('/pending', [ContributionController::class, 'pending'])->name('pending');



    });

    // Events
    Route::prefix('events')->name('events.')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('index');
        Route::get('/all', [EventController::class, 'all'])->name('all');
        Route::get('/create', [EventController::class, 'create'])->name('create');
        Route::get('/approved', [EventController::class, 'approved'])->name('approved');
        Route::get('/pending', [EventController::class, 'pending'])->name('pending');



    });

    // Users
    Route::prefix('users')->name('users.')->group(function () {

        // Route::get('/', [UserController::class, 'index'])->name('index');
        // Route::get('/all', [UserController::class, 'all'])->name('all');
        // Route::get('/create', [UserController::class, 'create'])->name('create');
        // Route::get('/show', [UserController::class, 'show'])->name('users.show');
        // Route::get('/settings/{id}', [UserController::class, 'settings'])->name('users.settings');




    });

    // Admin Settings (for super admin)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/categories', [AdminController::class, 'categories'])->name('categories.index');
        Route::get('/branches', [AdminController::class, 'branches'])->name('branches.index');
    });

    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/users-report', [ReportController::class, 'userReports'])->name('users');
    });
});
