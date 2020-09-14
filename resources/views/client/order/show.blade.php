@extends('layouts.dash')
@section("links")


@endsection
@section("title","My orders")
@section("breadcrumb-item")
<li class="breadcrumb-item"><a href="{{route("client.dashboard")}}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{route("client.orders.show", [Auth::user()->id])}}">Orders</a></li>
<li class="breadcrumb-item active-breadcrumb" aria-current="page">#{{$order->id}}</li>
@endsection

@section("left-nav")
@include("inc.client-left-nav")
@endsection

@section('content')
<div class="white-box noselect">
    <div class="highlights d-flex">
        <div class="mr-3">
            <span class="text">Order id </span> <span class="id">#{{$order->id}}</span>
        </div>
        <div class="ml-3">
            <span class="text">Order Topic</span> <span class="topic"> {{$order->topic}}</span>
        </div>
    </div>

    <div class="steps-container ">
        <div class="white-box">
            <ul class="progressbar">
                <li class="current">Fill in Order Details</li>
                <li class="current">Order Bidding</li>
                <li class="">Choose writer & Reserve money</li>
                <li class="">Track Progress</li>
            </ul>
        </div>
    </div>
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
                    <div class="mr-5"><strong>Total bids: &nbsp; </strong>0</div>
                </div>
                <div class="col-">
                    <div><strong>Order Budget: &nbsp; </strong>${{$order->budget}}</div>
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
    <div class="order-details">
        <table class="table table-responsive-xl" width="100%">
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
                    <div class="d-flex">
                        <div>
                            <a href="{{route("file.download", [$order->id, basename($file)])}}"
                                class="btn btn-sm bg-cyan"><i class="mdi mdi-paperclip mr-1"></i>{{basename($file)}}</a>
                        </div>
                        <div>
                            <form action="{{route("client.file.delete", [$order->id, basename($file)])}}" method="POST">

                                @method("DELETE")

                                @csrf

                                <button type="submit" class="btn btn-danger btn-circle ml-2"><i
                                        class="mdi mdi-delete-forever"></i></button>
                            </form>
                        </div>
                    </div>
                    <br>
                    @empty
                    No files attached
                    @endforelse
                </td>
            </tr>

        </table>

        <div class="row">
            <div class="col-md-4">

                <a class="btn btn-sm btn-success btn-block  pb-2 pl-1"
                    href="{{route("client.order.edit",[$order->id])}}"><i class="mdi mdi-lead-pencil mr-1"></i>Change
                    order details</a>
            </div>
            <div class="col-md-4">
                <button class="btn btn-sm btn-primary btn-block my-2 my-md-0 pb-2 pl-1" data-toggle="modal"
                    data-target="#filesUploadModal"><i class="mdi mdi-paperclip mr-1"></i>Upload additional
                    material</button>
            </div>
            <div class="col-md-4">
                <form action="{{route("client.order.delete",[$order->id])}}" method="POST" id="deleteOrder">
                    @csrf
                    @method("DELETE")
                    <button class="btn btn-sm btn-danger btn-block pb-2 pl-1 "><i class="mdi mdi-close mr-1"></i>Cancel
                        order</button>
                </form>
            </div>
        </div>
    </div>
    <div class="filesmodel">

        <!-- Modal -->
        <div class="modal fade" id="filesUploadModal" tabindex="-1" role="dialog"
            aria-labelledby="filesUploadModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filesUploadModalLongTitle">Upload additional materials</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route("client.file.additional",[$order->id])}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="custom-file-upload">
                                <label class="btn btn-primary btn-block btn-sm" for="filesToUpload">Click here to upload
                                    additional files</label>
                                <input type="file" id="filesToUpload" required
                                    class="@error('myfiles') is-invalid @enderror" name="myfiles[]"
                                    style="display: none" multiple />

                                @error("myfiles")
                                <span class="invalid-feedback font-weight-lighter" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror

                            </div>
                            <div class="form-group mt-5">
                                <hr>
                                <p>Files to be uploaded</p>

                                <ul id="selectedFiles">
                                    <small>No files Selected</small>
                                </ul>
                                <hr>
                            </div>
                            <div class="pt-1">
                                <small>
                                    <i>Max file upload limit for single file 6M. <br> You can upload only .ppt, .pptx,
                                        .doc, .docx, .pdf, .xls, .xlsx, .jpeg, .png, .jpg, .gif, and .svg files.</i>
                                </small>
                            </div>

                            <div class="d-flex justify-content-end mt-2">
                                <button type="submit" class="btn btn-info btn-lg btn-block">Submit Files</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<h4 class="heading-4 my-3">Total bids <strong>10</strong></h4>
    <div class="white-box my-3" >
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Writer</th>
                <th scope="col">Rating</th>
                <th scope="col">Orders Completed</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            @forelse($bid_info as $bid)
                <td>{{$bid->user->name}}</td>
                <td>
                    <div class="user-rating ">
                        <span class="count">5/5</span>
                        <span class="stars three"></span>
                    </div>
                </td>
                <td>loading..</td>
                <td>{{$bid->bid_amount}}</td>
                <td>
                    <form action="{{route("client.order.award",[$order->id, $bid->user->id, $bid->id])}}" method="post">
                        @csrf
                        <button class="btn btn-success btn-sm">Award</button>
                    </form>

                </td>
            @empty
                <td>No bids for current order</td>
            @endforelse
            </tr>
            </tbody>
        </table>
    </div>
@section("scripts")
<script>
    $('#deleteOrder').on('submit', function(e) {

            if (confirm("Are you sure you want to delete this order?? \n Topic:  {{$order->topic}}")) {
                return true;
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Your order has not been deleted',
                    showConfirmButton: false,
                    timer: 3000
                })
                return false;
            }

        });


</script>
<script>
    var selDiv = "";

        document.addEventListener("DOMContentLoaded", init, false);

        function init() {
            document.querySelector('#filesToUpload').addEventListener('change', handleFileSelect, false);
            selDiv = document.querySelector("#selectedFiles");
        }

        function handleFileSelect(e) {

            if(!e.target.files) return;

            selDiv.innerHTML = "";

            var files = e.target.files;
            for(var i=0; i<files.length; i++) {
                var f = files[i];

                selDiv.innerHTML +="<li class='ml-2'> <small>"+ f.name +"</small> </li>";

            }

        }
</script>
@endsection

@endsection
