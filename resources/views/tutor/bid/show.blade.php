@extends('layouts.dash')
@section("links")

@endsection
@section("title" )
{{$bid->order->topic}}
@endsection
@section("breadcrumb-item")
<li class="breadcrumb-item"><a href="{{route("tutor.dashboard")}}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{route("tutor.orders.show")}}">Orders</a></li>
<li class="breadcrumb-item active-breadcrumb" aria-current="page">#{{$bid->order->id}}</li>
@endsection

@section("left-nav")
@include("inc.tutor-left-nav")
@endsection

@section('content')
<div class="white-box noselect">
    <div class="highlights d-flex">
        <div class="mr-3">
            <span class="text">Order id </span> <span class="id">#{{$bid->order->id}}</span>
        </div>
        <div class="ml-3">
            <span class="text">Task Topic</span> <span class="topic"> {{$bid->order->topic}}</span>
        </div>
    </div>
    <div class="my-4"></div>

    <div class="highlights section-2">
        <div class="container-fluid">
            <div class="row justify-content-start">
                <div class="col- ">
                    <div class=" mr-5"><strong>Deadline: &nbsp; </strong>{{$bid->order->deadline}}(UTC) <span
                            class="text-info">({{\Carbon\Carbon::parse($bid->order->deadline)->diffForHumans()}})</span>
                    </div>
                </div>
                <div class="col-">
                    <div class="mr-5"><strong>Status: &nbsp; </strong> <span class="badge badge-warning">Active</span>
                    </div>
                </div>
                <div class="col-">
                    <div class="mr-5"><strong>Pages: &nbsp; </strong>{{$bid->order->pages}}</div>
                </div>

                <div class="col-">
                    <div><strong>Order Budget: &nbsp; </strong>${{$bid->order->budget}}</div>
                </div>
            </div>
        </div>
    </div>

</div>
<h4 class="heading-4 my-3">Order Details</h4>
<div class="white-box">
    @error("myfiles.*")
    <div class="d-flex justify-content-center bg-danger text-white mb-3">
        {{$message}}
    </div>
    @enderror
    <div class="order-details order-details-tutor">
        <div class="row">
            <div class="col-lg-12">
                <div class="row py-3 pl-2 pr-4">
                    <div class="col-md-4 col-lg-3 pb-2">
                        <div class="row">
                            <div class="col-6 col-md-12 text-center">
                                <div class="img-container ">
                                    <img src="{{asset("assets/user.jpg")}}" class="img-thumbnail" alt="student image">
                                </div>
                            </div>
                            <div class="col-6 pl-md-5 col-md-12  pt-2">
                                <div class="font-weight-lighter"> wilson </div>
                                <div class="rating"> </div>
                                <div class="font-weight-lighter">Orders completed 4</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-9 bg-unique">
                        <table class="table" width="89%">
                            <tr>
                                <th>TYPE OF PAPER:</th>
                                <td>{{$bid->order->paper_type}}</td>
                            </tr>

                            <tr>
                                <th>TOPIC:</th>
                                <td>{{$bid->order->topic}}</td>

                            </tr>
                            <tr>
                                <th>PAGES:</th>
                                <td>{{$bid->order->pages}}</td>
                            </tr>
                            <tr>
                                <th>DISCIPLINE:</th>
                                <td>{{$bid->order->discipline}}</td>
                            </tr>
                            <tr>
                                <th>TYPE OF SERVICE:</th>
                                <td>{{$bid->order->service_type}}</td>
                            </tr>
                            <tr>
                                <th>FORMAT OR CITATION STYLE:</th>
                                <td>{{$bid->order->format}}</td>
                            </tr>
                            <tr>
                                <th>PAPER INSTRUCTIONS:</th>
                                <td>{!!$bid->order->instructions!!}</td>
                            </tr>
                            <tr>
                                <th>ADDITIONAL MATERIALS (FILES):</th>
                                <td>
                                    @forelse($files as $file)
                                    <a href="{{route("file.download", [$bid->order->id, basename($file)])}}"
                                        class="mr-3">
                                        <i class="mdi mdi-paperclip mr-1"></i>{{basename($file)}}
                                    </a>

                                    <br>
                                    @empty
                                    No files attached
                                    @endforelse
                                </td>
                            </tr>

                        </table>
                    </div>


                </div>

            </div>


        </div>
        <div class="d-flex justify-content-end ">
            <a href="{{route("tutor.myorders.show", [Auth::user()->id])}}" class="btn btn-success mb-3 mr-2">Back to
                Orders</a>
        </div>
    </div>


</div>
<div class="row">
    <div class="col-md-7">
        <div class="white-box my-3">
            <div class="row dashboard-count noselect">
                <div class="col-sm-6  mb-2 mt-xl-0 ">
                    <a href="javscript:void(0)">
                        <div class="gray-box d-flex">
                            <div class="icon"><i class="mdi mdi-cash-multiple"></i></div>
                            <div class="text ">
                                <div class="name">BID TO ORDER</div>
                                <div class="number">$ {{$bid->bid_amount}}.00</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6  mb-2 mt-xl-0 ">
                    <a href="javscript:void(0)">
                        <div class="gray-box d-flex">
                            <div class="icon"><i class="mdi mdi-wallet"></i></div>
                            <div class="text ">
                                <div class="name">PAID TO YOU</div>
                                <div class="number">$ {{round($bid->bid_amount*0.7)}}.00</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="my-2 d-flex justify-content-end">
                <form action="{{route("tutor.bid.delete", [$bid->id])}}" method="post" id="delBid">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-danger"> Remove Bid</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="white-box my-3">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium quisquam minus quam officiis voluptate
            minima dicta incidunt unde, illo saepe, dolorum nobis nam repellat ex rem. Reiciendis qui necessitatibus
            eaque.
        </div>
    </div>
</div>
@section("scripts")
<script>
    $("#bid").keyup(function() {
            var bid=$(this).val();
            var paid=(bid*0.7);
            $("#paid").html(Math.round(paid));
        });
    $("#delBid").submit(function(e){
        if (confirm("Are you sure you want to delete your bid on this order?? \n Topic:  {{$bid->order->topic}}")) {
            return true;
        }else{
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Your bid has not been deleted',
                showConfirmButton: false,
                timer: 3000
            })
            return false;
        }
    });

</script>

@endsection

@endsection
