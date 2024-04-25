<?php

use App\Models\Worker;
use Illuminate\Support\Facades\Route;

Route::get('/',  function () {
    return response()->json([
        'workers' => Worker::all()
    ]);
});