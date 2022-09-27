@extends('layouts.app')
@section('content')

<div class="container" style="margin-top: 50px">
    <h3 style="text-align: center">Questions</h3>
    
<input type="hidden" id="t" value="{{ $quiz->period }}">
<table class="table table-hover table-fixed" style="margin: 30px">
        <thead>
            <tr>
              <th>Quiz Title </th>
              <th>Description</th>
              <th>Period</th>
            </tr>
          </thead>
          <tr>
            <td>{{ $quiz->title }}</td>
            <td>{{ $quiz->description }}</td>
            <td>{{ $quiz->period }}</td>
          </tr>
</table>        


<div class="mx-0 mx-sm-auto">
@forelse  ($quiz->question as $Key=>$item)

    <div class="card">
      <div class="card-body">
        <div class="text-center">
          <i class="far fa-file-alt fa-4x mb-3 text-primary"></i>
          <p>({{ ++$Key }}) {{$item->question }} ?</p>
        </div><hr>
  
        <form action="/guest/answer/question/{{ $item->answer->id }}" method="POST" class="px-4">
            @csrf

          <div class="form-check mb-2">
            <input class="form-check-input" type="radio" name="answer{{ $item->answer->id }}" id="answer1" value="1" />
            <label class="form-check-label" for="answer1">{{ $item->answer->answer1 }}</label>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input" type="radio" name="answer{{ $item->answer->id }}" id="answer2" value="2" />
            <label class="form-check-label" for="answer2">{{ $item->answer->answer2 }}</label>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input" type="radio" name="answer{{ $item->answer->id }}" id="answer3" value="3" />
            <label class="form-check-label" for="answer3">{{ $item->answer->answer3 }}</label>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input" type="radio" name="answer{{ $item->answer->id }}" id="answer4"value="4" />
            <label class="form-check-label" for="answer4">{{ $item->answer->answer4 }}</label>
          </div>
          <span class="text-danger error-text answer{{ $item->answer->id }}_err"></span>

          <div class="card-footer text-end">
            <input type="submit" class="submit-form" value="submit" />
        </div>
        </form>
      </div>
    </div>
  </div>
  @empty

    <div class="container" style="margin-top: 50px">
    <h3 style="text-align: center;color:red">Empty</h3>
    </div>
@endforelse 

    </div>



<script src="{{ asset('js/show_question.js') }}" defer></script>


@endsection
