<?php

namespace App\Http\Controllers\Api;
use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StudentFormRequest;


class StudentController extends Controller
{
    //student table records
    public function index()
    {    
        $students = Student::all();
        if($students ->count() > 0) {

            return response()->json([
                'status' => 200,
                'message' => $students
            ],200);

        }else{
            
            return response()->json([
                'status' => 404,
                'students' => 'No Recors Found'
            ],404);
        }
    }
    //Create record in database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'course' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:11',
        ]); 

        if($validator->fails()){

            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        }
        else{

            $student = Student::create([

                'name' => $request->name,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone,

            ]);

            if($student){

                return response()->json([
                    'status' => 200,
                    'message' => "Student Created Successfully"
                ],200);
            }
            else{
                    return response()->json([
                        'status' => 500,
                        'message' => "Something went Wrong"
                    ],500);
             }
        }
    }    
    //get records by id
    public function show($id)
    {
        //green Student name is database table name
        $student = Student::find($id);
        if($student){
            return response()->json([
                'status' => 200,
                'student' => $student
            ],200);

        }else{

            return response()->json([
                'status' => 404,
                'message' => "No such student found"
            ],404);
        }
    }
    //get edit one record
    public function edit($id)
    {
        $student = Student::find($id);
        if($student){
            return response()->json([
                'status' => 200,
                'student' => $student
            ],200);

        }else{

            return response()->json([
                'status' => 404,
                'message' => "No such student found"
            ],404);
        }

    }
    //update student record by id
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'course' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:11',
        ]); 

        if($validator->fails()){

            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        }
        else{

            $student = Student::find($id);       

            if($student){

                $student -> update([

                    'name' => $request->name,
                    'course' => $request->course,
                    'email' => $request->email,
                    'phone' => $request->phone,
    
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => "Student updated Successfully"
                ],200);
            }
            else{
                    return response()->json([
                        'status' => 400,
                        'message' => "No such student found!"
                    ],400);
             }
        }

    }
    //Delete records by id
    public function destroy($id)
    {
        $student = Student::find($id);
        if($student)
        {
            $student->delete();
            return response()->json([
                'status' => 200,
                'message' => "Student deleted successfully"
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => "No such Student Found!"
            ], 404);
        }

    }

}
