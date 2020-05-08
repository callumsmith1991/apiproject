<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Books;
use Illuminate\Validation\ValidationException;

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
                "message" => "All Books",
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

    public function all_categories(Books $books)
    {

        $categorys = array();

        $books_list = $books::all();

        if ($books_list->isNotEmpty()) {

            $books_list = $books_list->toArray();

            foreach ($books_list as $book) {

                if (!empty($book['category'])) {

                    if (strpos($book['category'], ',') == true) {

                        $cat_arr = explode(',', $book['category']);

                        foreach ($cat_arr as $cat) {

                            $categorys[] = str_replace(' ', '', $cat);
                        }
                    } else {

                        $categorys[] = $book['category'];
                    }
                }
            }

            // $categorys = array_unique($categorys);

            if (count($categorys) > 0) {

                return response()->json([
                    'message' => 'List of categories',
                    'categories' => array_unique($categorys)
                ], 200);
            } else {

                return response()->json([
                    'message' => 'No Categories added yet'
                ], 200);
            }
        } else {

            return response()->json([
                'message' => 'No Categories can be displayed because their is no books in the database'
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

    public function category_and_author_filter($category, $author)
    {

        $books_by_category_and_author = Books::where('category', 'like', '%' . $category . '%')->where('author', 'like', '%' . $author . '%')->get();

        if ($books_by_category_and_author->isNotEmpty()) {

            $books_by_category_and_author = $books_by_category_and_author->toArray();

            return response()->json([
                "message" => "Books in " . $category . " by " . $author . "",
                "books" => $books_by_category_and_author
            ], 200);
        } else {

            return response()->json([
                "message" => "No results found for your selected criteria"
            ], 404);
        }
    }

    public function create_book(Request $request)
    {

        try {

            $validated = $request->validate([
                'ISBN' => ['required', 'regex:/^[0-9- ]+$/D', 'min:14'],
                'title' => 'required',
                'author' => 'required',
                'price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/']
            ]);

            $check_if_isbn_exists = Books::where('ISBN', '=', $validated['ISBN'])->first();

            if ($check_if_isbn_exists === null) {

                Books::create($validated);

                return response()->json([
                    "message" => 'Book created succesfully',
                    "createdBook" => $validated
                ], 201);

            } else {

                return response()->json([
                    "message" => 'ISBN already exists for '.$validated['ISBN'].', this number should be unique',
                ], 400);

            }

        } catch (ValidationException $e) {


            return response()->json([
                "message" => "Validation errors",
                "errors" => $e->errors()
            ], 400);
        }
    }
}
