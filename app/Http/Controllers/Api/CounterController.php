<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CounterRequest;
use App\Http\Requests\CounterShowRequest;
use App\Models\CounterModel;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Request\CounterRequest  $request
     * @return \App\Http\Request\CounterRequest
     */
    public function index(CounterShowRequest $request)
    {
        $data = $request->validated();

        $counters = CounterModel::where([
            ['date', '>=', $data['from']],
            ['date', '<=', $data['to']]
        ])->orderBy('date', 'ASC')->get()->toArray();

        foreach ($counters as $key => $counter) {
            $counters[$key]['cpc'] = $counter['cost'] / $counter['clicks'];
            $counters[$key]['cpm'] = $counter['cost'] / $counter['views'] * 1000;
        }

        return response()->json($counters, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request\CounterRequest  $request
     * @return \App\Http\Request\CounterRequest
     */
    public function store(CounterRequest $request)
    {
        $data = $request->validated();

        $check_date = CounterModel::where('date', $data['date'])->first();
        if (is_null($check_date)) {
            CounterModel::insert($data);
        } else {
            $check_date->update([
                'views' => $check_date['views'] + $data['views'],
                'clicks' => $check_date['clicks'] + $data['clicks'],
                'cost' => $check_date['cost'] + $data['cost'],
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyAll()
    {
        CounterModel::truncate();
    }
}
