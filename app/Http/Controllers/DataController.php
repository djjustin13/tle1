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
    // Global variables used by various functions
    public $numDaysYear = 365;
    public $numWeeksYear = 52;

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


        // Calculate meat answer
        //     Call meat function

        // Calculate car answer
        if($request->car != false){
            $data = Data::where('data_name', '=', $request->car['type'])->first();
            $car = $this->vehicle($data, $request->car);
        }

        //Calculate shower answer
        $data = Data::where('data_name', '=', 'shower')->first();
        
        $shower = $this->shower($data, $request->shower);

        //Calculate smoke answer
        if($request->smoke != false){
            //call smoke function
        }

        $data = [
            'car' => $car,
            'shower' => $shower,
        ];

        return response()->json($data);
    }

    public function compare($category, Request $request){

        $resultFromDB = Data::where('data_name', '=', $category)->first();
        $input = $request->input;

        if ($resultFromDB->id == 1){
            return $this->shower($resultFromDB, $input);
        } else if ($resultFromDB->id == 2 || $resultFromDB->id == 3 || $resultFromDB->id == 4 || $resultFromDB->id == 5 || $resultFromDB->id == 6 || $resultFromDB->id == 10){
            return $this->vehicle($resultFromDB, $input);
        } else if ($resultFromDB->id == 8) {
            return $this->flesheaters($resultFromDB, $input);
        }
        
        return response()->json($resultFromDB);
    }

    /**
     * Private functions declared here.
     * 
     * 
     */
    private function shower($resultFromDB, $input) {
        // Declare some basic variables like year and day.
        $numDaysWeek = $input['days'];

        $work = true;

        // Fetch discharge per year from selected category.
        $avgDischargeYear = $resultFromDB->co2_year_average;
        $avgDischargeMin = $resultFromDB->co2_by_unit;

        $usrDailyMin = $input['minutes'];
        $usrWeeklyMin = $usrDailyMin * $numDaysWeek;

        $usrDischargePerDay = $usrDailyMin * $avgDischargeMin;

        // We divide by 1000 to transform the gram to kilogram.
        $usrDischargePerYear = $usrDischargePerDay * $this->numDaysYear / 1000;

        if ($usrDischargePerYear == $avgDischargeYear || $usrDischargePerYear > $avgDischargeYear) {
            $work = false;
        } else if ($usrDischargePerYear < $avgDischargeYear) {
            $work = true;
        }

        $calculations = [
            'avgDischargeYear' => $avgDischargeYear,
            'avgDischargeMin' => $avgDischargeMin,
            'usrDailyMin' => $usrDailyMin,
            'usrWeeklyMin' => $usrWeeklyMin,
            'usrDischargePerDay' => $usrDischargePerDay,
            'usrDischargePerYear' => $usrDischargePerYear,
            'usrBelowAverage' => $work
        ];

        return $calculations;
    }

    private function vehicle($resultFromDB, $input) {
        $numKMWeek = $input['km'];
        $work = true;

        // Fetch discharge per year from selected category.
        $avgDischargeYear = $resultFromDB->co2_year_average;
        $avgDischargeKm = $resultFromDB->co2_by_unit;

        $usrWeeklyDischarge = $numKMWeek * $avgDischargeKm;
        $usrAnnualDischarge = $usrWeeklyDischarge * $this->numWeeksYear / 1000;

        if ($usrAnnualDischarge == $avgDischargeYear || $usrAnnualDischarge > $avgDischargeYear) {
            $work = false;
        } else if ($usrAnnualDischarge < $avgDischargeYear) {
            $work = true;
        }

        $calculations = [
            'avgDischargeYear' => $avgDischargeYear,
            'avgDischargeKM' => $avgDischargeKm,
            'usrWeeklyDischarge' => $usrWeeklyDischarge,
            'usrWeeklyKM' => $numKMWeek,
            'usrAnnualDischarge' => $usrAnnualDischarge,
            'usrBelowAverage' => $work
        ];

        return $calculations;

    }

    private function flesheaters($resultFromDB, $input){
        $avgDischargePerKG = $resultFromDB->co2_by_unit;
        $avgDischargePerYear = $resultFromDB->co2_year_average;

        $usrNumDaysPerWeek = $input;

        // On average a daily meal consists of 100 grams of meat.
        $usrWeeklyAmountOfFlesh = $usrNumDaysPerWeek * 100;

        return $input;


    }


}
