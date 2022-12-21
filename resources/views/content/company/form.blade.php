@extends('layouts.home')

@section('content')

	<form action="{{ $data->id == null ? route('Company.store') : route('Company.update', $data->id) }}" method="post" enctype='multipart/form-data' >
	  {{ csrf_field() }}
	  <div class="form-group">
		<label>Name</label>
		<input type="text" name="name" value="{{ $data->id == null ? '' : $data->name }}" class="form-control" required>
		<small class="text-danger">@if($errors->has('name')) {{ $errors->first('name') }}@endif</small>
	  </div>
	  <div class="form-group">
		<label>Email</label>
		<input type="email" name="email" value="{{ $data->id == null ? '' : $data->email }}" class="form-control">
		<small class="text-danger">@if($errors->has('email')) {{ $errors->first('email') }}@endif</small>
	  </div>
	  <div class="form-group">
		<label>URL Link</label>
		<input type="text" name="website" value="{{ $data->id == null ? '' : $data->website }}" class="form-control">
		<small class="text-danger">@if($errors->has('website')) {{ $errors->first('website') }}@endif</small>
	  </div>
	  <div class="form-group">
	    <label>Logo (cara store dan liat data di folder storage ???)</label>
		<div class="custom-file">
			<input type="file" class="custom-file-input" name="logo" id="logo">
			<label class="custom-file-label" for="logo">Choose file...</label>
		</div>
		<small class="text-danger">@if($errors->has('logo')) {{ $errors->first('logo') }}@endif</small>
	  </div>
	  <div class="d-flex justify-content-between">
		<div>
		  <a href="{{ route('Company.index') }}" class="btn btn-danger">Back</a>
		</div>
		<div>
		  <button type="submit" class="btn btn-primary">{{ $data->id == null ? 'Save' : 'Update' }}</button>
		</div>
	  </div>
	</form>

@endsection

@push('javascript')

	<script>
		$('#logo').on('change',function(){
			//get the file name
			var fileName = $(this).val();
			//replace the "Choose a file" label
			$(this).next('.custom-file-label').html(fileName);
		})
	</script>

@endpush

@push('title') {{ $data->id == null ? 'Create new data' : 'Edit company data' }} @endpush

@push('button')  @endpush