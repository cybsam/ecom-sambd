@extends('layouts.dashboard_master')

@section('blog')
active
@endsection

@section('blog_admin')
active
@endsection


@section('content')

<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('/home') }}">Home</a>
        <span class="breadcrumb-item active">Blog</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
        	@if (session('delete_complete'))
			<div class="col-md-12">
				<div class="alert alert-danger">
					{{ session('delete_complete') }}
				</div>
			</div>
		@endif
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4>All Blogs</h4>
				</div>
				<div class="card-body">
					<table class="table table-bordered">
						<tr>
							<th>S.N</th>
							<th>Blog Name</th>
							<th>Blog Category</th>
							<th>Short Description</th>
							<th>Blog Picture</th>
							<th>Created At</th>
							<th>Action</th>
						</tr>
						@forelse ($allBlog as $blog)
						<tr>
							<td>{{ $allBlog->firstItem() + $loop->index }}</td>
							<td>{{ $blog->blog_name }}</td>
							<td>{{ $blog->blogTo_blogcategory->blog_category }}</td>
							{{-- <td>{{ App\BlogCategory::find($blog->blog_category)->blog_category }}</td> --}}
							<td>{{ $blog->short_description }}</td>
							
							<td><img src=" {{ asset('uploads/blog_photos') }}/{{ $blog->blog_image }} " width="100" alt="no picture"></td>
							<td>
								@if ($blog->created_at)
									{{ $blog->created_at->diffForHumans() }}
									@else
									No time available...
								@endif
							</td>
							<td>
								<div class="btn-group" role="group">
									
									<a href="{{ url('/blog/admin/delete') }}/{{ $blog->id }}" class="btn btn-danger btn-sm text-white">Delete</a>
								</div>
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="50" class="text-danger text-center">No data to show</td>
						</tr>
						@endforelse
					</table>
					{{ $allBlog->links() }}
				</div>
			</div>
        </div>
    </div>

@endsection