@extends('layouts/dashboard_master')

@section('active_form')
active
@endsection

@section('contact')
active
@endsection


@section('content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('/home') }}">Home</a>
        <a class="breadcrumb-item" href="{{ url('/contact/admin/view') }}">Contact</a>
        <span class="breadcrumb-item active">Single</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
          <div class="col-sm-12 m-auto">
          	<div class="card">
              <div class="card-header">
                <h3>Sender Name:- {{ $single_con->fname }}</h3><br>
                <p>Sending Time:- {{ $single_con->created_at }}</p>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">Sender Email:- {{ $single_con->email }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="" class="btn btn-outline-secondary btn-sm">Replay</a> </li>
                <li class="list-group-item">Subject:- {{ $single_con->subject }}</li>
                <li class="list-group-item">Description:- {{ $single_con->description }}</li>
              </ul>
            </div>
          </div>
      </div>
  </div>
 

@endsection