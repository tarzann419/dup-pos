<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->


        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>


                <li>
                    <a href="{{ url('/dashboard') }}" class="active">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboard </span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('pos') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Sales system</span>
                    </a>
                </li>

                <li class="menu-title mt-2">Apps</li>


                <li>
                    <a href="#sidebarStock" data-bs-toggle="collapse">
                        <i class="mdi mdi-book-account-outline"></i>
                        <span> Stock Manage </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarStock">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('stock.manage') }}">Stock Details </a>
                            </li>
                            <li>
                                <a href="{{ route('stock.configure') }}">Stock Configure </a>
                            </li>

                        </ul>
                    </div>
                </li>

                
                <li>
                    <a href="#sidebarOrders" data-bs-toggle="collapse">
                        <i class="mdi mdi-book-account-outline"></i>
                        <span> Orders </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarOrders">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('pending.order') }}">Pending Orders </a>
                            </li>

                            <li>
                                <a href="{{ route('complete.order') }}">Complete Orders </a>
                            </li>

                    

                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarContacts" data-bs-toggle="collapse">
                        <i class="mdi mdi-book-account-outline"></i>
                        <span>Customer Management </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarContacts">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.customer') }}">All Customer</a>
                            </li>
                            <li>
                                <a href="{{ route('add.customer') }}">Add Customer</a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li>
                    <a href="#sidebarEmail" data-bs-toggle="collapse">
                        <i class="mdi mdi-email-multiple-outline"></i>
                        <span> Supplier Manage </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEmail">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.supplier') }}">All Supplier</a>
                            </li>
                            <li>
                                <a href="{{ route('add.supplier') }}">Add Supplier</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#category" data-bs-toggle="collapse">
                        <i class="mdi mdi-email-multiple-outline"></i>
                        <span> Category </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="category">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.category') }}">All Category </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#product" data-bs-toggle="collapse">
                        <i class="mdi mdi-email-multiple-outline"></i>
                        <span> Products </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="product">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.product') }}">All Product </a>
                            </li>

                            <li>
                                <a href="{{ route('add.product') }}">Add Product </a>
                            </li>
                            {{--<li>
                                <a href="{{ route('import.product') }}">Import Product </a>
                            </li>--}}

                        </ul>
                    </div>
                </li>




            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>