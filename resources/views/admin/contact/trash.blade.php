@extends('layouts/dashboard_master')

@section('active_form')
active
@endsection

@section('trash')
active
@endsection


@section('content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('/home') }}">Home</a>
        <a class="breadcrumb-item" href="{{ url('/contact/admin/view') }}">Contact</a>
        <span class="breadcrumb-item active">Trash</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
          <div class="col-sm-12 m-auto">
          	<div class="card">
              <div class="card-body">
                @if (session('succ'))
                  <div class="alert alert-info text-white">
                    {{ session('succ') }}
                  </div>
                @endif
                @if (session('herd_del'))
                  <div class="alert alert-danger text-white">
                    {{ session('herd_del') }}
                  </div>
                @endif
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>S.N</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Subject</th>
                      {{-- <th>Description</th> --}}
                      <th>Deleted At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($contact_trash as $con_trash)
                      <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $con_trash->fname }}</td>
                        <td>{{ $con_trash->email }}</td>
                        <td>{{ $con_trash->subject }}</td>
                        <td>
                          @if ($con_trash->deleted_at)
                            {{ $con_trash->deleted_at->diffForHumans() }}
                            @else
                            No time to show
                          @endif
                        </td>
                        <td>
                          <div class="btn-group" role="group">
                            <a href="{{ url('/contact/admin/view/restore') }}/{{ $con_trash->id }}" class="btn btn-primary btn-sm">Restore</a>
                            <a href="{{ url('/contact/admin/view/delete/hard') }}/{{ $con_trash->id }}" class="btn btn-danger btn-sm">Delete</a>
                          </div>
                        </td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="50" class="text-danger text-center">No Data to show</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
            </div>
          </div>
      </div>
  </div>
 

@endsection