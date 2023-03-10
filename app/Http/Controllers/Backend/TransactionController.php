<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::select('id', 'account_id', 'amount', 'type')->get();
        return response()->json($transactions, 200);
    }

    public function show($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        return response()->json($transaction, 200);
    }

    public function store(TransactionRequest $request)
    {
        $transaction = Transaction::create($request->all());
        $responses = [
            'message' => 'Transaction created',
            'data' => $transaction
        ];
        return response()->json($responses, 201);
    }
}
