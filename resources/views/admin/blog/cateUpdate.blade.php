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
        <a class="breadcrumb-item" href="{{ url('/blog/admin/add/category') }}">Category</a>
        <span class="breadcrumb-item active">{{ $categories }}</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
        	<div class="col-md-8">
        		<form action="{{ url('/blog/category/update/com') }}" method="post">
        			@csrf
        			<div class="form-group">
        				<input type="text" name="cate_name" value="{{ $categories }}" class="form-control">
        				<input type="hidden" name="category_id" value="{{ $category_id }}" class="form-control">
        			</div>
        			<div class="form-group">
        				<button type="submit" class="btn btn-primary">Update</button>
        			</div>
        		</form>
        	</div>
	        	
        </div>
    </div>

@endsection