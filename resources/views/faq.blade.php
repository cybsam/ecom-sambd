@extends('layouts/frontend_master')

@section('frontEnd')

<div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Frequently Asked Questions (FAQ)</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>FAQ</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- about-area start -->
    <div class="about-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                  <div class="about-wrap text-center">
                    <h3>FAQ</h3>
                  </div>
                  @foreach ($all_faqs as $faqs)
                  <div class="accordion" id="accordionExample">
                    <div class="card border-0">
                      <div class="card-header border-0 p-0 my-3">
                          <button class="btn btn-link text-left py-3 w-100 text-white" type="button" data-toggle="collapse" data-target="#sam" aria-expanded="true" aria-controls="#sam">
                            {{ $faqs->faq_question }}? <span class="float-right">Products Name: {{ App\Product::find($faqs->product_id)->product_name  }}</span>
                          </button>
                      </div>

                      <div id="#sam" class="collapse show" aria-labelledby="#sam" data-parent="#accordionExample">
                        <div class="card-body">

                        	
                          {{ $faqs->faq_answare }}
                        </div>
                      </div>
                      
                    </div>
                    
                  </div>
                  @endforeach
                </div>
                {{ $all_faqs->links() }}
            </div>

        </div>
    </div>

@endsection