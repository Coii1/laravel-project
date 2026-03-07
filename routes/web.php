<?php

// use Illuminate\Support\Facades\DB;
use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;
use App\Models\Idea;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SessionsController;

Route::get('/', function () {
    return 'Homepage';
});

Route::middleware('auth')->group(function () {

    Route::get('/ideas', [IdeaController::class, 'index']);
    Route::get('/ideas/create', [IdeaController::class, 'create']);
    Route::post('/ideas', [IdeaController::class, 'store']);
    Route::get('/ideas/{idea}', [IdeaController::class, 'show']);
    Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit'])->middleware('can:update,idea');
    Route::patch('/ideas/{idea}', [IdeaController::class, 'update']);
    Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy']);

    Route::delete('/logout', [SessionsController::class, 'destroy']);
});

Route::middleware('guest')->group(function () {

    Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest');
    Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/login', [SessionsController::class, 'store']);
});

//Route::get('/admin', function () {
//    Gate::authorize('view-admin');
//    return 'Admin Page';
//});






















/**
 * Migration Approaches for changes:
 * 1. Create a new migration file and add the new column to the existing table.
 * 2. Modify the existing migration file and run the migration again (not recommended for production environments).
 * 3. Use Laravel's schema builder to add the new column directly in the code without creating a new migration file (not recommended for production environments).
 * 4. Use Laravel's artisan command to generate a new migration file that adds the new column to the existing table.
 * 5. Use Laravel's artisan command to generate a new migration file that modifies the existing table to add the new column, and then run the migration to apply the changes to the database.
 */







// Route::get('/', function () {
//     // $ideas = session('ideas');
//     //$ideas = DB::table('ideas')->get();

// $ideas = \Illuminate\Support\Facades\DB::table('ideas')->get();             // Illuminate\Support\Collection
// dd($ideas[0]->description);
// dd($ideas[0]->description);
// $ideas = Idea::where(function ($query) {
//     $query->where('state', 'pending')
//           ->orWhere('state', 'draft');
// })->get();

// $ideas = Idea::query()
// ->when(request('state'), function ($query) {
//     $query->where('state', request('state'));
// })->get();

//     //$ideas = Idea::where('state', 'draft')->get();
//     //dd($ideas);
//     // $ideas = Idea::query()
//     //     ->when(request('state'), function ($query, $state) {
//     //         //dd($state);
//     //         $query->where('state', $state);
//     //     })
//     //     ->get();

//     //$ideas = Idea::where('state', 'draft')->get();
//     // return $ideas[0]->description;
//     // dd($idea);
//     // return $idea;

//     $ideas = Idea::all();

//     return view('ideas', [
//         'ideas' => $ideas
//     ]);

// });

// Route::post('/ideas', function () {
//     // dd("hello");
//     //dd(request()->all());
//     // $ideas = request('ideas');

//     //session(['ideas'=> $ideas]);
//     // "dfgfdsg" // routes\web.php:24

//     // session()->push('ideas', $ideas);
//         // array:1 [▼ // routes\web.php:19
//         //  0 => "sdfgsh"
//         // ]

//     //$var = session('ideas');
//     // $var = session()->get('ideas');
//     // dd($var);

//     $idea = request('idea');
//     //dd($idea);

//     Idea::create([
//         'description' => $idea,
//         'state' => 'pending'
//     ]);

//     return redirect('/');
// });

// Route::get('/delete-ideas', function () {
//     // session()->forget('ideas');
//     Idea::truncate();
//     return redirect('/');
// });
