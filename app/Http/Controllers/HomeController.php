<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Request containing array of key-value pairs of data to be added to the database.
     */
    public function addData(Request $request)
    {
        // Get the data from the request
        // $data = $request->data;
        $data = json_decode($request->data, true);

        // Add the data to the database
        // $this->addDataToDatabase($data);

        // Return the response to the user
        if ($data) {
            return response()->json([
                'alert' => 'success',
                'message' => 'Data berhasil ditambahkan.',
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'alert' => 'error',
                'message' => 'Data gagal ditambahkan.',
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('page.main');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
