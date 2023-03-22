@extends('admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>




<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin Profile</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Contacts</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Profile</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-4 col-xl-6">
                <div class="card text-center">
                    <div class="card-body">
                        <table class="table table-bordered border-primary mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>QTY</th>
                                    <th>Price</th>
                                    <th>SubTotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            @php
                            $all_cart = Cart::content();
                            @endphp

                            <tbody>
                                @foreach($all_cart as $cart)
                                <tr>
                                    <td>{{ $cart->name }}</td>
                                    <td>
                                    <form action="{{ url('/cart-update/'.$cart->rowId) }}" method="post">
                                        @csrf    
                                    <input name="qty01" type="number" value="{{ $cart->qty }}" style="width: 40px;" min="1"></td>
                                    
                                        <button type="submit" class="btn btn-sm btn-success" style="margin-top:1px;"><i class="fas fa-check"></i></button>
                                    </form>
                                    <td>{{ $cart->price }}</td>
                                    <td>{{ $cart->price*$cart->qty }}</td>
                                    <td><a href="{{ url('/cart-remove/'.$cart->rowId) }}"> <i class="fas fa-trash-alt" style="color: #000;"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="bg-primary">
                        <br>
                        <p style="font-size: 18px; color:#000;">Quantity : {{ Cart::count() }}</p>
                        <p style="font-size: 18px; color:#000;">Subtotal : {{ Cart::subtotal() }}</p>
                        <p>
                        <h2>Total :</h2>
                        <h1 class="text-black">{{ Cart::total() }}</h1>
                        </p>
                        <br>
                    </div>
                    <form action="{{ url(/complete-order) }}">
                        <button class="btn btn-blue waves-effect waves light"> Create Invoice</button>
                    </form>

                </div> <!-- end card -->

            </div> <!-- end col-->




            <div class="col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">

                        <!-- end timeline content-->

                        <div class="tab-pane" id="settings">

                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th> </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($product as $key=> $item)
                                    <tr>

                                        <form method="post" action="{{ url('/add-cart') }}">
                                            @csrf

                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <input type="hidden" name="name" value="{{ $item->product_name }}">
                                            <input type="hidden" name="qty" value="1">
                                            <input type="hidden" name="price" value="{{ $item->selling_price }}">

                                            <td>{{ $key+1 }}</td>
                                            <td> <img src="{{ asset($item->product_image) }}" style="width:50px; height: 40px;"> </td>
                                            <td>{{ $item->product_name }}</td>
                                            <td><button type="submit" style="font-size: 20px; color: #000;"> <i class="fas fa-plus-square"></i> </button> </td>


                                        </form>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- end settings content-->

                    </div> <!-- end card-->

                </div> <!-- end col -->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->










    @endsection