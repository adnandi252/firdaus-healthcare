<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use Illuminate\Http\Request;

class DrugController extends Controller
{
    public function showTableMedicine()
    {
        $medicines = Drug::all();
        return view('medicineList.medicine', compact('medicines'));
    }
}
