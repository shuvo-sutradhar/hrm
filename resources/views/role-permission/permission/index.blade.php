@extends('layouts.app')

@section('styles')

  <style type="text/css">
    .swal-footer {
      text-align: center !important;
    }
  </style>

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
                        <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">All Permission</h1>
                        @can('add-permission')
                        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                            <a href="{{ route('permission.create') }}" class="tn btn-hero-lg btn-square btn-hero-primary mr-1 mb-3"><i class="fa fa-fw fa-user mr-1"></i>
                                Add Permission
                            </a>
                        </nav>
                        @endcan
                    </div>
                </div>
            </div>
            <!-- END Hero -->

            <!-- Page Content -->
            @if(count($permissions) > 0)
            <div class="content">
                <div class="block block-rounded block-bordered">
                   <div class="block-header block-header-default">
                      <h3 class="block-title">Permission Table <small>Full</small></h3>
                   </div>
                   <div class="block-content block-content-full">
                      <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/be_tables_datatables.js -->
                      <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                         <div class="row">
                            <div class="col-sm-12 col-md-6">
                               <div class="dataTables_length" id="DataTables_Table_0_length">
                                  <label>
                                     <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-control">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                     </select>
                                  </label>
                               </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                               <div id="DataTables_Table_0_filter" class="dataTables_filter"><label><input type="search" class="form-control" placeholder="Search.." aria-controls="DataTables_Table_0"></label></div>
                            </div>
                         </div>
                         <div class="row">
                            <div class="col-sm-12">
                               <table id="table1" class="table table-bordered table-striped table-vcenter js-dataTable-full dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                  <thead>
                                     <tr role="row">
                                        <th class="text-center sorting_asc" style="width: 80px;" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">Name</th>
                                        <th class="d-none d-sm-table-cell sorting" style="width: 30%;" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Module</th>
                                        <th class="d-none d-sm-table-cell sorting" style="width: 15%;" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Registered: activate to sort column ascending">Registered</th>
                                        @can('edit-permission','delete-permission')
                                        <th style="width: 15%;" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Action</th>
                                        @endcan
                                     </tr>
                                  </thead>
                                  <tbody>
                                    @php $count = 0; @endphp
                                    @foreach($permissions as $permission)
                                    @php $count ++; @endphp
                                     <tr role="row" class="odd">
                                        <td class="text-center sorting_1">{{ $count }}</td>
                                        <td class="font-w600">
                                           <a href="be_pages_generic_blank.html">{{ $permission->name }}</a>
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                           <span class="badge badge-success">{{ $permission->module }}</span>
                                        </td>
                                        <td>
                                           <em class="text-muted">{{ $permission->created_at->diffForHumans() }}</em>
                                        </td>

                                        @can('edit-permission','delete-permission')
                                        <td class="text-center">
                                            <div class="btn-group">
                                              @can('edit-permission')
                                                <a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-sm btn-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                              @endcan
                                              @can('delete-permission')
                                                <a href="#" onClick="deleteData(event,{{ $permission->id }})" class="btn btn-sm btn-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                              @endcan
                                            </div>
                                        </td>
                                        @endcan
                                     </tr>
                                    @endforeach
                                  </tbody>
                               </table>
                            </div>
                         </div>
                         <div class="row">
                            <div class="col-sm-12 col-md-5">
                               <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Page <strong>1</strong> of <strong>4</strong></div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                               <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                  <ul class="pagination">
                                     <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous"><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" class="page-link"><i class="fa fa-angle-left"></i></a></li>
                                     <li class="paginate_button page-item active"><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                     <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                     <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                     <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                     <li class="paginate_button page-item next" id="DataTables_Table_0_next"><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="5" tabindex="0" class="page-link"><i class="fa fa-angle-right"></i></a></li>
                                  </ul>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
            </div>
            @else 
                <h2 style="text-align: center;margin-top: 40px;">No permission added yet.</h2>
            @endif
            <!-- END Page Content -->

        </main>
        <!-- END Main Container -->

        <!-- Footer -->
        @include('includes.footer')
        <!-- END Footer -->
    </div>
       
@endsection



@section('scripts')
    
    <script type="text/javascript">

        let table1 = document.querySelector('.table1');
        //window.table1 = table1;

        function deleteData(event,id) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this imaginary file!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $.ajax({ 
                url  : "{{ url('permission') }}" + '/' + id,
                type : "POST",
                data : {'_method' : 'DELETE', '_token' : csrf_token },
                cache: false,
                success: function (data) {
                    $("#table1").load(location.href + " #table1"); 
                    swal({
                        title: "Delete Done!",
                        text: "You clicked the button!",
                        icon: "success",
                        button: "Done",
                    });
                },
                error: function() {
                    swal({
                        title: "Oops...",
                        text: data.message,
                        type: 'error',
                        timer: '1500'
                    })
                }
              });

            } else {
                swal("Your imaginary fill is safe!");
            }
            });
            event.preventDefault(); 
            event.stopPropagation();
        }
    </script>

@endsection
