<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getUser(Request $request)
    {
        if ($request->deleted){
            $data = User::where('user_type_id', "=" ,1)->get();
        }else{
            $data = User::where('user_type_id', "=" ,1)->where('deleted_at','=',NULL)->get();
        }


        if (!$data) {
            return $this->responseError("Failed get data", "Something went wrong");
        }
        return $this->responseSuccess("Succesfully get data", $data);
    }

    public function loginUser(Request $request)
    {
        if(!Auth::attempt($request->only('email','password'))) {
            return $this->responseError("Invalid credentials", "");
        }

        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;

        $data['email'] = $request->email;
        $data['token'] = $token;

        return $this->responseSuccess("Succesfully Login User", $data);
    }

    public function createUser(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
            'user_type_id' => 'required',
        ]);

        if ($validate->fails()) {
            return $this->responseError("Data not valid", $validate->errors()->first());
        }

        $req = $request->all();
        $user = new User();

        foreach ($req as $key => $values) {
            $user[$key] = $values;

            if ($key == 'password') {
                $user[$key] = bcrypt($req['password']);
            }
        }
        $user['created_at'] = $this->datetimeNow();

        if ($user->save()) {
            $data = User::where('id', $user['id'])->get();
            return $this->responseSuccess('Success Create Customer', $data);
        } else {
            return $this->responseError('Failed Create Customer', 'Failed Create Message');
        }
    }

    public function updateUser(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'user_type_id' => 'required',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            return $this->responseError("Data not valid", $validate->errors()->first());
        }

        $update = User::where('id', $id)->update([
            'password' => bcrypt($request->password),
            'updated_at' => $this->datetimeNow()
        ]);
        if ($update) {
            $data = User::where('id', $id)->get();
            return $this->responseSuccess('Success update user', $data);
        } else {
            return $this->responseError('Failed update user', 'Nothing to update');
        }
    }

    public function deleteUser($id)
    {
        $delete = User::where('id', $id)->update([
            'deleted_at' => $this->datetimeNow()
        ]);
        if ($delete) {
            return $this->responseSuccess("Success delete user", "");
        } else {
            return $this->responseError("Failed delete user", "");
        }
    }
}
