<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function createReport(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'sender_id' => 'required',
            'destination_id' => 'required',
            'report_message' => 'required',
        ]);

        $getDestinationType = DB::table('users')->select('deleted_at')->where('id',$request->destination_id)->get();

        if ($getDestinationType[0]->deleted_at != null){
            return $this->responseError("User not available", "");
        }

        if ($validate->fails()) {
            return $this->responseError("Data not valid", $validate->errors()->first());
        }

        $req = $request->all();
        $report = new Report();

        foreach ($req as $key => $values) {
            $report[$key] = $values;
        }
        $report['created_at'] = $this->datetimeNow();

        if ($report->save()) {
            $data = Report::where('id', $report['id'])->get();
            return $this->responseSuccess('Success Create Report', $data);
        } else {
            return $this->responseError('Failed Create Report', 'Failed Create Report');
        }
    }

    public function getReport()
    {
        $data = Report::get();

        if (!$data) {
            return $this->responseError("Failed get data", "Something went wrong");
        }
        return $this->responseSuccess("Succesfully get data", $data);
    }
}
