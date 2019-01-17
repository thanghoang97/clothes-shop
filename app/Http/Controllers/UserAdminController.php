<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\User;
use Datatables;
class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {   
        $i=1;
        return view('management.listUser',compact('i'));
    }

    public function getdata(){
        // dd('test');
        // $users = User::select(['id', 'name', 'email'])->get();
        // dd($users);
        // return Datatables::of($users)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $messages = [
            'required' => 'Trường :attribute bắt buộc nhập.',
            'email' => 'Trường :attribute bắt buộc nhập email.',
            'confirmed' => 'Hai trường mật khẩu đã nhập không giống nhau.',
            'min' => ':attribute Không được nhỏ hơn :min',
        ];
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:5',
            'username' => 'required|unique:users|min:5',
            'email' => 'required|email|unique:users|min:6',
            'password' => 'required|confirmed|min:6',
        ],$messages);
        $errors = array();
        $success = '';
        if($validator->fails()){
            foreach ($validator->messages()->getMessages() as $value => $messages) {
                $errors[] = $messages;
            }
            return response()->json(['errors'=>$errors]);
        }else{
            $user = new User;
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            return response()->json($user);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return response()->json(['data' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json(['data'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => 'Trường :attribute bắt buộc nhập.',
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required_with:password|confirmed',
        ],$messages);
        $errors = array();
        if ($validator->fails()) {
            foreach ($validator->messages()->getMessages() as $value => $messages) {
                $errors[] = $messages;
            }
            return response()->json(['errors'=>$errors]);
        }else{
            $user = User::find($id);
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            if(isset($request->password)){
                $user->password = bcrypt($request->password);
            }
            $user->save();
            return response()->json(['data'=>$user],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();
        return response()->json(['data'=>'removed']);
    }
}
