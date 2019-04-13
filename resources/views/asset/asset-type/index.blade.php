@extends('layouts.app')


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
                        <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Asset Type</h1>
                        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                            <a href="{{ route('asset-type.create') }}" class="tn btn-hero-lg btn-square btn-hero-primary mr-1 mb-3"><i class="fa fa-fw fa-plus mr-1"></i>
                               Add Asset Type
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- END Hero -->

            <!-- Page Content -->
            <div class="content">
                @if(count($asset_types) > 0)
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Asset Type Table</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-settings"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="table-responsive">
                        <table class="table table-bordered table-striped table-vcenter" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Sl-No</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count = 0 @endphp
                                @foreach($asset_types as $asset_type)
                                @php $count++ @endphp
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ $asset_type->name }}</td>
                                    <td><em class="text-muted">{{ $asset_type->description ? $asset_type->description : 'No Description' }}</em></td>

                                      <td class="text-center">
                                          <div class="btn-group">
                                              <a href="{{ route('asset-type.edit',$asset_type->id) }}" class="btn btn-sm btn-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                                  <i class="fa fa-pencil-alt"></i>
                                              
                                              </a><a href="#" onclick="deleteData(event,{{ $asset_type->id }})" class="btn btn-sm btn-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete">
                                                  <i class="fa fa-times"></i>
                                              </a>
                                          </div>
                                      </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        <div class="row ">
                            <div class="col-sm-12 col-md-12 d-flex justify-content-end">
                                  {{ $asset_types->links() }}
                            </div>
                         </div>
                    </div>
                </div>
                @else
                  <h1 class="text-center">No Asset Type added yet.</h1>
                @endif
            </div>
            <!-- END Page Content -->

        </main>
        <!-- END Main Container -->

        <!-- Footer -->
        @include('includes.footer')
        <!-- END Footer -->
    </div>
       
@endsection


<script type="text/javascript">


    let dataTable = document.getElementById('myTable');
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
            url  : "{{ url('asset-type') }}" + '/' + id,
            type : "POST",
            data : {'_method' : 'DELETE', '_token' : csrf_token },
            cache: false,
            success: function (data) {
                $("#dataTable").load(location.href + " #dataTable"); 
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
