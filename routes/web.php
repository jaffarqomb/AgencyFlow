<?php

use App\Models\Project;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('/portal', function () {
    $project = Project::with([
        'client',
        'stages.tasks',
        'deliverables.versions.approvals',
        'invoices.payments',
        'projectManager',
    ])->first();

    return view('portal', compact('project'));
})->name('portal');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
