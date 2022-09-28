<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Admin;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{


    public function __construct()
    {
       $this->middleware(['auth:api'], ['except' => ['login','index','register','register_admin']]);
    }



    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
   
   
        $validate=Validator::make($request->only('username','password'),[
            'username'=>'bail|required|string|min:3|max:15|alpha',
            'password'=>'bail|required|min:8|',],);
            
            if($validate->fails())
            return response()->json(['error'=>$validate->errors()]);


        $credentials = request(['username', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    
    }
    public function register_admin()
    {
        return view('register');
    }
    
    public function register (Request $request)
    {
   
        $validate=Validator::make($request->only('username','password','password_confirmation'),[
            'username'=>'bail|required|string|min:3|max:15|alpha|unique:admins,username',
            'password'=>'bail|required|min:8|confirmed',],);
            
            if($validate->fails())
            return response()->json(['error'=>$validate->errors()]);
            
            $admin=Admin::Create([
                'username'=>$request->username,
                'password'=>Hash::make($request->password),
            ]);

        $token=auth('admin')->login($admin);

        return $this->respondWithToken($token);
    
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }


    
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');

    }

 

    //  Quiz

     public function quiz()
    {
        return view('manage');
    }

    public function fetch_quiz()
    {
        $quiz=Quiz::all();
        return response()->json(['quiz'=>$quiz]);
    }

    public function fetch_quiz_id($id)
    {
        $quiz=Quiz::FindOrFail($id);
        return response()->json(['quiz'=>$quiz]);
    }

    public function storeQuiz(Request $request)
    {
        $validate=Validator::make($request->only('title','description','period'),[
            'title'=>'bail|required|string|max:255|unique:quizzes,title',
            'description'=>'bail|required|string|max:255|',
            'period'=>'bail|required|integer|max:10|',
        ]);

        if($validate->fails())
        return response()->json(['error'=>$validate->errors()]);

        $q=Quiz::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'period'=>$request->period,
            ]);
            return response()->json(['id'=>$q->id]);
    }

    public function updateQuiz(Request $request)
    {
        $validate=Validator::make($request->only('title','description','period','id'),[
            'title'=>'bail|required|string|max:255|',
            'description'=>'bail|required|string|max:255|',
            'period'=>'bail|required|integer|max:10|',
        ]);

        if($validate->fails())
        return response()->json(['error'=>$validate->errors()]);

        $quiz=Quiz::findOrFail($request->id);

        if ($quiz) {
        Quiz::where('id',$request->id)->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'period'=>$request->period,
            ]);}
    }

    public function destroyQuiz($id)
    {
        Quiz::find($id)->delete($id);
    }

    //End Quiz


    //Question

    public function fetch_question($id)
    {
        $id=Quiz::FindOrFail($id);
        return view('question',compact('id'));
    } 

    public function storeQuestion(Request $request)
    {
        
        $message=['correct.required'=>"choose the correct answer",];

        $validate=Validator::make($request->only('question','answer1','answer2','answer3','answer4','correct','id'),[
            'question'=>'bail|required|string|max:255|',
            'answer1'=>'bail|required|string|max:255|',
            'answer2'=>'bail|required|string|max:255|',
            'answer3'=>'bail|required|string|max:255|',
            'answer4'=>'bail|required|string|max:255|',
            'correct'=>'bail|required|in:1,2,3,4|',
        ],$message);

        if($validate->fails())
        return response()->json(['error'=>$validate->errors()]);

        $q= Question::create(['question'=>$request->question,'quizze_id'=>$request->id,]);

        Answer::create([
            'answer1'=>$request->answer1,
            'answer2'=>$request->answer2,
            'answer3'=>$request->answer3,
            'answer4'=>$request->answer4,
            'correct'=>'answer'.$request->correct,
            'question_id'=>$q->id,
        ]);
        return response()->json(['id'=>$q->id]);
 
    }


    public function destroyQuestion($id)
    {
        Question::find($id)->delete($id);
    }


    //End Question


  
}
