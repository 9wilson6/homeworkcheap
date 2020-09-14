@extends('layouts.dash')
@section("links")
    <link rel="stylesheet" href="{{asset("plugins/bevacqua/rome/dist/rome.css")}}">
@endsection
@section("title","create new order")
@section("breadcrumb-item")
    <li class="breadcrumb-item"><a href="{{route("client.dashboard")}}">Dashboard</a></li>
    <li class="breadcrumb-item active-breadcrumb" aria-current="page">New order</li>
@endsection
@section("left-nav")
    @include("inc.client-left-nav")
@endsection
@section('content')
<div class="steps-container noselect">
    <div class="white-box">
        <ul class="progressbar">
            <li class="current">Fill in Order Details</li>
            <li class="">Order Bidding</li>
            <li class="">Choose writer & Reserve money</li>
            <li class="">Track Progress</li>
        </ul>
    </div>
</div>
    <div class="order-form">
        <div class="white-box">
            <form action="{{route("client.orders.store", [Auth::user()->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="container-fluid">
                <h4 class="heading-4">Basic Information</h4>
                <hr>
                 <div class="container">
                        <div class="row">
                            <div class="col-lg-10 col-xl-9">
                                <div class="form-group row">
                                    <label for="paper_type" class="col-md-4 col-form-label">Type of Paper</label>
                                    <div class="col-md-8">
                                    <select name="paper_type" class="custom-select @error('paper_type') is-invalid @enderror" id="paper_type" required>
                                        <option value="">select</option>
                                        <option @if(old('paper_type')==1) selected @endif value="1">option 1</option>
                                        <option @if(old('paper_type')==2) selected @endif value="2">option 2</option>
                                        <option @if(old('paper_type')==3) selected @endif value="3">option 3</option>
                                        <option @if(old('paper_type')==4) selected @endif value="4">option 4</option>
                                        <option @if(old('paper_type')==5) selected @endif value="5">option 5</option>
                                        <option @if(old('paper_type')==6) selected @endif value="6">option 6</option>
                                    </select>
                                        @error("paper-type")
                                        <span class="invalid-feedback font-weight-lighter" role="alert">
                                        {{ $message }}
                                         </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="topic" class="col-md-4 col-form-label">Topic</label>
                                    <div class="col-md-8">
                                        <input type="text"  name="topic" value="{{old("topic")}}" class="form-control @error('topic') is-invalid @enderror" id="topic" required>
                                        @error("topic")
                                        <span class="invalid-feedback font-weight-lighter" role="alert">
                                        {{ $message }}
                                         </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tipic" class="col-md-4 col-form-label">Pages</label>
                                    <div class="col-md-8">
                                        <input type="number" min="1" name="pages" value="{{old("pages")}}" class="form-control @error('pages') is-invalid @enderror" id="pages" required>
                                        @error("pages")
                                        <span class="invalid-feedback font-weight-lighter" role="alert">
                                        {{ $message }}
                                         </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="budget" class="col-md-4 col-form-label">Order Budget(<small>in USD</small>)</label>
                                    <div class="col-md-8">
                                        <input type="number" name="budget" value="{{old("budget")}}" class="form-control @error('budget') is-invalid @enderror"  id="budget" required>
                                        @error("budget")
                                        <span class="invalid-feedback font-weight-lighter" role="alert">
                                        {{ $message }}
                                         </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row datetime-container">
                                    @php
                                        $date=Carbon\Carbon::now();
                                        $mintime=$date->copy()->addHours(2);
                                        @endphp
                                    <label for="deadline" class="col-md-4 col-form-label">Deadline</label>
                                    <input type="hidden" id="mintime" value="{{$mintime}}">
                                    <div class="col-md-8">
                                        <input type="text" readonly name="deadline" value="{{$mintime}}" class="form-control @error('deadline') is-invalid @enderror" id="deadline" required>
                                        <p class="mt-2">
                                            <small class="text-dark">In Timezone UTC Now: </small>
                                            <span class="font-weight-bold">{{$date}}</span>
                                        </p>
                                        @error("deadline")
                                        <span class="invalid-feedback font-weight-lighter" role="alert">
                                        {{ $message }}
                                         </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 <h4 class="heading-4">Additional Information</h4>
                 <hr>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-xl-9">
                            <div class="form-group row">
                                <label for="discipline" class="col-md-4 col-form-label">Discipline</label>
                                <div class="col-md-8">
                                    <select name="discipline" class="custom-select  @error('discipline') is-invalid @enderror" id="discipline" required>
                                        <option value="">select</option>
                                        <option @if(old('discipline')==1) selected @endif value="1">option 1</option>
                                        <option @if(old('discipline')==2) selected @endif value="2">option 2</option>
                                        <option @if(old('discipline')==3) selected @endif value="3">option 3</option>
                                        <option @if(old('discipline')==4) selected @endif value="4">option 4</option>
                                        <option @if(old('discipline')==5) selected @endif value="5">option 5</option>
                                        <option @if(old('discipline')==6) selected @endif value="6">option 6</option>
                                    </select>
                                    @error("discipline")
                                    <span class="invalid-feedback font-weight-lighter" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="service_type" class="col-md-4 col-form-label">Type of service</label>
                                <div class="col-md-8">
                                    <select name="service_type" class="custom-select @error('service_type') is-invalid @enderror" id="service_type" required>
                                        <option  @if(old('service_type')==1) selected @endif value="">select</option>
                                        <option  @if(old('service_type')==2) selected @endif value="1">option 1</option>
                                        <option  @if(old('service_type')==3) selected @endif value="2">option 2</option>
                                        <option  @if(old('service_type')==4) selected @endif value="3">option 3</option>
                                        <option  @if(old('service_type')==5) selected @endif value="4">option 4</option>
                                        <option  @if(old('service_type')==6) selected @endif value="5">option 5</option>
                                        <option  @if(old('service_type')==7) selected @endif value="6">option 6</option>
                                    </select>
                                    @error("service-type")
                                    <span class="invalid-feedback font-weight-lighter" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="format" class="col-md-4 col-form-label">Format or citation style</label>
                                <div class="col-md-8">
                                    <select name="format" class="custom-select @error('format') is-invalid @enderror" id="format" required>
                                        <option  value="">select</option>
                                        <option @if(old('format')==1) selected @endif value="1">option 1</option>
                                        <option @if(old('format')==2) selected @endif value="2">option 2</option>
                                        <option @if(old('format')==3) selected @endif value="3">option 3</option>
                                        <option @if(old('format')==4) selected @endif value="4">option 4</option>
                                        <option @if(old('format')==5) selected @endif value="5">option 5</option>
                                        <option @if(old('format')==6) selected @endif value="6">option 6</option>
                                    </select>
                                    @error("format")
                                    <span class="invalid-feedback font-weight-lighter" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="instructions" class="col-md-4 col-form-label">Paper Instructions</label>
                                <div class="col-md-8">
                                    <textarea name="instructions"  class="form-control @error('instructions') is-invalid @enderror" id="instructions">
                                        {{old("instructions")}}
                                    </textarea>
                                    @error("instructions")
                                    <span class="invalid-feedback font-weight-lighter" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row datetime-container">

                                <label for="files" class="col-md-4 col-form-label">Upload additional material</label>
                                <div class="col-md-8">
                                    <div class="custom-file-upload">
                                        <input type="file" id="file" class="@error('myfiles.*') is-invalid @enderror" name="myfiles[]" multiple/>
                                        @error("myfiles.*")

                                        <small class="text-danger" >{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <p>
                                        <small>Max file upload limit for single file 6M. <br> You can upload only .ppt, .pptx, .doc, .docx, .pdf, .xls, .xlsx, .jpeg, .png, .jpg, .gif, and .svg files.</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h4 class="heading-4">Request a specific writer</h4>
                <hr>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-xl-9">
                            <div class="form-group row">
                                <label for="writer" class="col-md-4 col-form-label">Invite writer</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control @error('writer') is-invalid @enderror" name="writer" value="{{old("writer")}}" id="writer">
                                    @error("writer")
                                    <span class="invalid-feedback font-weight-lighter" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4"></div>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-info font-weight-bolder btn-block" id="create-post-submit">PUBLISH FOR WRITERS</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@section("scripts")
    <script src="{{asset("plugins/bevacqua/rome/dist/rome.js")}}"></script>

    <script src="{{asset("plugins/ckeditor5-classic/build/ckeditor.js")}}"></script>

    <script src="{{asset("js/main.js")}}"></script>
@endsection

@endsection
