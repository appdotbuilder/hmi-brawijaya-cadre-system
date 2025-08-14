<?php

use App\Http\Controllers\CadreProfileController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\BookLoanController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        $user = auth()->user();
        $stats = [];
        
        // Get basic stats if user is admin/management
        if (method_exists($user, 'isAdministrator') && ($user->isAdministrator() || $user->isManagement())) {
            $stats = [
                'totalCadres' => \App\Models\User::where('role', 'cadre')->count(),
                'totalLibraryItems' => \App\Models\LibraryItem::count(),
                'totalActiveLoans' => \App\Models\BookLoan::whereIn('status', ['approved', 'borrowed'])->count(),
                'upcomingEvents' => \App\Models\AttendanceEvent::where('event_date', '>', now())->count(),
            ];
        }
        
        return Inertia::render('dashboard', $stats);
    })->name('dashboard');

    // Cadre Profile routes
    Route::resource('cadre-profiles', CadreProfileController::class);

    // Library routes
    Route::resource('library', LibraryController::class);

    // Book Loan routes
    Route::resource('book-loans', BookLoanController::class)->except(['create', 'edit']);

    // Attendance routes
    Route::resource('attendance', AttendanceController::class);
    
    // Attendance check-in route (uses the store method with attendance_event_id)
    Route::post('attendance/check-in', [AttendanceController::class, 'store'])
        ->name('attendance.check-in');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';