<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Datatables;
use Validator;

class CategoryManagerController extends Controller
{
        public function __construct()
    {
        $this->middleware('admin.auth');
    }
    
    public function index()
    {   
        return view('management.Category');
    }
    function getdata()
    {
       $categories = Category::select('id', 'name', 'slug','description');
       return Datatables::of($categories)
       ->addColumn('action', function($categories){
        return '<a class="btn btn-warning btn-edit" data-id="'.$categories->id.'"​><i class="fa fa-pencil" aria-hidden="true"></i></a>
        <button type="button" class="btn btn-info btn-show" data-id="'.$categories->id.'"​><i class="fa fa-eye" aria-hidden="true"></i></button>
        <button class="btn btn-danger btn-delete" data-id="'.$categories->id.'"​><i class="fa fa-times" aria-hidden="true"></i></button>';
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
            'name' => 'required|unique:categories',
            'description' => 'required',
        ],$messages);
        $errors = array();
        $success = '';
        if($validator->fails()){
            foreach ($validator->messages()->getMessages() as $value => $messages) {
                $errors[] = $messages;
            }
            return response()->json(['errors'=>$errors]);
        }else{
            $cate = new Category;
            $cate->name = $request->name;
            $cate->slug = $request->slug;
            $cate->description = $request->description;
            $cate->save();
            return response()->json($cate);
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
        $cate = Category::find($id);
        $output = array(
            'name'    =>  $cate->name,
            'slug'     =>  $cate->slug,
            'description'     =>  $cate->description,
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
        $cate = Category::find($id);
        $output = array(
            'id' => $cate->id,
            'name'    =>  $cate->name,
            'slug'     =>  $cate->slug,
            'description'     =>  $cate->description,
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
            'name' => 'required|unique:categories,name,'.$request->id,
            'description' => 'required',
        ],$messages);
        $errors = array();
        if ($validator->fails()) {
            foreach ($validator->messages()->getMessages() as $value => $messages) {
                $errors[] = $messages;
            }
            return response()->json(['errors'=>$errors]);
        }else{
            $cate = Category::find($id);
            $cate->name = $request->name;
            $cate->slug = $request->slug;
            $cate->description = $request->description;
            $cate->save();
            return response()->json(['data'=>$cate],200);
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
        $cate = Category::find($request->input('id'));
        if($cate->delete())
        {
            echo 'Data Deleted';
        }
    }
}
