<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'API JONGEH';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function calculate(Request $request){


        return $request->data + 10;

    }

    public function compare($category){
        $result = Data::where('data_name', '=', $category)->get();

        // Declare some basic variables like year and day.
        $numDaysYear = 365;
        $numDaysWeek = 7;

        $work = true;

        // Fetch discharge per year from selected category.
        $avgDischargeYear = $result[0]->co2_year_average;
        $avgDischargeMin = $result[0]->co2_by_unit;

        // Fetch user results. Now not working since we don't post any data. Still some test data.
        $usrDailyMin = 10;
        $usrWeeklyMin = $usrDailyMin * $numDaysWeek;

        $usrDischargePerDay = $usrDailyMin * $avgDischargeMin;

        // We divide by 1000 to transform the gram to kilogram.
        $usrDiscargePerYear = $usrDischargePerDay * $numDaysYear / 1000;

        if ($usrDiscargePerYear === $avgDischargeYear || $usrDiscargePerYear > $avgDischargeYear) {
            $work = false;
        } else if ($usrDiscargePerYear < $avgDischargeYear) {
            $work = true;
        }

        dd($work);

    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
