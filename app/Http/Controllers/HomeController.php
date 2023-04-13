<?php

namespace App\Http\Controllers;

use App\Models\DataCovid;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Request containing array of key-value pairs of data to be added to the database.
     */
    public function addData(Request $request)
    {
        $start = microtime(true);

        // Get the data from the request
        // $data = $request->data;
        $data = json_decode($request->data, true);

        // Add the data to the database
        // $this->addDataToDatabase($data);

        $temp = null;

        // delete all data from table DataCovid
        DataCovid::truncate();

        // Return the response to the user
        if ($data) {
            foreach ($data as $key => $value) {
                $dataCovid = new DataCovid();
                $dataCovid->date = date('Y-m-d', strtotime($value['date']));
                $dataCovid->new_cases = $value['new_cases'];
                $dataCovid->save();
//                $temp = $value['date'];
//                break;
            }

            $time_elapsed_secs = microtime(true) - $start;

            return response()->json([
                'alert' => 'success',
                'message' => 'Data berhasil ditambahkan.',
                'data' => $data,
                'time' => $time_elapsed_secs,
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
        /*
        $data = array(
            array("date" => "2019-01-01", "new_cases" => 10),
            array("date" => "2019-01-02", "new_cases" => 20),
            array("date" => "2019-01-03", "new_cases" => 30),
        );
        */
        return view('page.main',
            // compact('data')
        );
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
