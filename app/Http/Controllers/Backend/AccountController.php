<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Account;

class AccountController extends Controller
{
    public function index() : \Illuminate\Http\JsonResponse
    {
        $accounts = Account::all();
        return response()->json($accounts);
    }
}
