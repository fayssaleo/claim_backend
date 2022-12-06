<?php

namespace App\Modules\Estimate\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Modules\Estimate\Models\Estimate;
use \stdClass;
use App\Libs\UploadTrait;
use App\Modules\Estimate\Models\fileEstimates;

class EstimateController extends Controller
{

    use UploadTrait;


    public function index(){
        $estimtesWithAmount=collect ([]);
        $estimate=Estimate::all();
         for ($i=0; $i < count($estimate); $i++) {
            $EstimateModel = new stdClass();


            $EstimateModel->estimate=$estimate[$i];
            $EstimateModel->estimate_amount = $estimate[$i]->equipment_purchase_costs+$estimate[$i]->installation_and_facilities_costs+$estimate[$i]->rransportation_costs;


            //array_push($estimtesWithAmount,$EstimateModel);
            $estimtesWithAmount->push($EstimateModel);
        }
        return [
            "payload" => $estimtesWithAmount,
            "status" => "200_00"
        ];
    }

    public function get($id){
        $estimate=Estimate::find($id);
        if(!$estimate){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            return [
                "payload" => $estimate,
                "status" => "200_1"
            ];
        }
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [

        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $estimate=Estimate::make($request->all());
        $estimate->save();

        $EstimateModel = new stdClass();


        $EstimateModel->estimate=$estimate;
        $EstimateModel->estimate_amount = $estimate->equipment_purchase_costs+$estimate->installation_and_facilities_costs+$estimate->rransportation_costs;

      //  dd($EstimateModel);

        return [
            "payload" => $EstimateModel,
            "status" => "200"
        ];
    }

    public function Addfile(Request $request){

        $estimate=Estimate::find($request->estimate_id);
        if(!$estimate){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }

        if($request->file()) {
            $file=$request->file;
            $filename=time()."_".$file->getClientOriginalName();
            $this->uploadOne($file, config('cdn.fileEstimates.path'),$filename,'public_uploads_fileEstimates');
            $fileEstimates=new fileEstimates();
            $fileEstimates->filename=$filename;
            $fileEstimates->estimate_id=$request->estimate_id;
            $fileEstimates->save();
        }

    }

    public function sendEstimateFileStoragePath(){
        return [
            "payload" => asset("/storage/cdn/fileEstimates/"),
            "status" => "200_1"
        ];
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            "id" => "required",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $estimate=Estimate::find($request->id);
        if (!$estimate) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }

        $estimate->temporary_or_permanent=$request->temporary_or_permanent;
        $estimate->equipment_purchase_costs=$request->equipment_purchase_costs;
        $estimate->installation_and_facilities_costs=$request->installation_and_facilities_costs;
        $estimate->rransportation_costs=$request->rransportation_costs;
        $estimate->currency_estimate=$request->currency_estimate;
        $estimate->equipment_id=$request->equipment_id;


        $estimate->save();
        return [
            "payload" => $estimate,
            "status" => "200"
        ];
    }

    public function delete(Request $request){
        $estimate=Estimate::find($request->id);
        if(!$estimate){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        }
        else {
            $estimate->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];
        }
    }
}
