@extends('layouts.dashboard_master')
@section('blog')
active
@endsection
@section('blog_cate')
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

	        	@if (session('update_com'))
				<div class="col-md-12">
					<div class="alert alert-success">
						{{ session('update_com') }}
					</div>
				</div>
			@endif

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
						<h4>All Blogs Category</h4>
					</div>
					<div class="card-body">
						<table class="table table-bordered">
							<tr>
								<th>S.N</th>
								<th>Category Name</th>
								
								<th>Create At</th>
								
								
								<th>Action</th>
							</tr>
							@forelse ($allCategory as $category)
							<tr>
								<td>{{ $allCategory->firstItem() + $loop->index }}</td>
								<td>{{ $category->blog_category }}</td>
								
								<td>
									@if ($category->created_at)
										{{ $category->created_at->diffForHumans() }}
										@else
										No time available...
									@endif
								</td>
								
								
								<td>
									<div class="btn-group" role="group">
										
										<a href="{{ url('/blog/category/update/post') }}/{{ $category->id }}" class="btn btn-info btn-sm text-white">update</a>
										<a href="{{ url('/blog/category/delete/post') }}/{{ $category->id }}" class="btn btn-danger btn-sm text-white">Delete</a>
									</div>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="50" class="text-danger text-center">No data to show</td>
							</tr>
							@endforelse

						</table>
						{{ $allCategory->links() }}
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
						<form action="{{ url('/blog/category/post') }}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<input type="text" name="category_name" class="form-control" placeholder="Add Category">
							</div>
							@error('category_name')
							<span class="text-danger">
								{{ $message }}
							</span>
							@enderror
							<div class="form-group mt-1">
								<button type="submit" class="btn btn-primary">Add Blog Category</button>
							</div>
						</form>
					</div>
				</div>
			</div>
        </div>
    </div>

@endsection