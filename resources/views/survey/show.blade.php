@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h4>{{ $survey->name }}</h4>
			<p>{{ $survey->description }}</p>
		</div>
		<div class="col-md-6">
			<a href="/survey/{{ $survey->id }}/question" class="btn btn-success pull-right"> Add Question</a>
		</div>
	</div>
</div>
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-sm-8">
					<h4>Survey Statistics.</h4>
					<p>Graph per survey question. The graph height represents the number of people that responded with same answer.</p>
				</div>
				<div class="col-sm-4">
					<a href="/survey/{{ $survey->id }}/respondent-demographic-data" 
						class="btn btn-primary pull-right">
						Respondents Demographic Data
					</a>
				</div>
			</div>
		</div>
    	<div class="panel-body">
			<div class="alert alert-info">
				<span class="text-success">{{ $survey->survey_questions->count() }}</span> questions.
				<span class="text-success">{{ $responses_count }}</span> reponses.
				{{ $respondents_count }} took the survey.
			</div>

			@php
				$charts = [];	
			@endphp

			@foreach($survey->survey_questions as $key=>$question)
				@php
					$charts[$key]=$question->renderChart();
				@endphp
			@endforeach

			@if($charts)
				@foreach($charts as $key=>$chart)
					<hr class="row">
					{!! $charts[$key]->html() !!}
				@endforeach
			@endif

    	</div>
    </div>

</div>
@endsection
@section('scripts')
	@if($charts)
		@foreach($charts as $key=>$chart)
	        {!! $charts[$key]->script() !!}
		@endforeach
	@endif
@endsection
