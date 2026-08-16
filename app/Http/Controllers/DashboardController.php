<?php

namespace App\Http\Controllers;

use App\Models\Prova;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard', ['provas' => Prova::orderBy('nome')->get()]);
    }
}
