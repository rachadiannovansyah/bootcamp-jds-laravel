<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // get request
        $sortBy = $request->input('sortBy', 'created_at');
        $orderBy = $request->input('orderBy', 'desc');
        $perPage = $request->input('perPage', 10);

        // for paginating
        $perPage = $this->getPaginationSize($perPage);

        // initial query
        $records = Book::query();

        // for search
        $this->searchRow($request, $records);

        // for sorting and ordering
        $records->orderBy($sortBy, $orderBy);

        return BookResource::collection($records->paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $book = Book::create($request->validated());

        return new BookResource($book);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, Book $book)
    {
        $book->update($request->validated());

        return new BookResource($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(['message' => 'Book has been successfully deleted']);
    }

    /**
     * Private function to defined size of pagination
     *
     * @param [Integer] $perPage
     * @return Integer
     */
    protected function getPaginationSize($perPage)
    {
        $perPageAllowed = [20, 50, 100, 500];

        if (in_array($perPage, $perPageAllowed)) {
            return $perPage;
        }

        return 10;
    }

    /**
     * Private function to search row
     *
     * @param [String] $request
     * @param [Collection] $records
     * @return Collection
     */
    protected function searchRow($request, $records)
    {
        if ($request->has('name')) {
            $records = $records->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if ($request->has('status')) {
            $records = $records->where('status', 'LIKE', '%' . $request->status . '%');
        }

        return $records;
    }
}
