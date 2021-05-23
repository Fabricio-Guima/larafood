@extends('adminlte::page')

@section('title', 'Editar Plano')

@section('content_header')
    <h1>Editar Plano <a href="{{route('plans.index')}}" class="btn btn-dark">Voltar</a></h1>
@stop

@section('content')
<h1>Editar plano</h1>
   <div class="card">
		
		<div class="card-body">
			<form action="{{route('plans.update', $plan->url)}}" class="form" method="post">
				@csrf
				@method('PUT')

				@include('admin.pages.plans._partials.form')

			</form>
			
		</div>
   </div>

   <div class="card-footer">
		
   </div>
@stop