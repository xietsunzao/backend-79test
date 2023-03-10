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

    public function show($id)
    {
        $account = Account::select('id', 'account_name')->find($id);
        return response()->json($account);
    }

    public function store(AccountRequest $request)
    {
        $account = Account::create($request->all());
        $reponses = [
            'message' => 'Account created successfully',
            'account' => $account
        ];
        return response()->json($reponses);
    }
}
