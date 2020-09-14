@extends('layouts.dash')
@section("title","dashboard")
@section("breadcrumb-item")
    <li class="breadcrumb-item active-breadcrumb" aria-current="page">Dashboard</li>
    @endsection
@section("left-nav")
    @include("inc.tutor-left-nav")
@endsection
@section('content')
  <div class="white-box order-wrapper">
      <div class="browser-order blue-bg">
          @if($available>0)
             <strong>{{$available }}</strong> project(s) available at this time.
              <a href="{{route("tutor.orders.browse")}}" class="order">Click here to start bidding</a>
          @else
              No project is available this time
          @endif

      </div>
      <div class="row dashboard-count noselect">
          <div class="col-sm-6 col-lg-6 mb-2 mt-xl-0 col-xl-3">
              <a href="{{route("tutor.myorders.show", [Auth::user()->id])}}">
                  <div class="gray-box d-flex">
                      <div class="icon"><i class="mdi mdi-clipboard-text"></i></div>
                      <div class="text ">
                          <div class="name">Orders in bidding</div>
                          <div class="number">{{$bidding}}</div>
                      </div>
                  </div>
              </a>
          </div>
          <div class="col-sm-6 col-lg-6 mb-2 mt-xl-0 col-xl-3">
              <a href="{{route("tutor.orders.show",[Auth::user()->id])}}">
                  <div class="gray-box d-flex">
                      <div class="icon"><i class="mdi mdi-speedometer"></i></div>
                      <div class="text ">
                          <div class="name">Orders in progress</div>
                          <div class="number">{{$progress}}</div>
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
    <div class="writer-info">
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
                        <h6 class=" text-gray-dark text-uppercase">Recent Messages</h6>
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
