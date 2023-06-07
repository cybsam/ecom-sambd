@extends('layouts/dashboard_master')

@section('active_prod')
active
@endsection

@section('admin_faq')
active
@endsection

@section('content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('/home') }}">Home</a>
        <span class="breadcrumb-item active">FAQ</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
		{{-- update status --}}
		{{-- @if (session('pro_add_succ'))
			<div class="col-md-12">
				<div class="alert alert-success">
					{{ session('pro_add_succ') }}
				</div>
			</div>
		@endif --}}

{{-- delete status --}}
		{{-- @if (session('dlt_com'))
			<div class="col-md-12">
				<div class="alert alert-danger">
					{{ session('dlt_com') }}
				</div>
			</div>
		@endif --}}
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4>Product FAQ</h4>
				</div>
				<div class="card-body">
					<table class="table table-bordered">
						<tr>
							<th>S.N</th>
							<th>FAQ Qusetion</th>
							<th>Product Name</th>
							<th>FAQ Answare</th>
							
							<th>Create At</th>
							
							<th>Action</th>
						</tr>
						@forelse ($faqs as $faq)
						<tr>
							<td>{{ $faqs->firstItem() + $loop->index }}</td>
							<td>{{ $faq->faq_question }}</td>
							<td>{{ App\Product::find($faq->product_id)->product_name }}</td>
							<td>{{ $faq->faq_answare }}</td>
							<td>
								@if ($faq->created_at)
									{{ $faq->created_at->diffForHumans() }}
									@else
									No time available...
								@endif
							</td>
							
							<td>
								<div class="btn-group" role="group">
									
									<a href="{{ url('product/admin/faq/delete/') }}/{{ $faq->id }}" class="btn btn-danger btn-sm text-white">Delete</a>
								</div>
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="50" class="text-danger text-center">No data to show</td>
						</tr>
						@endforelse
					</table>
					{{ $faqs->links() }}
				</div>
			</div>
			
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4>Add Product FAQ</h4>
				</div>
				<div class="card-body">
					@if(session('insert_success'))
						<div class="alert alert-success">
							{{ session('insert_success') }}
						</div>
					@endif
					<form action="{{ url('product/admin/faq/post') }}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<input type="text" name="faq_question" class="form-control" placeholder="Question">
							@error('faq_question')
							<span class="text-danger"> {{ $message }} </span>
							@enderror
						</div>
						<div class="form-group">
							<select name="product_id" class="form-control">
								<option selected>Select Product</option>
								@foreach ($products as $product)
									<option value="{{ $product->id }}">{{ $product->product_name }}</option>
								@endforeach
								
							</select>
						</div>
						
						
						<div class="form-group">
							<textarea class="form-control" name="faq_answare" placeholder="FAQ Answear" row="4"></textarea>
							@error('faq_answare')
							<span class="text-danger"> {{ $message }} </span>
							@enderror
						</div>
						
						
						<div class="form-group mt-1">
							<button type="submit" class="btn btn-primary">Add Product FAQ</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
