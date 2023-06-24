@extends('admin_dashboard')
@section('admin')

<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">

                        </ol>
                    </div>
                    <h4 class="page-title">Product Configure</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">


                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach($product as $key=> $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->product_name }}</td>
                                    <form action="{{ route('update.configure') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <td>
                                            <input type="text" value="{{ $item->product_store }}" name="product_store">
                                            <button type="submit" onclick="confirm('ARE YOU SURE YOU WANT TO UPDATE THIS STOCK?')" class="btn btn-primary"> save</button>
                                        </td>

                                    </form>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->




    </div> <!-- container -->

</div> <!-- content -->


@endsection