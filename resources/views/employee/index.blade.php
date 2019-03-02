@extends('layouts.app')


@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('page-content')

    <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-fixed page-header-dark main-content-narrow">


        <!-- Sidebar -->
        @include('includes.sidebar')
        <!-- END Sidebar -->

        <!-- Header -->
        @include('includes.page-header')
        <!-- END Header -->

        <!-- Main Container -->
        <main id="main-container">

            <!-- Hero -->
            <div class="bg-body-light">
                <div class="content content-full">
                    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                        <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">All Employee</h1>
                        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                            <a href="{{ route('employee.create') }}" class="tn btn-hero-lg btn-square btn-hero-primary mr-1 mb-3"><i class="fa fa-fw fa-user mr-1"></i>
                                Add Employee
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- END Hero -->

            <!-- Page Content -->
            <div class="content">

                    <table class="table table-bordered" id="myTable"> 
                        <thead>
                            <tr>
                                <th>Sl-No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>

            </div>
            <!-- END Page Content -->

        </main>
        <!-- END Main Container -->

        <!-- Footer -->
        @include('includes.footer')
        <!-- END Footer -->
    </div>
       
@endsection


@section('scripts')
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).ready( function () {
            $('#myTable').DataTable({
                processing: true,
                    serverSide: true,
                    ajax: '{!! route('employee.data') !!}',
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'active', name: 'active' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'action', name: 'action' }
                ]
            });
        } );
    </script>

@endsection
