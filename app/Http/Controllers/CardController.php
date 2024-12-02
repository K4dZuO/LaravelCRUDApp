<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index ()
    {
        $cards = Card::all();
        return view('card.index', compact('cards'));
    }
}
