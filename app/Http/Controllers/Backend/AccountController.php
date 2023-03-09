<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Http\Requests\AccountRequest;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::select('id', 'account_name')->get();
        return response()->json($accounts);
    }

    public function show(Account $account)
    {
        return response()->json($account);
    }
}
