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
            $car = $this->vehicle($request->car);
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

        $result = Data::where('data_name', '=', $category)->first();
        $input = $request->input;

        if ($result[0]->id == 1){
            return $this->shower($result, $input);
        } else if ($result->id == 2 || $result->id == 3 || $result->id == 4 || $result->id == 5 || $result->id == 6 || $result->id == 10){
            return $this->vehicle($category, $input);
        }
        
        return response()->json($result);
    }

    /**
     * Private functions declared here.
     * 
     * 
     */
    private function shower($result, $input) {
        // Declare some basic variables like year and day.
        $numDaysWeek = $input['days'];

        $work = true;

        // Fetch discharge per year from selected category.
        $avgDischargeYear = $result->co2_year_average;
        $avgDischargeMin = $result->co2_by_unit;

        $usrDailyMin = $input['minutes'];
        $usrWeeklyMin = $usrDailyMin * $numDaysWeek;

        $usrDischargePerDay = $usrDailyMin * $avgDischargeMin;

        // We divide by 1000 to transform the gram to kilogram.
        $usrDiscargePerYear = $usrDischargePerDay * $this->numDaysYear / 1000;

        if ($usrDiscargePerYear == $avgDischargeYear || $usrDiscargePerYear > $avgDischargeYear) {
            $work = false;
        } else if ($usrDiscargePerYear < $avgDischargeYear) {
            $work = true;
        }

        $calculations = [
            'avgDischargeYear' => $avgDischargeYear,
            'avgDischargeMin' => $avgDischargeMin,
            'usrDailyMin' => $usrDailyMin,
            'usrWeeklyMin' => $usrWeeklyMin,
            'usrDischargePerDay' => $usrDischargePerDay,
            'usrDischargePerYear' => $usrDiscargePerYear,
            'usrBelowAverage' => $work
        ];

        return $calculations;
    }

    private function vehicle($input) {
        
        $resultFromDB = Data::where('data_name', '=', $input['type'])->first();
        
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

}
