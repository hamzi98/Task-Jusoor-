@extends('layouts.app')
@section('content')

<div class="container" style="margin-top: 50px">
<h3 style="text-align: center">Mannage Quizzes</h3>

{{-- Table Mannage Quizzes   --}}
<table id="tablequiz" class="table">
  <div class="pull-right">
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddQuiz">Create New Quiz</button>

  </div>
    <thead class="thead-dark">
      <tr>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Period</th>
        <th scope="col">Tools</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>


{{-- modal Add Quiz   --}}
<div class="modal fade" id="AddQuiz" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add New Quiz</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form id="AddNewQuiz" class="form-control" >
                @csrf
                   <input class="form-control" type="text" id="title" name="title" placeholder="title">
                   <span class="text-danger error-text title_err"></span>
                   <textarea class="form-control" name="description" id="description"  placeholder="description"></textarea>
                   <span class="text-danger error-text description_err"></span>
                   <input class="form-control" type="text" id="period" name="period" placeholder="period">
                   <span class="text-danger error-text period_err"></span>
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

{{-- modal Edite Quiz   --}}
<div class="modal fade" id="EditeQuiz" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edite Quiz</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
          <form id="editedata"  class="form-control" >
              @csrf
                 <div id="Edite"></div>
            </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/manage.js') }}" defer></script>

@endsection