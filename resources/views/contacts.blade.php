@extends('layouts.app') @section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<a href="{{ route( 'home') }}"> {{ __('All Contacts') }} </a> <a
						href="{{ route( 'userContacts') }}"> {{ __('My Contacts') }} </a>
				</div>
				<div class="card-body">
					@if (session('status'))
					<div class="alert alert-success" role="alert">{{ session('status')
						}}</div>
					@endif @include('includes.error') @include('includes.success')
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Name</th>
								<th scope="col"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($contacts as $contact)
							<tr>
								<th scope="row">{{ $contact->id }}</th>
								<td>{{ $contact->name }}</td>
								<td data-th="contact_remove">
									<form action="{{ route( 'removeContact', $contact->id ) }}"
										method="POST">
										@csrf {{ method_field('DELETE') }}
										<button type="submit" class="btn btn-danger"
											onclick="return confirm('Are you sure?')">Remove</button>
									</form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
