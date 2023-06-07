@extends('layouts/dashboard_master');

@section('active_prod')
active
@endsection
@section('admin_pro')
active
@endsection
@section('content');

<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('/home') }}">Home</a>
        <span class="breadcrumb-item active">Product</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
		{{-- update status --}}
		@if (session('pro_add_succ'))
			<div class="col-md-12">
				<div class="alert alert-success">
					{{ session('pro_add_succ') }}
				</div>
			</div>
		@endif

{{-- delete status --}}
		@if (session('delete_com'))
			<div class="col-md-12">
				<div class="alert alert-danger">
					{{ session('delete_com') }}
				</div>
			</div>
		@endif
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4>Product</h4>
				</div>
				<div class="card-body">
					<table class="table table-bordered">
						<tr>
							<th>S.N</th>
							<th>Product Name</th>
							<th>Category</th>
							
							<th>Create At</th>
							<th>Last Update</th>
							<th>Category Photo</th>
							<th>Action</th>
						</tr>
						@forelse ($products as $product)
						<tr>
							<td>{{ $loop->index + 1 }}</td>
							<td>{{ $product->product_name }}</td>
							<td>{{ $product->relationCategoryToProduct->category_name }}</td>
							{{-- <td>{{ App\Category::find($product->category_id)->category_name }}</td> --}}
							<td>
								@if ($product->created_at)
									{{ $product->created_at->diffForHumans() }}
									@else
									No time available...
								@endif
							</td>
							<td>@if ($product->updated_at)
								{{ $product->updated_at->diffForHumans() }}
								@else
								-
							@endif</td>
							<td><img src=" {{ asset('uploads/product_photos') }}/{{ $product->product_thumbnail_photo }} " width="50" alt="product picture"></td>
							<td>
								<div class="btn-group" role="group">
									<a href="{{ url('category/update') }}/{{ $product->id }} " class="btn btn-success btn-sm text-white">Update</a>
									<a href="{{ url('product/admin/delete/') }}/{{ $product->id }}" class="btn btn-warning btn-sm text-white">Delete</a>
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
					<h4>Add Product</h4>
				</div>
				<div class="card-body">
					@if(session('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
					@endif
					<form action="{{ url('/product/admin/post') }}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<input type="text" name="product_name" class="form-control" placeholder="Product Name">
							@error('product_name')
							<span class="text-danger"> {{ $message }} </span>
							@enderror
						</div>
						<div class="form-group">
							<select name="category_id" class="form-control">
								<option selected>Select Category</option>
								@foreach ($category as $catego)
									<option value="{{ $catego->id }}">{{ $catego->category_name }}</option>
								@endforeach
								
							</select>
						</div>
						<div class="form-group">
							<input type="number" name="product_price" class="form-control" placeholder="Product Price">
							@error('product_price')
							<span class="text-danger"> {{ $message }} </span>
							@enderror
						</div>
						<div class="form-group">
							<input type="number" name="product_quantity" class="form-control" placeholder="Product Quantity">
							@error('product_quantity')
							<span class="text-danger"> {{ $message }} </span>
							@enderror
						</div>
						
						<div class="form-group">
							<textarea class="form-control" name="product_short" placeholder="Product Short Description" row="4"></textarea>
							@error('product_short')
							<span class="text-danger"> {{ $message }} </span>
							@enderror
						</div>
						<div class="form-group">
							<textarea class="form-control" name="product_description" placeholder="Product Description" cols="3"></textarea>
							@error('product_description')
							<span class="text-danger"> {{ $message }} </span>
							@enderror
						</div>
						<div class="form-group">
							<input type="file" name="product_thuambnail" class="form-control">
							@error('product_thuambnail')
							<span class="text-danger"> {{ $message }} </span>
							@enderror
						</div>
						{{-- multiple picture --}}
						<div class="form-group">
							<label>Product Multiple Picture</label>
							<input type="file" name="product_multiple_picture[]" class="form-control" multiple>
							@error('product_multiple_picture')
							<span class="text-danger"> {{ $message }} </span>
							@enderror
						</div>
						
						<div class="form-group mt-1">
							<button type="submit" class="btn btn-primary">Add Product</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection