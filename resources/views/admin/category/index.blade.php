@extends('layouts/dashboard_master')

@section('category')
active
@endsection

@section('content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('/home') }}">Home</a>
        <span class="breadcrumb-item active">Category</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
		{{-- update status --}}
		@if (session('update_status'))
			<div class="col-md-12">
				<div class="alert alert-success">
					{{ session('update_status') }}
				</div>
			</div>
		@endif

{{-- delete status --}}
		@if (session('dlt_com'))
			<div class="col-md-12">
				<div class="alert alert-danger">
					{{ session('dlt_com') }}
				</div>
			</div>
		@endif
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4>All Category (Active)</h4>
				</div>
				<div class="card-body">
					<table class="table table-bordered">
						<tr>
							<th>S.N</th>
							<th>Category Name</th>
							<th>Added By</th>
							<th>Create At</th>
							<th>Last Update</th>
							<th>Category Photo</th>
							<th>Action</th>
						</tr>
						@forelse ($category as $category)
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
						@endforelse
					</table>
				</div>
			</div>
			<div class="card mt-4">
				<div class="card-header bg-danger text-white">
					<h4>Deleted Category</h4>
				</div>
				<div class="card-body">
					<table class="table table-bordered">
						<tr>
							<th>S.N</th>
							<th>Category Name</th>
							<th>Added By</th>
							<th>Create At</th>
							<th>Last Update</th>
							<th>Action</th>
						</tr>
						@forelse ($delete_category as $delete_category)
						<tr>
							<td>{{ $loop->index + 1 }}</td>
							<td>{{ $delete_category->category_name }}</td>
							<td>{{ App\User::find($delete_category->user_id)->name }}</td>
							<td>
								@if ($delete_category->created_at)
									{{ $delete_category->created_at->diffForHumans() }}
									@else
									No time available...
								@endif
							</td>
							<td>@if ($delete_category->updated_at)
								{{ $delete_category->updated_at->diffForHumans() }}
								@else
								-
							@endif</td>
							<td>
								<div class="btn-group" role="group">
									<a href="{{ url('category/restore') }}/{{ $delete_category->id }} " class="btn btn-secondary btn-sm text-white">Restore</a>
									<a href="{{ url('category/hardDelete') }}/{{ $delete_category->id }}" class="btn btn-danger btn-sm text-white">Per Delete</a>
								</div>
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="50" class="text-danger text-center">No data to show</td>
						</tr>
						@endforelse
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4>Add Category</h4>
				</div>
				<div class="card-body">
					@if(session('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
					@endif
					<form action="{{ url('category/add') }}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<input type="text" name="cateName" class="form-control" placeholder="Add Category">
						</div>
						@error('cateName')
						<span class="text-danger">
							{{ $message }}
						</span>
						@enderror
						<div class="form-group">
							<input type="file" name="category_photo" class="form-control">
						</div>
						@error('CategoryPicture')
						<span class="text-danger">
							{{ $message }}
						</span>
						@enderror
						<div class="form-group mt-1">
							<button type="submit" class="btn btn-primary">Add Category</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

