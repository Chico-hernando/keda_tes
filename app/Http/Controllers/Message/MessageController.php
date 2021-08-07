<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function createMessage(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'sender_id' => 'required',
            'destination_id' => 'required',
            'message' => 'required',
        ]);

        $getSenderType = DB::table('users')->select('user_type_id','deleted_at')->where('id',$request->sender_id)->get();
        $getDestinationType = DB::table('users')->select('user_type_id','deleted_at')->where('id',$request->destination_id)->get();

        if ($getSenderType[0]->user_type_id == 1 && $getDestinationType[0]->user_type_id == 2){
            return $this->responseError("Prohibited", "");
        }

        if ($getDestinationType[0]->deleted_at != null){
            return $this->responseError("User not available", "");
        }

        if ($validate->fails()) {
            return $this->responseError("Data not valid", $validate->errors()->first());
        }

        $req = $request->all();
        $message = new Message();

        foreach ($req as $key => $values) {
            $message[$key] = $values;
        }
        $message['created_at'] = $this->datetimeNow();

        if ($message->save()) {
            $data = Message::where('id', $message['id'])->get();
            return $this->responseSuccess('Success Create Message', $data);
        } else {
            return $this->responseError('Failed Create Message', 'Failed Create Message');
        }
    }

    public function getMessage()
    {
        $data = Message::get();

        if (!$data) {
            return $this->responseError("Failed get data", "Something went wrong");
        }
        return $this->responseSuccess("Succesfully get data", $data);
    }

    public function getMessageByUserId($id)
    {
        $data = Message::where('sender_id','=',$id)->orWhere('destination_id','=',$id)->get();

        if (!$data) {
            return $this->responseError("Failed get data", "Something went wrong");
        }
        return $this->responseSuccess("Succesfully get data", $data);
    }
}
