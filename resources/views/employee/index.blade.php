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
                        <tbody>
                            @php $count = 0 @endphp
                            @foreach($employees as $employee)
                            @php $count++ @endphp
                            <tr>
                                <td>{{ $count++}}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td><span class="badge bg-primary text-light">{{ $employee->active ? 'Active' : 'Inactive' }}</span></td>

                                <td>{{ $employee->created_at->diffForHumans() }}</td>
                                <td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-id="11" data-name="Developer" data-permission="edit-employee, add-employee, delete-employee, view-employee, shuvo">
                                                <i class="fa fa-eye"></i>
                                          </button>

                                            <a href="{{ route('employee.edit',$employee->slug) }}" class="btn btn-sm btn-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                                <i class="fa fa-pencil-alt"></i>
                                            
                                            </a><a href="#" onclick="deleteData(event,id)" class="btn btn-sm btn-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </td>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
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

