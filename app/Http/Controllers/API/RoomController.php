<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use App\Room; 
use App\Chat; 
use Illuminate\Support\Facades\Auth; 
use Validator;
class RoomController extends Controller 
{
public $successStatus = 200;

/** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function createroom() 
    { 
        if(Auth::user()->status == 'Owner'){ 
            $validator = Validator::make($request->all(), [ 
                'name' => 'required', 
                'city' => 'required', 
                'price' => 'required',  
            ]);

            $input = $request->all();
            Room::create($input);
            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        }
    } 

     public function searchroom() 
    { 
        if(Auth::user()->status == 'User' || Auth::user()->status == 'Owner'){ 
            
            $validator = Validator::make($request->all(), [ 
                'specific' => 'required',
            ]);

            if($request->input('specific') == 'name'){
                $key = $request->input('name');
                $room = Room::Where('name', 'like', '%' . $key . '%')->get();
            }
            elseif($request->input('specific') == 'city'){
                $key = $request->input('city');
                $room = Room::Where('city', 'like', '%' . $key . '%')->get();
            }
            elseif($request->input('specific') == 'price'){
                $max_price = 0;
                $min_price = 0;
                if(isset($request->input('min'))){
                    $min_price = $request->input('min');
                }
                if(isset($request->input('max'))){
                    $max_price = $request->input('max');
                }
                $room = Room::whereBetween('price', [$min_price, $max_price])->get();
            }
            else($request->input('specific') == 'name'){
                $key = $request->input('name');
                $room = Room::Where('name', 'like', '%' . $key . '%')->get();
            }

             
            return response()->json(['success' => $room], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        }
    } 

    public function chatroom() 
    { 
        if(Auth::user()->status == 'User'){ 
            $validator = Validator::make($request->all(), [ 
                'room_id' => 'required', 
                'chat' => 'required', 
            ]);
            $credit = Auth::user()->credit - 50;
            $obj_user = User::find($user_id);
            $obj_user->password = $credit;
            $obj_user->save(); 

            $input = $request->all();
            Room::create($input);
            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        }
    } 


}