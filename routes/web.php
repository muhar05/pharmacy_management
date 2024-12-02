<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckRole;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Medicine;
use App\Models\Restock;
use App\Models\Sale;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,cashier,inventory_manager'])->name('dashboard');

Route::get('/cashier', function () {
    return view('cashier', ['medicines' => Medicine::latest()->get()]);
})->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,cashier,inventory_manager'])->name('cashier');

Route::get('/medicines', function () {
    // Mengambil data medicines dengan eager loading untuk kategori dan supplier
    $medicines = Medicine::with(['category', 'supplier'])->latest()->get();

    return view('medicines', ['medicines' => $medicines]);
})->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,inventory_manager'])->name('medicines');

Route::get('/medicines/{id}', function ($id) {
    $medicine = Medicine::find($id);
    if (!$medicine) {
        abort(404);
    }

    return view('medicine', [
        'title' => 'Detail Medicine',
        'medicine' => $medicine
    ]);
})->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,inventory_manager'])->name('medicine.detail');

Route::get('/sales', function () {
    return view('sales', ['sales' => Sale::all()]);
})->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,cashier'])->name('sales');

Route::get('/customers', function () {
    return view('customers', ['customers' => Customer::all()]);
})->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,cashier'])->name('customers');

Route::get('/suppliers', function () {
    $suppliers = Supplier::with('medicines')->get(); // eager loading
    return view('suppliers', ['suppliers' => $suppliers]);
})->middleware(['auth', 'verified', CheckRole::class . ':admin,inventory_manager'])->name('suppliers');

Route::get('/employees', function () {
    return view('employees', ['employees' => Employee::all()]);
})->middleware(['auth', 'verified', CheckRole::class . ':admin'])->name('employees');

Route::get('/users', function () {
    return view('users', ['users' => User::all()]);
})->middleware(['auth', 'verified', CheckRole::class . ':admin'])->name('users');

// Medicine CRUD
Route::post('/medicines', [MedicineController::class, 'store'])->name('medicine.add')->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,inventory_manager']);  
Route::delete('/medicines/{id}', [MedicineController::class, 'destroy'])->name('medicine.delete')->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,inventory_manager']);
Route::put('/medicines/{id}', [MedicineController::class, 'update'])->name('medicine.update')->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,inventory_manager']);
Route::post('/medicines/search', [MedicineController::class, 'search'])->name('medicine.search')->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,inventory_manager']);

// sales CRUD

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';