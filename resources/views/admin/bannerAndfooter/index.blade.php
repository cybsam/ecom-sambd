@extends('layouts/dashboard_master')

@section('header&footer')
active
@endsection
@section('banner')
active
@endsection

@section('content')

<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('/home') }}">Home</a>
        <span class="breadcrumb-item active">Banner</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
		

{{-- delete status --}}
		@if (session('del_com'))
			<div class="col-md-12">
				<div class="alert alert-danger">
					{{ session('del_com') }}
				</div>
			</div>
		@endif
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4>All Banner (Active)</h4>
				</div>
				<div class="card-body">
					<table class="table table-bordered">
						<tr>
							<th>S.N</th>
							<th>Banner Picture</th>
							<th>Alt tag</th>
							<th>Create At</th>
							<th>Last Update</th>
							
							<th>Action</th>
						</tr>
						@forelse ($banners as $banner)
						<tr>
							<td>{{ $loop->index + 1 }}</td>
							<td><img src="{{ asset('uploads/banner_photos') }}/{{ $banner->banner_picture }}" width="50"></td>
							<td>{{ $banner->banner_picture_alt }}</td>
							<td>
								@if ($banner->created_at)
									{{ $banner->created_at->diffForHumans() }}
									@else
									No time available...
								@endif
							</td>
							<td>@if ($banner->updated_at)
								{{ $banner->updated_at->diffForHumans() }}
								@else
								-
							@endif</td>
							
							<td>
								<a href="{{ url('banner/admin/delete') }}/{{ $banner->id }}" class="btn btn-warning btn-sm">Delete</a>
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
					<h4>Add Banner</h4>
				</div>
				<div class="card-body">
					@if(session('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
					@endif
					<form action="{{ url('banner/admin/add') }}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<input type="text" name="banner_alt" class="form-control" placeholder="Banner Alt tag">
						</div>
						@error('banner_alt')
						<span class="text-danger">
							{{ $message }}
						</span>
						@enderror
						<div class="form-group">
							<input type="file" name="banner_photo" class="form-control">
						</div>
						@error('banner_photo')
						<span class="text-danger">
							{{ $message }}
						</span>
						@enderror
						<div class="form-group mt-1">
							<button type="submit" class="btn btn-primary">Add Banner</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection