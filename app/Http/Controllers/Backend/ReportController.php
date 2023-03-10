<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Http\Requests\ReportRequest;

class ReportController extends Controller
{
    public function getReportTransactionByDate(ReportRequest $request)
    {
        $transactions = Transaction::whereBetween('created_at', [$request->start_date, $request->end_date])->get();

        return response()->json($transactions, 200);
    }

}
