@extends('layouts/dashboard_master')

@section('active_form')
active
@endsection

@section('contact')
active
@endsection


@section('content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('/home') }}">Home</a>
        <span class="breadcrumb-item active">Contact</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
          <div class="col-sm-12 m-auto">
          	<div class="card">
          		<div class="card-body">
          			@if (session('del_com'))
          				<div class="alert alert-warning text-white">
          					{{ session('del_com') }}
          				</div>
          			@endif
          			<table class="table table-bordered">
          				<thead>
          					<tr>
          						<th>S.N</th>
          						<th>Name</th>
          						<th>Email</th>
          						<th>Subject</th>
          						{{-- <th>Description</th> --}}
          						<th>Message At</th>
          						<th>Action</th>
          					</tr>
          				</thead>
          				<tbody>
          					@forelse ($contact_db as $contact)
          						<tr>
          							<td>{{ $contact_db->firstItem() + $loop->index }}</td>
          							<td>{{ $contact->fname }}</td>
          							<td>{{ $contact->email }}</td>
          							<td>{{ $contact->subject }}</td>
          							<td>
          								@if ($contact->created_at)
          									{{ $contact->created_at->diffForHumans() }}
          									@else
          									No time to show
          								@endif
          							</td>
          							<td>
          								<div class="btn-group" role="group">
          									<a href="{{ url('/contact/admin/view/single') }}/{{ $contact->id }}" class="btn btn-info btn-sm">View</a>
          									<a href="{{ url('/contact/admin/view/delete/soft') }}/{{ $contact->id }}" class="btn btn-warning btn-sm">Delete</a>
          								</div>
          							</td>
          						</tr>
          						@empty
          						<tr>
          							<td colspan="50" class="text-danger text-center">No Data to show</td>
          						</tr>
          					@endforelse
          				</tbody>
          			</table>
          			{{ $contact_db->links() }}
          		</div>
          	</div>
          </div>
      </div>
  </div>
 

@endsection