@extends('layouts/dashboard_master')


@section('content')

<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
      	<a class="breadcrumb-item" href="{{ url('/home') }}">Home</a>
        <span class="breadcrumb-item active">Profile</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
		<div class="col-md-8 m-auto">
			<div class="card">
				<div class="card-header">
					<h4>Change Name</h4>
				</div>
				<div class="card-body">
					@if(session('update_status'))
						<div class="alert alert-success">
							{{ session('update_status') }}
						</div>
					@endif
					<form action="{{ url('profile/post') }}" method="post">
						@csrf
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="updateName" class="form-control" value="{{ Str::title(Auth::user()->name) }}">
						</div>
						@error('updateName')
						<span class="text-danger">
							{{ $message }}
						</span>
						@enderror
						<div class="form-group mt-1">
							<button type="submit" class="btn btn-outline-info ">Update Name</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<hr>
	<div class="row mt-3">
		<div class="col-md-8 m-auto">
			<div class="card">
				<div class="card-header">
					<h4>Password Change</h4>
				</div>
				<div class="card-body">
					@if($errors->all())
						<div class="alert alert-danger">
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</div>
					@endif
					@if (session('password_change_status'))
						<div class="alert alert-success">
							{{ session('password_change_status') }}
						</div>
					@endif
					<form action="{{ url('profile/password') }}" method="post">
						@csrf
						<div class="form-group">
							<label>Old Password</label>
							<input type="password" name="oldPassword" class="form-control" placeholder="Old Password" {{-- value=" {{ old('oldPassword') }} " --}}>
						</div>
						@error('oldPassword')
						<span class="text-danger">
							{{ $message }}
						</span>
						@enderror

						<div class="form-group">
							<label>New Password</label>
							<input type="password" name="password" class="form-control" placeholder="New Password" {{-- value=" {{ old('password') }} " --}}>
						</div>
						@error('password')
						<span class="text-danger">
							{{ $message }}
						</span>
						@enderror

						<div class="form-group">
							<label>Confirm Password</label>
							<input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password"{{--  value=" {{ old('password_confirmation') }}  --}}>
						</div>
						@error('password_confirmation')
						<span class="text-danger">
							{{ $message }}
						</span>
						@enderror
						<div class="form-group mt-1">
							<button type="submit" class="btn btn-warning ">Password Change</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection