<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuestController extends Controller
{

    public function index()
    {
        $quiz=Quiz::all();
        return view('show_quiz',compact('quiz'));
    }

    public function question($id)
    {
        $quiz=Quiz::FindOrFail($id);
        return view('show_question',compact('quiz'));
    }


    public function answer(Request $request , $id)
    {
        $message=['required'=>"The answer field is required",];

        $validate=Validator::make($request->only('answer'.$id),[

            'answer'.$id=>[
                'required','in:1,2,3,4', function ($attribute, $value, $fail) use($id) {
                    $Correct=Answer::where('id',$id)->where('correct','answer'.$value)->first();
                    if($Correct)
                    $fail("The answer is correct");
                    else
                    $fail("Wrong answer");
              
                },
             ],
        ],$message);



        if($validate->fails())
        return response()->json(['error'=>$validate->errors()]);

    }


    
}
