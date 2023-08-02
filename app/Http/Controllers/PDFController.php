<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{


// ...

public function download($card)
{
    $card = Card::findOrfail($card);

    $pdf = PDF::loadView('card',['card' => $card]);
    return $pdf->download('your-filename.pdf');
}

}
