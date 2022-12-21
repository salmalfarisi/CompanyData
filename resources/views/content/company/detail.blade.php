@extends('layouts.home')

@section('content')

	<table class="table table-borderless">
		<tbody>
			<tr>
				<td>Name : {{ $data->name }}</td>
				<td>Email : {{ $data->email }}</td>
				<td>Link : <a href="{{ $data->website }}" target="__blank">{{ Str::limit($data->website, $limit = 30, $end = '...') }}</a></td>
			</tr>
		</tbody>
	</table>

	<table class="table table-responsive-md">
	  <thead>
		<tr>
		  <th scope="col">No</th>
		  <th scope="col">First Name</th>
		  <th scope="col">Last Name</th>
		  <th scope="col">Email</th>
		  <th scope="col">Phone</th>
		  <th scope="col">Action</th>
		</tr>
	  </thead>
	  <tbody>
	    <?php $i = ($employees->currentpage()-1)* $employees->perpage() + 1;?>
			@foreach($employees as $datas)
			<tr>
			  <th scope="row">{{ $i++ }}</th>
			  <td>{{ $datas->firstname }}</td>
			  <td>{{ $datas->lastname }}</td>
			  <td>{{ $datas->email }}</td>
			  <td>{{ $datas->phone }}</td>
			  <td>
				<div class="d-flex justify-content-between w-auto">
					<div>
						<!-- Button trigger modal -->
						<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-firstname="{{ $datas->firstname }}" data-lastname="{{ $datas->lastname }}" data-email="{{ $datas->email }}" data-phone="{{ $datas->phone }}" data-class="modal-content bg-warning" data-UrlAction="{{ route('Employee.update', $datas->id) }}" data-title="Edit data" data-target="#exampleModal">
							Edit
						</button> 
					</div>
					<div>
						<a class="btn btn-sm btn-danger" href="{{ route('Employee.destroy', $datas->id) }}">Delete</a>
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
				Total data : {{ count($employees) }}
			</div>
			<div>
				{{ $employees->links() }}
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="exampleModal">
        <div class="modal-dialog" role="document">
          <div id="change-color" class="modal-content">
            <div class="modal-header">
              <h4 id="modal-title" class="modal-title">Default Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="form-action" action="#" method="post">
			{{ csrf_field() }}
				<div class="modal-body">
					<div class="form-group">
						<label for="formfirstname">First Name</label>
						<input type="text" name="firstname" class="form-control" id="formfirstname">
					</div>
					<input type="hidden" name="company" value="{{ $data->id }}">
					<div class="form-group">
						<label for="formlastname">Last Name</label>
						<input type="text" name="lastname" class="form-control" id="formlastname">
					</div>
					<div class="form-group">
						<label for="formemail">Email</label>
						<input type="email" name="email" class="form-control" id="formemail">
					</div>
					<div class="form-group">
						<label for="formphone">Phone</label>
						<input type="text" name="phone" class="form-control" id="formphone">
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					  <button id="button-submit" type="submit" class="btn btn-default"></button>
				</div>
			</form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@endsection

@push('javascript')

	<script>
		$('#exampleModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var recipient = button.data('whatever') // Extract info from data-* attributes
		  var title = button.data('title') // Extract info from data-* attributes
		  var modalcolor = button.data('class') // Extract info from data-* attributes
		  var urllink = button.data('urlaction') // Extract info from data-* attributes
		  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		  document.getElementById('modal-title').innerHTML = title;
		  document.getElementById("change-color").className = modalcolor;
		  document.getElementById('form-action').action = urllink;
		  if(title == 'Create new Data'){
			  document.getElementById('button-submit').innerHTML = 'Create';
		  }
		  else{
			  var firstname = button.data('firstname');
			  var lastname = button.data('lastname');
			  var email = button.data('email');
			  var phone = button.data('phone');
			  document.getElementById('formfirstname').value = firstname;
			  document.getElementById('formlastname').value = lastname;
			  document.getElementById('formemail').value = email;
			  document.getElementById('formphone').value = phone;
			  document.getElementById('button-submit').innerHTML = 'Update';
		  }
		  /*
			data-class="modal-content bg-primary" 
			data-UrlAction="{{ route('Employee.store') }}" 
			data-title="create"
		  */
		})
	</script>

@endpush

@push('title') Company Data @endpush

@push('button') 

	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-class="modal-content bg-primary" data-UrlAction="{{ route('Employee.store') }}" data-title="Create new Data" data-target="#exampleModal">
		Create new Data
	</button> 
	
@endpush