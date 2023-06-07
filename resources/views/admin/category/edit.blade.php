@extends('layouts/dashboard_master')

@section('category')
active
@endsection


@section('content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('/home') }}">Home</a>
        <a class="breadcrumb-item" href="{{ url('/category') }}">Category</a>
        <span class="breadcrumb-item active">{{ $cate_name }}</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
		<div class="col-md-8 m-auto">
			
			<div class="card">
				<div class="card-header">
					<h3>Update Category</h3>
				</div>
				<div class="card-body">
					<form action="{{ url('/category/update/post') }}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<input type="hidden" name="categori_id" value="{{ $categori_id }}">
							<input type="text" name="cateName" class="form-control" value="{{ $cate_name }} ">
						</div>
						<div class="form-group">
							<label>Current Picture</label>
							<img src="{{ asset('uploads/category_photos') }}/{{ $category_photo }}" class="form-control">
						</div>
						<div class="form-group">
							<label>Upload Picture</label>
							<input type="file" name="new_photo" class="form-control">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

