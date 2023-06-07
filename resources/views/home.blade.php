@extends('layouts.dashboard_master')

@section('home')
active
@endsection


@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <span class="breadcrumb-item active">Home</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>Welcome, {{ auth::user()->name }}</h3>
                    <h4>Email, {{ auth::user()->email }} </h4>
                    <h5>Created , {{ auth::user()->created_at }} </h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>All Users: {{ $total_users }} </h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="table-secondary">
                            <tr>
                                <th>Serial</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Create at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td> {{ $users->firstItem() + $loop->index }} </td>
                                <td> {{ $user->id }} </td>
                                <td> {{ $user->name }} </td>
                                <td> {{ $user->email }} </td>
                                <td> {{ $user->created_at->format('d/m/Y h:i:s A') }}
                                    <br>
                                    {{ $user->created_at->diffForHumans() }}
                                 </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
          </div>
        </div>
      </div>
@endsection
      