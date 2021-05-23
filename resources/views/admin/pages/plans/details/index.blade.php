@extends('adminlte::page')

@section('title', 'Detalhes do plano')

@section('content_header')
    <h1>Planos <a href="{{route('plans.create')}}" class="btn btn-dark">ADD</a></h1>

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="{{route('plans.index')}}">Planos</a></li>
		<li class="breadcrumb-item"><a href="{{route('plans.show')}}">{{$plan->name}}</a></li>
		<li class="breadcrumb-item"><a href="{{route('details.plans.index', $plan->url)}}">Detalhes</a></li>
	</ol>
@stop

@section('content')
<h1>Detalhes do plano</h1>
   <div class="card">
		<div class="card-header">
		
		</div>
		<div class="card-body">
			<table class="table table-striped">
				<thead>
					<tr>
					<th>Nome</th>					
					<th>Ações</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($details as $detail)
						<tr>
							<td>
								{{$detail->name}}
							</td>
							
							<td>
								<a href="{{ route('plans.edit', $plan->url) }}" class="btn btn-info">Edit</a>
								
								<a href="{{ route('plans.show', $plan->url) }}" class="btn btn-warning">Ver</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
   </div>

   <div class="card-footer">
   @if (isset($searchs))

   	{!! $details->appends($searchs)->links() !!}

   @else
	{!! $details->links() !!}
   @endif
		
   </div>
@stop