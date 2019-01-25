<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use Datatables;
use Validator;

class UserManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth');
    }
    
    public function index()
    {   
        return view('management.listUser');
    }
    function getdata()
    {
       $users = User::select('id', 'name', 'username','email');
       return Datatables::of($users)
       ->addColumn('action', function($user){
        return '<a class="btn btn-warning btn-edit" data-id="'.$user->id.'"​><i class="fa fa-pencil" aria-hidden="true"></i></a>
        <button type="button" class="btn btn-info btn-show" data-id="'.$user->id.'"​><i class="fa fa-eye" aria-hidden="true"></i></button>
        <button class="btn btn-danger btn-delete" data-id="'.$user->id.'"​><i class="fa fa-times" aria-hidden="true"></i></button>';
    })->make(true);
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
    public function show(Request $request)
    {
        $id = $request->input('id');
        $user = User::find($id);
        $output = array(
            'name'    =>  $user->name,
            'username'     =>  $user->username,
            'email'     =>  $user->email,
        );
        echo json_encode($output);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->input('id');
        $user = User::find($id);
        $output = array(
            'id' => $user->id,
            'name'    =>  $user->name,
            'username'     =>  $user->username,
            'email'     =>  $user->email,
            'description'     =>  $user->description,
        );
        echo json_encode($output);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $messages = [
            'required' => 'Trường :attribute bắt buộc nhập.',
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$request->id,
            'email' => 'required|email|unique:users,email,'.$request->id,
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
    public function destroy(Request $request)
    {
        $user = User::find($request->input('id'));
        if($user->delete())
        {
            echo 'Data Deleted';
        }
    }
}
