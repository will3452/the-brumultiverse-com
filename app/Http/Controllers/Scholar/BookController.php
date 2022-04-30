<?php

namespace App\Http\Controllers\Scholar;

use App\Helpers\FileHelper;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Account;
use App\Models\College;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Level;

class BookController extends Controller
{
    public function customValidate(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'title' => 'required',
            'category' => 'required',
            'account' => 'required',
            'genre' => 'required',
            'has_warning_message' => 'boolean',
            'tags' => 'required',
            'language' => 'required',
            'lead_character' => 'required',
            'lead_college' => 'required',
            'blurb' => 'required',
            'cost' => ['numeric', 'gte:0'],
            'credit' => 'required',
            'cover' => ['image','max:2000'],
            'violence_level' => '',
            'heat_level' => '',
        ]);
    }


    public function getData()
    {
        return [
            Category::forBook(),
            Account::getApprovedAccountsFor(auth()->id()),
            Genre::forBook(),
            Language::get()->pluck('name', 'id'),
            College::get()->pluck('name', 'name'),
        ];
    }

    public function index()
    {
        $books = auth()->user()->books;
        $accounts = auth()->user()->accounts()->whereNotNull('approved_at')->whereHas('books')->get();
        return view('scholar.book.index', compact('books', 'accounts'));
    }

    public function create()
    {
        $heatLevel = Level::whereType(Level::TYPE_HEAT)->get();
        $violenceLevel = Level::whereType(Level::TYPE_VIOLENCE)->get();
        [$categories, $accounts, $genres, $languages, $colleges] = $this->getData();
        return view('scholar.book.create', compact('categories', 'accounts', 'genres', 'languages', 'colleges', 'heatLevel', 'violenceLevel'));
    }

    public function store(Request $request)
    {
        $this->customValidate($request);

        if (is_null($request->has_warning_message) || ! $request->has_warning_message) { // add false if no warning messagew
            $request->has_warning_message = false;
        }

        $book = Book::processToCreate($request);
        return redirect(route('scholars.book.show', ['book' => $book->id]))->withSuccess('Success');
    }

    public function show(Request $request, Book $book)
    {
        [$categories, $accounts, $genres, $languages, $colleges] = $this->getData();
        return view('scholar.book.show', compact('book', 'categories', 'accounts', 'genres', 'languages', 'colleges'));
    }

    public function update(Request $request, Book $book)
    {
        Book::processToUpdate($request, $book);

        return back()->withSuccess('success!');
    }

    public function pdfUploadForm(Request $request, Book $book)
    {
        return view('scholar.book.pdf', compact('book'));
    }

    public function pdfUploadFormStore(Request $request, Book $book)
    {

        $pdfs = [];

        foreach ($request->pdf as $value) {
            array_push($pdfs, FileHelper::save($value));
        }

        $pdfString = implode('!***!', $pdfs);

        $book->update([
            'front_matter' => $pdfString,
        ]);

        return redirect(route('scholars.book.show', ['book' => $book->id]))->withSuccess('Success');
    }

    public function showChapters(Book $book)
    {
        $artScenes = auth()->user()->artScenes;
        return view('scholar.book.chapter.index', compact('book', 'artScenes'));
    }

    public function showBookDemo(Book $book)
    {
        $chapter = $book->chapters()->paginate(1);
        $fileType = $book->category->file_type;
        return view('scholar.book.demo', compact('book', 'chapter', 'fileType'));
    }

    public function prologue(Request $request, Book $book)
    {
        $book->prologue()->create([
            'body' => $request->body,
        ]);
        return back()->withSuccess('Prologue added!');
    }

    public function epilogue(Request $request, Book $book)
    {
        $book->epilogue()->create([
            'body' => $request->body,
        ]);
        return back()->withSuccess('Epilogue added!');
    }
}
