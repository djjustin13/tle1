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


        return $request->data + 10;

    }

    public function compare($category, Request $request){

        $result = Data::where('data_name', '=', $category)->get();

        if ($result[0]->id == 1){
            return $this->shower($result, $request);
        } else if ($result[0]->id == 2 || $result[0]->id == 3 || $result[0]->id == 4 || $result[0]->id == 5 || $result[0]->id == 6 || $result[0]->id == 10){
            return $this->vehicle($request);
        }

        return $result;

    }

    /**
     * Private functions declared here.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function shower($result, $request) {

        // Declare some basic variables like year and day.
        $numDaysWeek = $request->days;

        $work = true;

        // Fetch discharge per year from selected category.
        $avgDischargeYear = $result[0]->co2_year_average;
        $avgDischargeMin = $result[0]->co2_by_unit;

        $usrDailyMin = $request->minutes;
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

        return response()->json($calculations);
    }

    private function vehicle(Request $request) {

        $resultFromDB = Data::where('data_name', '=', $request->car)->get();

        $numKMWeek = $request->km;

        $work = true;

        // Fetch discharge per year from selected category.
        $avgDischargeYear = $resultFromDB[0]->co2_year_average;
        $avgDischargeKm = $resultFromDB[0]->co2_by_unit;

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

        return response()->json($calculations);

    }

}
