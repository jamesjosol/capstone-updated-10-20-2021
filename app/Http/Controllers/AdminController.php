<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $totalUsers = User::get()->count();
        $admins = User::where('role', 1)->get()->count();
        $adminsBarWidth = ($admins / $totalUsers) * 100;
        return view('pages.admins.index', compact('admins', 'adminsBarWidth'));
    }

    public function showUsers() {
        $users = User::orderByRaw('lastName,firstName')->get();
        return view('pages.admins.users', compact('users'));
    }

    public function viewUser(User $user) {
        return view('pages.admins.users-detail-view', compact('user'));
    }    

    public function storeUser(Request $request) {
        
        $request->validate([
            'firstName'             => 'required|string',
            'lastName'              => 'required|string',
            'middleName'            => 'required|string',
            'email'                 => 'required|email|unique:users',
            'username'              => 'required|string|unique:users',
            'contactNo'             => 'required|numeric|regex:/(09)[0-9]{9}/',
            'password'              => 'required|string|min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|string|min:8',
        ]);

        $token = Str::random(24);

        $user = User::create([
            'firstName'         => $request->firstName,
            'lastName'          => $request->lastName,
            'middleName'        => $request->middleName,
            'email'             => $request->email,
            'contactNo'         => $request->contactNo,
            'username'          => $request->username,
            'password'          => bcrypt($request->password),
            'role'              => $request->role,
            'remember_token'    => $token,
        ]);

        return redirect()->route('admin.users')->with('Message', 'User has been successfully created.');
        
    }


    public function updateUser(Request $request) {

        
        $request->validate([
            'id'                    => 'required|numeric',
            'firstName'             => 'required|string',
            'lastName'              => 'required|string',
            'middleName'            => 'required|string',
            'email'                 => 'required|email|unique:users,email,'.$request->id,
            'username'              => 'required|string|unique:users,username,'.$request->id,
            'contactNo'             => 'required|numeric|regex:/(09)[0-9]{9}/',
            'role'                  => 'required|numeric',
        ]);
        $user = User::find($request->id);

        if(empty($request->get('password'))) $user->update($request->except('password'));
        else {
            $request->merge([
                'password' => bcrypt($request->password),
            ]);
            $user->update($request->all());
        }
        
    
        return redirect()->route('admin.users')->with('Message', "User [#ID$request->id] has been successfully updated.");
    }

    public function deleteUser(Request $request) {
        $user = User::find($request->id);
        $id = $request->id;
        $user->delete();

        return redirect()->route('admin.users')->with('Message', "User [#ID$id] has been successfully deleted.");
    }

    public function showStudents() {
        $students = Student::orderByRaw('lastName,firstName')->get();
        return view('pages.admins.students', compact('students'));
    }

    public function viewstudent(Student $student) {
        return view('pages.admins.students-detail-view', compact('student'));
    } 

    public function createStudent() {
        return view('pages.admins.student-create');
    }

    public function storeStudent(Request $request) {
        $request->validate([
            'user_id'               => 'required|numeric',
            'profile_pic'                 => 'mimes:jpeg,png,jpg',
            'firstName'             => 'required|string',
            'lastName'              => 'required|string',
            'middleName'            => 'required|string',
            'gender'                 => 'required|string',
            'birthDate'              => 'required|date',
            'birthPlace'             => 'required|string',
            'nationality'             => 'required|string',
            'religion'             => 'required|string',
            'civilStatus'           => 'required|string',
            'fatherName'             => 'required|string',
            'fatherOccup'             => 'required|string',
            'fatherContact'             => 'numeric',
            'motherName'             => 'required|string',
            'motherOccup'             => 'required|string',
            'motherContact'             => 'numeric',
            'guardianName'          => 'string',
            'guardianContact'       => 'numeric',
            'barangay'             => 'required|string',
            'town'             => 'required|string',
            'province'             => 'required|string',
            'grade_LVL'          => 'required|string',
            'elemSchool'             => 'required|string',
            'elemSchlAddr'             => 'required|string',
            'elemYrAttnd'             => 'required|string',
            'secondarySchool'             => 'string',
            'secondarySchlAddr'             => 'string',
            'secondaryYrAttnd'             => 'string',
        ]);

        if(!empty($request->profile_pic)) {
            $user = User::find($request->user_id);
            $imageName = time() . $request->lastName.'.'.$request->profile_pic->extension(); 
    
            $user->profile_pic = $imageName;
            $user->save();
    
            $request->profile_pic->move(public_path('images'), $imageName);
        }
        
        $student = Student::create([
            'user_id'           => $request->user_id,
            'firstName'         => $request->firstName,
            'lastName'          => $request->lastName,
            'middleName'        => $request->middleName,
            'gender'        => $request->gender,
            'birthDate'        => $request->birthDate,
            'birthPlace'        => $request->birthPlace,
            'nationality'        => $request->nationality,
            'religion'        => $request->religion,
            'civilStatus'        => $request->civilStatus, 
            'fatherName'        => $request->fatherName,
            'fatherOccup'        => $request->fatherOccup,
            'fatherContact'        => $request->fatherContact,
            'motherName'        => $request->motherName,
            'motherOccup'        => $request->motherOccup,
            'motherContact'        => $request->motherContact,
            'guardianName'        => $request->guardianName,
            'guardianContact'        => $request->guardianContact,
            'barangay'        => $request->barangay,
            'town'        => $request->town,
            'province'        => $request->province,
            'grade_LVL'        => $request->grade_LVL,
            'elemSchool'        => $request->elemSchool,
            'elemSchlAddr'        => $request->elemSchlAddr,
            'elemYrAttnd'        => $request->elemYrAttnd,
            'secondarySchool'        => $request->secondarySchool,
            'secondarySchlAddr'        => $request->secondarySchlAddr,
            'secondaryYrAttnd'        => $request->secondaryYrAttnd,
        ]);

        return redirect()->route('admin.students')->with('Message', 'Student has been successfully created.');
    }


    public function editStudent(Student $student) {
        return view('pages.admins.student-edit', compact('student'));
    }

    public function updateStudent(Student $student, Request $request) {
        $request->validate([
            'profile_pic'                 => 'mimes:jpeg,png,jpg',
            'firstName'             => 'required|string',
            'lastName'              => 'required|string',
            'middleName'            => 'required|string',
            'gender'                 => 'required|string',
            'birthDate'              => 'required|date',
            'birthPlace'             => 'required|string',
            'nationality'             => 'required|string',
            'religion'             => 'required|string',
            'civilStatus'           => 'required|string',
            'fatherName'             => 'required|string',
            'fatherOccup'             => 'required|string',
            'fatherContact'             => 'numeric',
            'motherName'             => 'required|string',
            'motherOccup'             => 'required|string',
            'motherContact'             => 'numeric',
            'guardianName'          => 'string',
            'guardianContact'       => 'numeric',
            'barangay'             => 'required|string',
            'town'             => 'required|string',
            'province'             => 'required|string',
            'grade_LVL'          => 'required|string',
            'elemSchool'             => 'required|string',
            'elemSchlAddr'             => 'required|string',
            'elemYrAttnd'             => 'required|string',
            'secondarySchool'             => 'string',
            'secondarySchlAddr'             => 'string',
            'secondaryYrAttnd'             => 'string',
        ]);

        if(!empty($request->profile_pic)) {
            $user = User::find($student->user->id);
            $imageName = time() . $request->lastName.'.'.$request->profile_pic->extension(); 
    
            $user->profile_pic = $imageName;
            $user->save();
    
            $request->profile_pic->move(public_path('images'), $imageName);
        }
        
        $student->update($request->all());

        return redirect()->route('admin.students')->with('Message', "Student [#ID$student->id] has been successfully updated.");
    }


    public function deleteStudent(Request $request) {
        $student = Student::find($request->id);
        $id = $request->id;
        $student->delete();

        return redirect()->route('admin.students')->with('Message', "Student [#ID$id] has been successfully deleted.");
    }
    
}
