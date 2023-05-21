<?php

namespace App\Http\Controllers;

use App\Models\DataCovid;
use App\Models\DataUpdateHistory;
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

    public function getData()
    {
        $start = microtime(true);

        // Get the data from the database that is_predicted = false
        $data = DataCovid::where('is_predicted', false)->get();

        $time_elapsed_secs = microtime(true) - $start;

        // Return the response to the user
        if ($data) {
            return response()->json([
                'alert' => 'success',
                'message' => 'Data is successfully retrieved.',
                'data' => $data,
                'time' => $time_elapsed_secs,
            ]);
        } else {
            return response()->json([
                'alert' => 'error',
                'message' => 'Failed to retrieve data.',
            ]);
        }
    }

    public function train()
    {
        return view('page.train');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataUpdateHistory = DataUpdateHistory::orderBy('created_at', 'desc')->first();

        $updateNeeded = "false";
        // check if it's already 7 days since the last update
        if ($dataUpdateHistory) {
            $lastUpdate = strtotime($dataUpdateHistory->created_at);
            $now = strtotime(date('Y-m-d H:i:s'));
            $diff = $now - $lastUpdate;
            $diff = floor($diff / (60 * 60 * 24));

            if ($diff >= 7) {
                $updateNeeded = "true";
            }
        }

        return view('page.main', compact('updateNeeded'));
    }

    public function addDataUpdateHistory()
    {
        $dataUpdateHistory = new DataUpdateHistory();
        $dataUpdateHistory->save();

        return "New data update history is added.";
    }

    public function addPredictions(Request $request)
    {
        $predictions = $request->predictions;

        $predictionsExist = DataCovid::where('is_predicted', true)->get();
        if ($predictionsExist) {
            DataCovid::where('is_predicted', true)->delete();
        }

        $lastDate = DataCovid::orderBy('date', 'desc')->first()->date;
        $count = 0;
        foreach ($predictions as $prediction) {
            $lastDate = date('Y-m-d', strtotime($lastDate . ' + 1 days'));
            $dataCovid = new DataCovid();
            $dataCovid->date = $lastDate;
            $dataCovid->new_cases = $prediction;
            $dataCovid->is_predicted = true;
            $dataCovid->save();
            $count++;
        }

        if ($count == count($predictions)) {
            return "New predictions are added.";
        } else {
            return "Failed to add new predictions.";
        }
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
