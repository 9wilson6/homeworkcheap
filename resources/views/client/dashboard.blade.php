@extends('layouts.dash')
@section("title","dashboard")
@section("breadcrumb-item")
    <li class="breadcrumb-item active-breadcrumb" aria-current="page">Dashboard</li>
    @endsection
@section("left-nav")
    @include("inc.client-left-nav")
@endsection
@section('content')
  <div class="white-box order-wrapper">
      <div class="browser-order blue-bg mb-2 mt-2">
          Need an expert writer? There are
          <font>9</font> writers waiting for you. &nbsp;
          <a href="{{route("client.orders.create")}}" class="btn btn-outline-primary order">Place New Order</a>
      </div>
      <div class="row dashboard-count noselect">
          <div class="col-sm-6 col-lg-6 mb-2 mt-xl-0 col-xl-3">
              <a href="{{route("client.orders.show",[Auth::user()->id])}}">
                  <div class="gray-box d-flex">
                      <div class="icon"><i class="mdi mdi-clipboard-text"></i></div>
                      <div class="text ">
                          <div class="name">Orders in bidding</div>
                          <div class="number">{{$bidding ?? ''}}</div>
                      </div>
                  </div>
              </a>
          </div>
          <div class="col-sm-6 col-lg-6 mb-2 mt-xl-0 col-xl-3">
              <a href="{{route("client.orders.show",[Auth::user()->id])}}">
                  <div class="gray-box d-flex">
                      <div class="icon"><i class="mdi mdi-speedometer"></i></div>
                      <div class="text ">
                          <div class="name">Orders in progress</div>
                          <div class="number">{{$errors}}</div>
                      </div>
                  </div>
              </a>
          </div>
          <div class="col-sm-6 col-lg-6 mb-2 mt-xl-0 col-xl-3">
              <a href="">
                  <div class="gray-box d-flex">
                      <div class="icon"><i class="mdi mdi-check-circle-outline"></i></div>
                      <div class="text ">
                          <div class="name">Completed orders</div>
                          <div class="number">10</div>
                      </div>
                  </div>
              </a>
          </div>
          <div class="col-sm-6 col-lg-6 mb-2 mt-xl-0 col-xl-3">
              <a href="">
                  <div class="gray-box d-flex">
                      <div class="icon"><i class="mdi mdi-wallet"></i></div>
                      <div class="text ">
                          <div class="name">account balance</div>
                          <div class="number">10</div>
                      </div>
                  </div>
              </a>
          </div>

      </div>
  </div>
    <div class="writer-info mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="white-box">
                    <div class="row">
                        <div class="col-3">
                            <img  src="{{asset("assets/user.jpg")}}" class="img-thumbnail" alt="">
                        </div>
                        <div class="col-9">
                            <div class="name">{{Auth::user()->name}}</div>
                            <div class="rating"></div>
                            <div class="date-registered">Registered: {{Auth::user()->created_at}}</div>
                            <div class="email"><i class="mdi mdi-email"></i> {{Auth::user()->email}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="white-box">
                    <div class="message-wrapper">
                        <h6 class=" text-gray-dark">Recent Messages</h6>
                        <div class="d-flex">
                            <img src="{{asset("assets/user.jpg")}}" class="rounded-circle">
                            <div class="message">hello world

                            </div>
                            <span class="date ml-auto">01/01/2020</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
