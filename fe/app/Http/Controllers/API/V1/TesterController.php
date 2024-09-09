<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Validator;
use App\Models\User;

class TesterController extends Controller
{
    // public $view = 'product.';
    // public $route = 'products.';
    // public $title = 'Product';
    // public $model;
    // public $path = 'uploads/product/'; // Perhatikan 'public/' di sini

    // public function __construct(Product $model)
    // {
    //     $this->model = $model;
    //     View::share('view', $this->view);
    //     View::share('route', $this->route);
    //     View::share('title', $this->title);
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::get();

        if($user) {
            return response()->json([
                'message' => 'Data Found',
                'data' => $user
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not Found'
            ], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // $validator = Validator::make($request->all(),[
        //     'unit_id' => 'required|uuid',
        //     'category_id' => 'required|uuid',
        //     'name' => 'required|string|max:255',
        //     'price' => 'required|integer',
        //     'status' => 'required|in:available,sold,close',
        //     'description' => 'required|string',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Validation errors',
        //         'errors' => $validator->errors()
        //     ], 422);
        // }

        // $input = $request->all();

        // $result = $this->model->create([
        //     // 'id' => $input['id'],
        //     'unit_id' => $input['unit_id'],
        //     'category_id' => $input['category_id'],
        //     'name' => $input['name'],
        //     'price' => $input['price'],
        //     'status' => $input['status'],
        //     'description' => $input['description'],
        // ]);

        // if($result) {
        //     return response()->json([
        //         'message' => 'Created',
        //         'code' => 201,
        //         'data' => $result
        //     ], 201);
        // }

        // return response()->json([
        //     'message' => 'Failed to Create',
        //     'code' => 400,
        //     'data' => $result
        // ], 400);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
