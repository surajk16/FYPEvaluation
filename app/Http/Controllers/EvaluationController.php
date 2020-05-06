<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Evaluation;
use App\Models\Anchors;
use App\Models\InputData;

use App\Http\Controllers\Controller;
use Sangria\JSONResponse;
use Log;
use Validator;

class EvaluationController extends Controller {

    public static function saveEvaluation(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                "index" => 'required|integer',
                "without_anchor" => 'required|integer',
                "with_anchor" => 'required|integer',
                "actual_label" => 'required|string',
                "predicted_label" => 'required|string',
            ]);

            if ($validator->fails()) {
                $response = $validator->errors()->all();
                Log::warning($response);
                return JSONResponse::response(400, $response);
            }

            $index = $request->input('index');
            $actual_label = $request->input('actual_label');
            $predicted_label = $request->input('predicted_label');
            $without_anchor = $request->input('without_anchor');
            $with_anchor = $request->input('with_anchor');
            $anchors = $request->input('anchors');
            $input_data = $request->input('input_data');

            $eval = Evaluation::where('idx', '=', $index)->first();
            if ($eval == null) {
                $eval = new Evaluation;
                $eval->idx = $index;
                $eval->actual_label = $actual_label;
                $eval->predicted_label = $predicted_label;
                $eval->without_anchor = $without_anchor;
                $eval->with_anchor = $with_anchor;
                $eval->total_tries = 1;

                $eval->save();


                $ip_data = new InputData;
                $ip_data->idx =             $index;
                $ip_data->occupation =      $input_data['Occupation'];
                $ip_data->race =            $input_data['Race'];
                $ip_data->capital_gain =    $input_data['Capital Gain'];
                $ip_data->education =       $input_data['Education'];
                $ip_data->country =         $input_data['Country'];
                $ip_data->hours_per_week =  $input_data['Hours per week'];
                $ip_data->relationship =   $input_data['Relationship'];
                $ip_data->marital_status =  $input_data['Marital Status'];
                $ip_data->sex =             $input_data['Sex'];
                $ip_data->capital_loss =    $input_data['Capital Loss'];
                $ip_data->workclass =       $input_data['Workclass'];
                $ip_data->age =             $input_data['Age'];

                $ip_data->save();

                $anchor_string = '';
                foreach($anchors as $key => $val) {
                    if ($key == 0) {
                        $anchor_string = $anchor_string.$val;
                    } else {
                        $anchor_string = $anchor_string." AND ".$val;
                    }
                }
                
                $anchor = new Anchors;
                $anchor->idx = $index;
                $anchor->anchors = $anchor_string;

                $anchor->save();
            
            } else {
                $eval->without_anchor = $eval->without_anchor + $without_anchor;
                $eval->with_anchor = $eval->with_anchor + $with_anchor;
                $eval->total_tries = $eval->total_tries + 1;

                $eval->save();
            }

            $status_code = 200;
            $response    = "Saved response successfully!";
            Log::info($response);
            return JSONResponse::response($status_code, $response);

        } catch (Exception $e) {
            $status_code = 500;
            $response    = $e->getMessage()." ".$e->getLine();
            Log::error($response);
            return JSONResponse::response($status_code, $response);
        }
    }
}