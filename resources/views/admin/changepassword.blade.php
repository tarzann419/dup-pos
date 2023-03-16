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


        <div class="col-lg-8 col-xl-8">
            <div class="card">
                <div class="card-body">

                    <!-- end timeline content-->
                    <div class="tab-pane" id="settings">
                        <form method="post" action="{{ route('update.password') }}">
                            @csrf
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Old Password</label>
                                    <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="current_password" name="old_password">
                                    @error('old_password')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">New Password</label>
                                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password">
                                        @error('new_password')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Confirm New Password</label>
                                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                                    </div>
                                </div>


                            </div> <!-- end row -->


                            <div class="text-end">
                                <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save Changes `</button>
                            </div>
                        </form>
                    </div>
                    <!-- end settings content-->

                </div> <!-- end card-->

            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div> <!-- container -->

</div> <!-- content -->





@endsection