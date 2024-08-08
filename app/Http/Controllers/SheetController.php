<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sheet;

class SheetController extends Controller
{
    public function getSheets()
    {
        $sheets = Sheet::all()->groupBy('row');
        return view('getSheets', ['sheets' => $sheets]);
    }
}
