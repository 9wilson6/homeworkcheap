@extends('layouts.dash')
@section("links")

@endsection
@section("title" )
{{$order->topic}}
@endsection
@section("breadcrumb-item")
<li class="breadcrumb-item"><a href="{{route("tutor.dashboard")}}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{route("tutor.orders.show")}}">Orders</a></li>
<li class="breadcrumb-item active-breadcrumb" aria-current="page">#{{$order->id}}</li>
@endsection

@section("left-nav")
@include("inc.tutor-left-nav")
@endsection

@section('content')
<div class="white-box noselect">
    <div class="highlights d-flex">
        <div class="mr-3">
            <span class="text">Order id </span> <span class="id">#{{$order->id}}</span>
        </div>
        <div class="ml-3">
            <span class="text">Task Topic</span> <span class="topic"> {{$order->topic}}</span>
        </div>
    </div>
    <div class="my-4"></div>

    <div class="highlights section-2">
        <div class="container-fluid">
            <div class="row justify-content-start">
                <div class="col- ">
                    <div class=" mr-5"><strong>Deadline: &nbsp; </strong>{{$order->deadline}}(UTC) <span
                            class="text-info">({{\Carbon\Carbon::parse($order->deadline)->diffForHumans()}})</span>
                    </div>
                </div>
                <div class="col-">
                    <div class="mr-5"><strong>Status: &nbsp; </strong> <span class="badge badge-warning">Active</span>
                    </div>
                </div>
                <div class="col-">
                    <div class="mr-5"><strong>Pages: &nbsp; </strong>{{$order->pages}}</div>
                </div>

                <div class="col-">
                    <div><strong>Order Budget: &nbsp; </strong>${{$order->budget}}</div>
                </div>
            </div>
        </div>
    </div>

</div>
<h4 class="heading-4 my-3"></h4>
<div class="white-box">
    @error("myfiles.*")
    <div class="d-flex justify-content-center bg-danger text-white mb-3">
        {{$message}}
    </div>
    @enderror
    <div class="order-details order-details-tutor">
        <div class="row pl-3">
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        <div class="row">
                            <div class="col-6 col-md-12 text-center">
                                <div class="img-container pl-2 pt-2">
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
                        <table class="table" width="100%">
                            <tr>
                                <th>TYPE OF PAPER:</th>
                                <td>{{$order->paper_type}}</td>
                            </tr>

                            <tr>
                                <th>TOPIC:</th>
                                <td>{{$order->topic}}</td>

                            </tr>
                            <tr>
                                <th>PAGES:</th>
                                <td>{{$order->pages}}</td>
                            </tr>
                            <tr>
                                <th>DISCIPLINE:</th>
                                <td>{{$order->discipline}}</td>
                            </tr>
                            <tr>
                                <th>TYPE OF SERVICE:</th>
                                <td>{{$order->service_type}}</td>
                            </tr>
                            <tr>
                                <th>FORMAT OR CITATION STYLE:</th>
                                <td>{{$order->format}}</td>
                            </tr>
                            <tr>
                                <th>PAPER INSTRUCTIONS:</th>
                                <td>{!!$order->instructions!!}</td>
                            </tr>
                            <tr>
                                <th>ADDITIONAL MATERIALS (FILES):</th>
                                <td>
                                    @forelse($files as $file)
                                    <a href="{{route("file.download", [$order->id, basename($file)])}}" class="mr-3">
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

            <div class="col-lg-3">
                <div class="container ">
                    <div class="">
                        <h3 class="py-2">Bidding</h3>
                        <hr>
                        <form action="{{route("tutor.bid.create", [$order->id, Auth::user()->id])}}" method="post" id="bidForm">
                            @csrf
                            <div class="form-group row">
                                <label for="bid" class="col-5 col-md-12 col-xl-5 col-form-label font-weight-lighter">Bid
                                    to order $:</label>
                                <div class="col-7 col-md-12 col-xl-7">
                                    <input type="number" name="bid" min="5" class="form-control form-control-sm"
                                        id="bid" required>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <div class="font-weight-lighter col-5 col-md-12 col-xl-5"> Order budget: </div>
                                <div class="col-7 col-md-12 col-xl-7">
                                    ${{$order->budget}}
                                </div>
                            </div>

                            <hr>
                            <div class="form-group row">
                                <div class="font-weight-lighter col-5 col-md-12 col-xl-5"> Paid to you:
                                    <div class="tooltip-container">
                                        <span class="tooltip-icon"><span class="mdi mdi-information"></span></span>
                                        <span class="tooltip-text">10% will be deduct from the amount , you will bid on
                                            order.</span>
                                    </div>
                                </div>
                                <div class="col-7 col-md-12 col-xl-7">
                                    $ <span id="paid">0</span>.00
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="font-weight-lighter col-5 col-md-12 col-xl-5"> </div>
                                <div class="col-7 col-md-12 col-xl-7">
                                    <button type="submit" class="btn btn-block btn-primary">Place Bid</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
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

    $("#bidForm").submit(function(){
        if (confirm("Are you sure you want to place a bid on this order?? \n Topic:  {{$order->topic}}\n by confirming this, if the order is assigned to you you should complete it within the required time and for the agreed upon amount. ")) {
            return true;
        }else{
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Bid has not been placed',
                showConfirmButton: false,
                timer: 3000
            })
            return false;
        }
    });
</script>

@endsection

@endsection
