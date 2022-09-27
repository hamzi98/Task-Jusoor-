@extends('layouts.app')
@section('content')
<link href="{{ asset('css/show.css') }}" rel="stylesheet">

<div class="container" style="margin-top: 50px">
<h3 style="text-align: center">Quizzes</h3>


<div class="box">
    <div class="container">
     	<div class="row">
       
            @forelse ($quiz as $item)

				 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<div class="box-part text-center">
                        <div class="title"><h4> Title : {{ $item->title }}</h4></div>
                        <div class="text">
                            <p>Description : {{  $item->description }}</p>
                            <p>Period : {{  $item->period }}</p>

                        </div>
						<a href="show/question/{{  $item->id }}">Go to the Questions </a>
					 </div>
				</div>
                @empty
                <div class="container" style="margin-top: 50px">
                    <h3 style="text-align: center;color:red">Empty</h3>
                </div>
                @endforelse
		</div>		
    </div>
</div>

</div>


@endsection
