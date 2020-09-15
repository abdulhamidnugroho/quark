<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::paginate(5);

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        // dd($categories);
        return view('books.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBookRequest $request)
    {
        $check_image = $request->hasFile('image');

        $image = $check_image ? $request->file('image')->store('book') : null;

        $book = Book::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image,
            'category_id' => $request->category_id
        ]);

        // flash message
        session()->flash('success', 'Boook created successfully!');

        return redirect(route('books.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.create')->with('book', $book)->with('categories', Category::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $data = $request->only([
            'name',
            'description',
            'category_id',
            'image',
        ]);

        // check if new image
        if ($request->hasFile('image'))
        {
            // upload
            $image = $request->file('image')->store('book');

            // delete old image
            $book->deleteImage();

            $data['image'] = $image;
        }

        // update attribute
        $book->update($data);

        session()->flash('success', 'Book Updated Successfully!');
        return redirect(route('books.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::where('id', $id)->firstOrFail();

        Book::destroy($id);
        $book->deleteImage();

        session()->flash('success', 'Book Deleted Successfully!');
        return redirect(route('books.index'));
    }
}
