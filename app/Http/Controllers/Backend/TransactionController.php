<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Models\Point;

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

    public function showByAccount($account_id)
    {
        $transactions = Transaction::where('account_id', $account_id)->get();

        if (!$transactions) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        return response()->json($transactions, 200);
    }

    public function store(TransactionRequest $request)
    {
        $transaction = Transaction::create($request->all());
        $responses = [
            'message' => 'Transaction created',
            'data' => $transaction
        ];
        $points =  $this->addPointsFromTransaction($transaction->id);
        if ($points > 0) {
            $point = Point::create([
                'account_id' => $transaction->account_id,
                'transaction_id' => $transaction->id,
                'point' => $points
            ]);
            $responses['point'] = $point;
        }
        return response()->json($responses, 201);
    }

    private function addPointsFromTransaction($transaction_id)
    {
        $transaction = Transaction::find($transaction_id)->orderBy('id', 'desc')->first();

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $transaction->amount = (int) $transaction->amount;
        $points = 0;
        if ($transaction->description == 'Beli Pulsa') {
            if ($transaction->amount <= 10000) {
                $points += 0;
            } else if ($transaction->amount <= 30000) {
                $points  += ($transaction->amount - 10000) / 1000;
            } else {
                $points += ($transaction->amount - 30000) / 1000 * 2;
            }
        } else if ($transaction->description == 'Bayar Listrik') {
            if ($transaction->amount <= 50000) {
                $points += 0;
            } else if ($transaction->amount <= 100000) {
                $points += ($transaction->amount - 50000) / 1000;
            } else {
                $points += ($transaction->amount - 100000) / 1000 * 2;
            }
        }

        return $points;
    }
}
