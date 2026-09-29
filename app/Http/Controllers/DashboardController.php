<?php

namespace App\Http\Controllers;

use App\Services\ResumenAdmin;

class DashboardController extends Controller
{
    public function index(ResumenAdmin $resumen)
    {
        return view('admin.dashboard', $resumen->datos());
    }
}
