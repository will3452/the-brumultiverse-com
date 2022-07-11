<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class QuoteMakerController extends Controller
{
    public function makeQuote(Request $request) {
        $text = $request->text;
        $book = Book::find($request->book_id);
        return view('quote-maker', compact('book', 'text'));
    }
}
