<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\ClassifyIndicatorController;
use App\Http\Controllers\SelectDraftIndicatorController;
use App\Http\Controllers\DraftIndicatorController;
use App\Http\Controllers\MfoController;
use App\Http\Controllers\SubmitDraftIndicatorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndicatorController;
use App\Http\Controllers\PendingSubmissionIndicatorController;
use App\Http\Controllers\InitialApprovalIndicatorController;
use App\Http\Controllers\FinalApprovalIndicatorController;
use App\Http\Controllers\EvaluateIndicatorController;
use App\Http\Controllers\SecondaryIndicatorController;
use App\Http\Controllers\ArchivedIndicatorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/agencies', [AgencyController::class, 'index'])->name('agencies.index');
    Route::post('/agencies', [AgencyController::class, 'store'])->name('agencies.store');
    Route::put('/agencies/{id}/update', [AgencyController::class, 'update'])->name('agencies.update');
    Route::delete('/agencies/{id}/delete', [AgencyController::class, 'destroy'])->name('agencies.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}/update', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}/delete', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/select-draft-indicators', [SelectDraftIndicatorController::class, 'index'])->name('select_draft_indicators.index');
    Route::post('/select-draft-indicators', [SelectDraftIndicatorController::class, 'store'])->name('select_draft_indicators.store');

    Route::get('/draft-indicators', [DraftIndicatorController::class, 'index'])->name('draft_indicators.index');
    Route::post('/draft-indicators', [DraftIndicatorController::class, 'store'])->name('draft_indicators.store');
    Route::put('/draft-indicators/{id}/update', [DraftIndicatorController::class, 'update'])->name('draft_indicators.update');
    Route::delete('/draft-indicators/{id}/delete', [DraftIndicatorController::class, 'destroy'])->name('draft_indicators.destroy');

    Route::get('/draft-mfos', [MfoController::class, 'index'])->name('mfos.index');
    Route::post('/draft-mfos', [MfoController::class, 'store'])->name('mfos.store');
    Route::put('/draft-mfos/{id}/update', [MfoController::class, 'update'])->name('mfos.update');
    Route::delete('/draft-mfos/{id}/delete', [MfoController::class, 'destroy'])->name('mfos.destroy');

    Route::post('/mfo/{id}/store', [MfoController::class, 'store'])->name('mfo.store');

    Route::get('/submit-draft-indicators', [SubmitDraftIndicatorController::class, 'index'])->name('submit_draft_indicators.index');
    Route::post('/submit-draft-indicators', [SubmitDraftIndicatorController::class, 'store'])->name('submit_draft_indicators.store');

    Route::get('/indicators/pending', [PendingSubmissionIndicatorController::class, 'index'])->name('pending_submission.index');
    Route::post('/indicators/pending/approve', [PendingSubmissionIndicatorController::class, 'approve'])->name('pending_submission.approve');
    Route::post('/indicators/pending/reject', [PendingSubmissionIndicatorController::class, 'reject'])->name('pending_submission.reject');

    Route::get('/indicators/inital-approval', [InitialApprovalIndicatorController::class, 'index'])->name('initial_approval.index');
    Route::post('/indicators/initial-approval/approve', [InitialApprovalIndicatorController::class, 'approve'])->name('initial_approve.approve');
    Route::post('/indicators/initial-approval/reject', [InitialApprovalIndicatorController::class, 'reject'])->name('initial_approve.reject');

    Route::get('/indicators/classify', [ClassifyIndicatorController::class, 'index'])->name('classify_indicators.index');
    Route::post('/indicators/classify', [ClassifyIndicatorController::class, 'classify'])->name('classify_indicators.classify');

    Route::get('/indicators/final-approval', [FinalApprovalIndicatorController::class, 'index'])->name('final_approval.index');
    Route::post('/indicators/final-approval/approve', [FinalApprovalIndicatorController::class, 'approve'])->name('final_approval.approve');
    Route::post('/indicators/final-approval/reject', [FinalApprovalIndicatorController::class, 'reject'])->name('final_approval.reject');

    Route::get('/indicators', [IndicatorController::class, 'index'])->name('indicators.index');
    Route::get('/indicators/secondary', [SecondaryIndicatorController::class, 'index'])->name('secondary_indicators.index');

    Route::get('/indicators/archived', [ArchivedIndicatorController::class, 'index'])->name('archived_indicators.index');
    Route::post('/indicators/archived/{id}', [ArchivedIndicatorController::class, 'update'])->name('archived_indicators.update');

    Route::get('/indicators/evaluate', [EvaluateIndicatorController::class, 'index'])->name('evaluate_indicators.index');
    Route::post('/indicators/{id}/evaluate', [EvaluateIndicatorController::class, 'store'])->name('evaluate_indicators.store');
});

require __DIR__.'/auth.php';
