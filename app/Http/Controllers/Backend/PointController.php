<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Point;

class PointController extends Controller
{
    public function index()
    {
        $points = Point::select('id', 'account_id', 'point')->get();
        return response()->json($points);
    }

    public function show($id)
    {
        $point = Point::find($id);

        if (!$point) {
            return response()->json(['message' => 'Point not found'], 404);
        }

        return response()->json($point);
    }

    public function showByAccount($account_id)
    {
        $point = Point::where('account_id', $account_id)->first();

        if (!$point) {
            return response()->json(['message' => 'Account not found'], 404);
        }

        return response()->json($point);
    }
}
