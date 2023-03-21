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
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>QTY</th>
                                    <th>SubTotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Mark</td>
                                    <td><input type="number" value="0" style="width: 40px;" min="1"></td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                    <td><a href=""> <i class="fas fa-trash-alt" style="color: #000;"></i></a></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="bg-primary">
                        <br>
                        <p style="font-size: 18px; color:#000;">Quantity : 3443</p>
                        <p style="font-size: 18px; color:#000;">Subtotal : 3443</p>
                        <p style="font-size: 18px; color:#000;">VAT : 3443</p>
                        <p><h2>Total :</h2><h1 class="text-black">3443</h1></p>
                        <br>
                    </div>

                    <form action="">
                        
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
                                        <th></th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach($product as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td> <img src="{{ asset($item->product_image) }}" style="width:50px; height: 40px;"> </td>
                                        <td>{{ $item->product_name }}</td>
                                        <td><button type="submit" style="font-size: 20px; color: #000;"> <i class="fas fa-plus-square"></i></button></td>
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