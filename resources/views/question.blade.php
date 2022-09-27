@extends('layouts.app')
@section('content')
    
<div class="container" style="margin-top: 50px">
       <h3 style="text-align: center">Mannage Question</h3><br>

{{-- Table Quiz Data   --}}
<table class="table table-hover table-fixed" style="margin: 30px">
        <thead>
            <tr>
              <th>Quiz Title </th>
              <th>Description</th>
              <th>Period</th>
            </tr>
          </thead>
          <tr>
            <td>{{ $id->title }}</td>
            <td>{{ $id->description }}</td>
            <td>{{ $id->period }}</td>
          </tr>
</table>        



{{-- Table Mannage  Question   --}}
<table id="tableQuestion" class="table">
      <div class="pull-right">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddQuestion">Create New Question</button>

    </div>
        <thead class="thead-dark">
          <tr>
            <th scope="col">Question</th>
            <th scope="col">Answer1</th>
            <th scope="col">Answer2</th>
            <th scope="col">Answer3</th>
            <th scope="col">Answer4</th>
            <th scope="col">Correct</th>
            <th scope="col">Tools</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($id->question as $item)

            <tr>
                <td>{{$item->question}}</td>
                <td>{{$item->answer->answer1}}</td>
                <td>{{$item->answer->answer2}}</td>
                <td>{{$item->answer->answer3}}</td>
                <td>{{$item->answer->answer4}}</td>
                <td>{{$item->answer->correct}}</td>
                <td><a href='javascript:void(0)'  onclick='DeleteQuestion({{$item->id}})' id='borrar_{{$item->id}}' name='borrar_{{$item->id}}' class='btn btn-danger'>Delete</a></td>
            </tr>
            @endforeach
        </tbody>
</table>

    </div>
    

{{-- modal Add Question   --}}
<div class="modal fade" id="AddQuestion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add New Question</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form id="AddNewQuestions" class="form-control" >
                @csrf
                    <input type="hidden" name="id" id="id" value="{{$id->id}}">

                   <textarea class="form-control" name="question" id="question"  placeholder="question"></textarea>
                   <span class="text-danger error-text question_err"></span>
                    <br>
                   <input class="form-control" type="text" id="answer1" name="answer1" placeholder="answer 1">
                   <input type="checkbox" class="CheckboxCorrect"  id="correct" name="correct" value="1">correct answer
                   <span class="text-danger error-text answer1_err"></span>

                   <input class="form-control" type="text" id="answer2" name="answer2" placeholder="answer 2">
                   <input type="checkbox" class="CheckboxCorrect"  id="correct" name="correct" value="2">correct answer
                   <span class="text-danger error-text answer2_err"></span>

                   <input class="form-control" type="text" id="answer3" name="answer3" placeholder="answer 3">
                   <input type="checkbox" class="CheckboxCorrect"  id="correct" name="correct" value="3">correct answer
                   <span class="text-danger error-text answer3_err"></span>

                   <input class="form-control" type="text" id="answer4" name="answer4" placeholder="answer 4">
                   <input type="checkbox" class="CheckboxCorrect" id="correct" name="correct" value="4">correct answer
                   <span class="text-danger error-text answer4_err"></span>

                    <br>
                    <span class="text-danger error-text correct_err"></span>

                    <br>
                   <button type="submit" class="btn btn-success ">Save</button>
                   <div class="form-result"></div>
              </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>


<script src="{{ asset('js/question.js') }}" defer></script>

@endsection