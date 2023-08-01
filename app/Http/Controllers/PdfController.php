<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function exportReport($timePeriod) {
        $users = User::all();
        $pdf = Pdf::loadView('admin.pages.users.index', $users);
        return $pdf->download('invoice.pdf');
    }
}
