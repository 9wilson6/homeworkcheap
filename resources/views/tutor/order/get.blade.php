@extends('layouts.dash')
@section("links")
    <link  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

@endsection
@section("title","Tutor orders view")
@section("breadcrumb-item")
    <li class="breadcrumb-item"><a href="{{route("tutor.dashboard")}}">Dashboard</a></li>
    <li class="breadcrumb-item active-breadcrumb" aria-current="page">Orders</li>
@endsection
@section("left-nav")
    @include("inc.tutor-left-nav")
@endsection
@section('content')

    {{--#########@START@    Orders in bidding     #########--}}
    <div class="orders-container">

        <h4 class="heading-4">Browse Orders</h4>
        <div class="white-box">
            <table class="table table-borderless table-striped noselect" id="table">
                <thead>
                <tr>
                    <th>ORDER NO.</th>
                    <th>TOPIC</th>
                    <th>TYPE OF PAPER</th>
                    <th>PAGES</th>
                    <th>DEADLINE</th>
                    <th>CLIENT</th>
                    <th>ACTION</th>
                </tr>
                </thead>
                <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td><a href="{{route("tutor.order.show",[$order->id])}}">#{{$order->id}}</a></td>
                        <td class="long">{{$order->topic}}</td>
                        <td>{{$order->paper_type}}</td>
                        <td>{{$order->pages}}</td>
                        <td>
                            @if(\Carbon\Carbon::parse($order->deadline)->isPast())
                           <span class="text-danger"> {{\Carbon\Carbon::parse($order->deadline)->diffForHumans()}}</span>
                                @else
                                @if(\Carbon\Carbon::parse($order->deadline)->diffInHours()>1)
                                    <span class="text-dark"> {{\Carbon\Carbon::parse($order->deadline)->diffForHumans()}}</span>
                                @elseif(\Carbon\Carbon::parse($order->deadline)->diffInHours()<=1)
                                    <span class="text-warning"> {{\Carbon\Carbon::parse($order->deadline)->diffForHumans()}}</span>
                                @endif
                            @endif
                        </td>
                        <td>{{$order->user->name}}</td>
                        <td><a href="{{route("tutor.order.show",[$order->id])}}" class="btn btn-sm btn-success">place bid</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td></td>
                        <td class="text-center" colspan="6">no records found</td>
                        <td></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
          <div class="d-flex justify-content-end">  {{$orders->links()}}</div>
        </div>

    </div>
    {{--#########@END@    Orders in progress       #########--}}
@section("scripts")

@endsection

@endsection
