@extends('layouts.dashboard_master')

@section('copon')
active
@endsection
@section('copon_ad')
active
@endsection


@section('content')

<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('/home') }}">Home</a>
        <span class="breadcrumb-item active">Copon</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
        	<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4>List Copon</h4>
				</div>
				<div class="card-body">
					<table class="table table-bordered">
						<tr>
							<th>S.N</th>
							<th>Copon Name</th>
							
							<th>Create At</th>
							<th>Validity</th>
							
							<th>Action</th>
						</tr>
						{{-- @forelse ($category as $category)
						<tr>
							<td>{{ $loop->index + 1 }}</td>
							<td>{{ $category->category_name }}</td>
							<td>{{ App\User::find($category->user_id)->name }}</td>
							<td>
								@if ($category->created_at)
									{{ $category->created_at->diffForHumans() }}
									@else
									No time available...
								@endif
							</td>
							<td>@if ($category->updated_at)
								{{ $category->updated_at->diffForHumans() }}
								@else
								-
							@endif</td>
							<td><img src=" {{ asset('uploads/category_photos') }}/{{ $category->category_photo }} " width="100" alt="category picture"></td>
							<td>
								<div class="btn-group" role="group">
									<a href="{{ url('category/update') }}/{{ $category->id }} " class="btn btn-success btn-sm text-white">Update</a>
									<a href="{{ url('category/delete') }}/{{ $category->id }}" class="btn btn-warning btn-sm text-white">Delete</a>
								</div>
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="50" class="text-danger text-center">No data to show</td>
						</tr>
						@endforelse --}}
					</table>
				</div>
			</div>
		</div>


			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h4>Add Copon</h4>
					</div>
					<div class="card-body">
						@if(session('success'))
							<div class="alert alert-success">
								{{ session('success') }}
							</div>
						@endif
						<form action="{{ url('/copon/admin/post') }}" method="post" >
							@csrf
							<div class="form-group">
								<label>Copon Name</label>
								<input type="text" name="copon_name" class="form-control">
							</div>
							@error('copon_name')
							<span class="text-danger">
								{{ $message }}
							</span>
							@enderror
							<div class="form-group">
								<label>Discount Ammount %</label>
								<input type="text" name="copon_discount" class="form-control">
							</div>
							@error('copon_discount')
							<span class="text-danger">
								{{ $message }}
							</span>
							@enderror
							<div class="form-group">
								<label>Validity Till</label>
								<input type="date" name="copon_validity" class="form-control">
							</div>
							@error('copon_validity')
							<span class="text-danger">
								{{ $message }}
							</span>
							@enderror
							
							<div class="form-group mt-1">
								<button type="submit" class="btn btn-primary">Add Copon</button>
							</div>
						</form>
					</div>
				</div>
			</div>
        </div>

@endsection