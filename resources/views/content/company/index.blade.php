@extends('layouts.home')

@section('content')

	<table class="table table-responsive-md">
	  <thead>
		<tr>
		  <th scope="col">No</th>
		  <th scope="col">Logo</th>
		  <th scope="col">Name</th>
		  <th scope="col">Email</th>
		  <th scope="col">Link</th>
		  <th scope="col">Action</th>
		</tr>
	  </thead>
	  <tbody>
	    <?php $i = ($data->currentpage()-1)* $data->perpage() + 1;?>
			@foreach($data as $datas)
			<tr>
			  <th scope="row"><a href="{{ route('Company.show', $datas->id) }}" class="text-dark text-decoration-none">{{ $i }}</a></th>
			  <td>
				<center>
					<a href="{{ route('Company.show', $datas->id) }}">
						@if($datas->logo == null)
							<h1><i class="text-danger fas fa-times-circle"></i></h1>
						@else
							<?php 
								$logopath = str_replace('public/', '', $datas->logo);
								$path = Storage::url($logopath); 
							?>
							<image src="{{ url($path) }}" height="100px" width="100px">
						@endif
					</a>
				</center>
			</td>
			  <td><a href="{{ route('Company.show', $datas->id) }}">{{ $datas->name }}</a></td>
			  <td><a href="{{ route('Company.show', $datas->id) }}">{{ $datas->email }}</a></td>
			  <td><a href="{{ route('Company.show', $datas->id) }}">{{ $datas->website }}</a></td>
			  <td>
				<div class="d-flex justify-content-between w-auto">
					<div>
						<a class="btn btn-sm btn-warning" href="{{ route('Company.edit', $datas->id) }}">Edit</a>
					</div>
					<div>
						<a class="btn btn-sm btn-info" href="{{ route('Company.show', $datas->id) }}">Detail</a>
					</div>
					<div>
						<a class="btn btn-sm btn-danger" href="{{ route('Company.destroy', $datas->id) }}">Delete</a>
					</div>
				</div>
			  </td>
			</tr>
			@endforeach
	  </tbody>
	</table>
	<hr>
	<div>
		<div class="d-flex justify-content-between">
			<div>
				Total data : {{ count($data) }}
			</div>
			<div>
				{{ $data->links() }}
			</div>
		</div>
	</div>

@endsection

@push('javascript')



@endpush

@push('title') Company Data @endpush

@push('button') <a class="btn btn-sm btn-primary" href="{{ route('Company.create') }}">Create new data</a> @endpush