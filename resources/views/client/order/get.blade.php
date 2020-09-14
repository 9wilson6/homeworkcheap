@extends('layouts.dash')
@section("links")
    <link  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

@endsection
@section("title","My orders")
@section("breadcrumb-item")
    <li class="breadcrumb-item"><a href="{{route("client.dashboard")}}">Dashboard</a></li>
    <li class="breadcrumb-item active-breadcrumb" aria-current="page">Orders</li>
@endsection
@section("left-nav")
    @include("inc.client-left-nav")
@endsection
@section('content')

    {{--#########@START@    Orders in bidding     #########--}}
    <div class="orders-container">

        <h4 class="heading-4">Orders in bidding</h4>
        <div class="white-box">
            <table class="table table-borderless table-striped noselect" id="table">
                <thead>
                <tr>
                    <th>ORDER NO.</th>
                    <th>TOPIC</th>
                    <th>STATUS</th>
                    <th>TYPE OF PAPER</th>
                    <th>PAGES</th>
                    <th>DEADLINE</th>
                    <th>BIDS</th>
                    <th>ACTION</th>
                </tr>
                </thead>
                <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td><a href="{{route("client.order.show",[$order->id])}}">#{{$order->id}}</a></td>
                        <td class="long">{{$order->topic}}</td>
                        <td>{{$order->status}}</td>
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
                        <td>{{$order->bids->count()}}</td>
                        <td><a href="{{route("client.order.show",[$order->id])}}" class="btn btn-sm btn-info">view order</a></td>
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


    {{--#########@END@    Orders in bidding       #########--}}

    {{--#########@START@    Orders in progress     #########--}}


        <h4 class="heading-4 my-3">Orders in Progress</h4>
        <div class="white-box">
            <table class="table table-borderless table-striped noselect" id="table">
                <thead>
                <tr>
                    <th>ORDER NO.</th>
                    <th>TOPIC</th>
                    <th>STATUS</th>
                    <th>TYPE OF PAPER</th>
                    <th>PAGES</th>
                    <th>DEADLINE</th>
                    <th>WRITER</th>
                    <th>ACTION</th>
                </tr>
                </thead>
                <tbody>
                @forelse($progress as $order_progress)
                    <tr>
                        <td><a href="{{route("client.order.show",[$order_progress->id])}}">#{{$order_progress->id}}</a></td>
                        <td class="long">{{$order_progress->topic}}</td>
                        <td>{{$order_progress->status}}</td>
                        <td>{{$order_progress->paper_type}}</td>
                        <td>{{$order_progress->pages}}</td>

                        <td>
                            @if(\Carbon\Carbon::parse($order_progress->deadline)->isPast())
                                <span class="text-danger"> {{\Carbon\Carbon::parse($order_progress->deadline)->diffForHumans()}}</span>
                            @else
                                @if(\Carbon\Carbon::parse($order_progress->deadline)->diffInHours()>1)
                                    <span class="text-dark"> {{\Carbon\Carbon::parse($order_progress->deadline)->diffForHumans()}}</span>
                                @elseif(\Carbon\Carbon::parse($order_progress->deadline)->diffInHours()<=1)
                                    <span class="text-warning"> {{\Carbon\Carbon::parse($order_progress->deadline)->diffForHumans()}}</span>
                                @endif
                            @endif
                        </td>
                        <td>{{$order_progress->progress->writer_name}}</td>
                        <td><a href="{{route("client.order.show",[$order_progress->id])}}" class="btn btn-sm btn-info">view order</a></td>
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
            <div class="d-flex justify-content-end">  {{$progress->links()}}</div>
        </div>

    </div>
    {{--#########@END@    Orders in progress       #########--}}
@section("scripts")

@endsection

@endsection
