@extends('layouts.dashboard_master')
@section('blog')
active
@endsection
@section('blog_add')
active
@endsection
@section('content')

<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('/home') }}">Home</a>
        <a class="breadcrumb-item" href="{{ url('/blog/admin') }}">Blogs</a>
        <span class="breadcrumb-item active">Add Blog</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">

	        	@if (session('blog_add'))
				<div class="col-md-12">
					<div class="alert alert-success">
						{{ session('blog_add') }}
					</div>
				</div>
			@endif

			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<h4>Add Blog</h4>
					</div>
					<div class="card-body">
						<form action="{{ url('/blog/admin/add/post') }}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label>Blog Name</label>
								<input type="text" name="blog_name" class="form-control">
							</div>
							@error('blog_name')
								<span class="text-danger">
									{{ $message }}
								</span>
							@enderror
							<div class="form-group">
								<select class="form-control" name="blog_category">
									<option></option>
									@foreach ($allCategories as $category)
										<option value="{{ $category->id }}">{{ $category->blog_category }}</option>
									@endforeach
								</select>
							</div>
							@error('blog_category')
								<span class="text-danger">
									{{ $message }}
								</span>
							@enderror
							<div class="form-group">
								<label>Short Description</label>
								<textarea class="form-control" name="short_description" rows="2"></textarea>
							</div>
							@error('short_description')
								<span class="text-danger">
									{{ $message }}
								</span>
							@enderror
							<div class="form-group">
								<label>Long Description</label>
								<textarea class="form-control" name="description" rows="3"></textarea>
							</div>
							@error('description')
								<span class="text-danger">
									{{ $message }}
								</span>
							@enderror
							<div class="form-group">
								<input type="file" name="blog_image" class="form-control">
							</div>
							@error('blog_image')
								<span class="text-danger">
									{{ $message }}
								</span>
							@enderror
							<div class="form-group">
								<button type="submit" class="btn btn-success">Add Blog</button>
							</div>
						</form>
					</div>
				</div>
				
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h4>category List</h4>
					</div>
					<div class="card-body">
						ok
						</form>
					</div>
				</div>
			</div>
        </div>
    </div>

@endsection