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
        if($request->meat != false){
            $data= Data::where('data_name', '=', 'flesheaters')->first();
            $flesheaters = $this->flesheaters($data, $request->meat);
        } else {
            $flesheaters = false;
        }

        // Calculate car answer
        if($request->car != false){
            $data = Data::where('data_name', '=', $request->car['type'])->first();
            $car = $this->vehicle($data, $request->car);
        } else {
            $car = false;
        }

        //Calculate shower answer
        $data = Data::where('data_name', '=', 'shower')->first();
        
        $shower = $this->shower($data, $request->shower);

        //Calculate smoke answer
        if($request->smoke != false){
            $data= Data::where('data_name', '=', 'smoking')->first();
            $smoking = $this->smoking($data, $request->smoke);
        } else {
            $smoking = false;
        }

        $data = [
            'car' => $car,
            'shower' => $shower,
            'meat' => $flesheaters,
            'smoking' => $smoking
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
        } else if ($resultFromDB->id == 7){
            return $this->smoking($resultFromDB, $input);
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
        $usrDischargePerYear = ($usrDischargePerDay * $numDaysWeek * $this->numWeeksYear) / 1000;

        if ($usrDischargePerYear == $avgDischargeYear || $usrDischargePerYear > $avgDischargeYear) {
            $work = false;
        } else if ($usrDischargePerYear < $avgDischargeYear) {
            $work = true;
        }

        $calculations = [
            //Average
            'avgDischargeYear' => $avgDischargeYear,
            'avgDischargeMin' => $avgDischargeMin,
            //Topic specific
            'usrDailyMin' => $usrDailyMin,
            'usrWeeklyMin' => $usrWeeklyMin,
            //Global discharge
            'usrDischargePerDay' => $usrDischargePerDay, //In G
            'usrDischargePerYear' => $usrDischargePerYear, //In KG
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
        $usrDischargePerDay = $usrWeeklyDischarge / 7;

        $usrAnnualDischarge = $usrWeeklyDischarge * $this->numWeeksYear / 1000;

        if ($usrAnnualDischarge == $avgDischargeYear || $usrAnnualDischarge > $avgDischargeYear) {
            $work = false;
        } else if ($usrAnnualDischarge < $avgDischargeYear) {
            $work = true;
        }

        $calculations = [
            //Average
            'avgDischargeYear' => $avgDischargeYear,
            'avgDischargeKM' => $avgDischargeKm,
            //Topic specific
            'usrWeeklyKM' => $numKMWeek,
            //Global discharge
            'usrDischargePerDay' => $usrDischargePerDay, //In G
            'usrDischargePerWeek' => $usrWeeklyDischarge, // In G
            'usrDischargePerYear' => $usrAnnualDischarge, //In KG
            'usrBelowAverage' => $work
        ];

        return $calculations;

    }

    private function flesheaters($resultFromDB, $input){
        $work = true;

        // Average discharge per 1KG of meat in grams.
        $avgDischargePerKG = $resultFromDB->co2_by_unit;
        $avgDischargePerYear = $resultFromDB->co2_year_average;

        $usrNumDaysPerWeek = $input;

        // On average a daily meal consists of 100 grams of meat.
        $usrWeeklyAmountOfFlesh = $usrNumDaysPerWeek * 100;

        // We divide the discharge per kilo by 1000 to calculate the discharge per gram and then multiply by users weekly amount of meat in grams.
        $usrWeeklyDischarge = $avgDischargePerKG / 1000 * $usrWeeklyAmountOfFlesh;

        $usrYearlyDischarge = $usrWeeklyDischarge * $this->numWeeksYear / 1000;

        if ($usrYearlyDischarge == $avgDischargePerYear || $usrYearlyDischarge > $avgDischargePerYear) {
            $work = false;
        } else if ($usrYearlyDischarge < $avgDischargePerYear) {
            $work = true;
        }

        $calculations = [
            //Average
            'avgDischargeYear' => $avgDischargePerYear,
            'avgDischargePerKG' => $avgDischargePerKG,
            //Topic specific
            'usrWeeklyMeat' => $usrWeeklyAmountOfFlesh,
            //Global discharge
            'usrDischargePerWeek' => $usrWeeklyDischarge, // In G
            'usrDischargePerYear' => $usrYearlyDischarge, // In KG
            'usrBelowAverage' => $work
        ];

        return $calculations;
    }

    private function smoking($resultFromDB, $input) {
        $work = false;

        // Average discharge results from db
        $avgAnnualDischarge = $resultFromDB->co2_year_average;
        $avgDischargePerPeuk = $resultFromDB->co2_by_unit;

        // Gather user input
        $usrAmountOfCigs = $input;

        $usrDischargePerWeek = $usrAmountOfCigs * $avgDischargePerPeuk;
        $usrAnnualDischarge = $usrDischargePerWeek * $this->numWeeksYear / 1000;

        if ($usrAnnualDischarge == $avgAnnualDischarge || $usrAnnualDischarge > $avgAnnualDischarge) {
            $work = false;
        } else if ($usrAnnualDischarge < $avgAnnualDischarge) {
            $work = true;
        }

        $calculations = [
            //Average
            'avgDischargeYear' => $avgAnnualDischarge,
            'avgDischargeCig' => $avgDischargePerPeuk,
            //Topic specific
            'usrWeeklyCig' => $usrAmountOfCigs,
            //Global discharge
            'usrDischargePerWeek' => $usrDischargePerWeek, // In G
            'usrDischargePerYear' => $usrAnnualDischarge, // In KG
            'usrBelowAverage' => $work
        ];
        return $calculations;
    }

}
