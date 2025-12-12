<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;   
use App\Http\Controllers\UserController; 
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

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,cashier,inventory_manager'])
    ->name('dashboard');

Route::get('/cashier', function () {
    return view('cashier', [
        'medicines' => Medicine::latest()->get(),
        'customers' => Customer::all()
    ]);
})->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,cashier,inventory_manager'])->name('cashier');

// Medicines
Route::get('/medicines/export', [MedicineController::class, 'export'])->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,inventory_manager'])->name('medicines.export');
Route::get('/medicines/export-pdf', [MedicineController::class, 'exportPdf'])->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,inventory_manager'])->name('medicines.export-pdf');

// Sales
Route::get('/sales/export-xlsx', [SaleController::class, 'export'])->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,cashier'])->name('sales.export-xlsx');
Route::get('/sales/export-pdf', [SaleController::class, 'exportPdf'])->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,cashier'])->name('sales.export-pdf'); 

// Customers
Route::get('/customers/export-xlsx', [CustomerController::class, 'export'])->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,cashier'])->name('customers.export-xlsx');
Route::get('/customers/export-pdf', [CustomerController::class, 'exportPdf'])->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,cashier'])->name('customers.export-pdf');

// Suppliers
Route::get('/suppliers/export-xlsx', [SupplierController::class, 'export'])->middleware(['auth', 'verified', CheckRole::class . ':admin,inventory_manager'])->name('suppliers.export-xlsx');        
Route::get('/suppliers/export-pdf', [SupplierController::class, 'exportPdf'])->middleware(['auth', 'verified', CheckRole::class . ':admin,inventory_manager'])->name('suppliers.export-pdf');    

Route::get('/medicines', [MedicineController::class, 'index'])
    ->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,inventory_manager'])
    ->name('medicines');

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
    // Ambil semua data penjualan
    $sales = Sale::with('customer')->get();

    // Ambil semua data obat
    $medicines = Medicine::all();

    // Hitung jumlah total row di tabel medicine
    $totalMedicineRows = Medicine::count();
    // Hitung total amount dari semua penjualan
    $totalSales = $sales->sum('total_amount');

    // Kembalikan view dengan data penjualan dan total penjualan
    return view('sales', ['sales' => $sales, 'totalSales' => $totalSales, 'totalMedicineRows' => $totalMedicineRows]);  
})->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,cashier'])->name('sales');

Route::get('/sales/{id}', function ($id) {
    // Temukan data sale dengan relasi terkait
    $sale = Sale::with(['customer', 'saleDetails', 'user'])->find($id);

    if (!$sale) {
        abort(404);
    }

    return view('sale', [
        'title' => 'Detail Sale',
        'sale' => $sale
    ]);
})->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,cashier'])->name('sale.detail');

Route::get('/customers', function () {
    return view('customers', ['customers' => Customer::all()]);
})->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,cashier'])->name('customers');

Route::get('/suppliers', function () {
    $suppliers = Supplier::with('medicines')->get(); // eager loading
    return view('suppliers', ['suppliers' => $suppliers]);
})->middleware(['auth', 'verified', CheckRole::class . ':admin,inventory_manager'])->name('suppliers');

Route::get('/users', function () {
    return view('users', ['users' => User::all()]);
})->middleware(['auth', 'verified', CheckRole::class . ':admin'])->name('users');

// Tambahkan di bawah route users list
Route::get('/users/create', [UserController::class, 'create'])
    ->middleware(['auth', 'verified', CheckRole::class . ':admin'])
    ->name('users.create');

// Medicine CRUD
Route::post('/medicines', [MedicineController::class, 'store'])->name('medicine.add')->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,inventory_manager']);
Route::delete('/medicines/{id}', [MedicineController::class, 'destroy'])->name('medicine.delete')->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,inventory_manager']);
Route::put('/medicines/{id}', [MedicineController::class, 'update'])->name('medicine.update')->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,inventory_manager']);
Route::post('/medicines/search', [MedicineController::class, 'search'])->name('medicine.search')->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,inventory_manager']);

// sales CRUD
Route::post('/checkout', [SaleController::class, 'store'])->name('cashier.checkout')->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,cashier']);
Route::put('/sales/{id}', [SaleController::class, 'update'])->name('sale.update')->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,cashier']);
Route::delete('/sales/{id}', [SaleController::class, 'destroy'])->name('sale.delete')->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,cashier']);   

// supplier RUD
Route::post('/suppliers', [SupplierController::class, 'create'])
    ->name('supplier.create')
    ->middleware(['auth', 'verified', CheckRole::class . ':admin,inventory_manager']);
Route::put('/suppliers/{id}', [SupplierController::class, 'update'])->name('supplier.update')->middleware(['auth', 'verified', CheckRole::class . ':admin,inventory_manager']);  
Route::delete('/suppliers/{id}', [SupplierController::class, 'destroy'])->name('supplier.delete')->middleware(['auth', 'verified', CheckRole::class . ':admin,inventory_manager']); 

// customer RUD 
Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customer.update')->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,cashier']);    
Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customer.delete')->middleware(['auth', 'verified', CheckRole::class . ':admin,pharmacist,cashier']);    

// users CRUD
Route::post('/users', [UserController::class, 'store'])->name('user.create')->middleware(['auth', 'verified', CheckRole::class . ':admin']);        
Route::patch('/users/{id}', [UserController::class, 'update'])->name('user.update')->middleware(['auth', 'verified', CheckRole::class . ':admin']); 
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.delete')->middleware(['auth', 'verified', CheckRole::class . ':admin']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';