<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Books;

class ApiController extends Controller
{
    public function index()
    {

        $books = Books::all();

        if ($books->isEmpty()) {

            return response()->json([
                "message" => "No books to currently show here"
            ], 200);
        } else {

            return response()->json([
                "message" => "We have books to show",
                "books" => $books
            ], 200);
        }
    }

    public function author_filter($name)
    {

        $books_by_author = Books::where('author', 'like', '%' . $name . '%')->get();

        if ($books_by_author->isNotEmpty()) {

            return response()->json([
                "message" => "Books By Author " . $name . "",
                "books" => $books_by_author
            ], 200);
        } else {


            return response()->json([
                "message" => "No books by this author"
            ], 404);
        }
    }

    public function category_filter($category)
    {

        $books_by_category = Books::where('category', 'like', '%' . $category . '%')->get();

        if ($books_by_category->isNotEmpty()) {

            return response()->json([
                "message" => "Books in this category " . $category . "",
                "books" => $books_by_category
            ], 200);
        } else {

            return response()->json([
                "message" => "No books in this category"
            ], 404);
        }
    }

    public function create_book(Request $request)
    {
    }
}
