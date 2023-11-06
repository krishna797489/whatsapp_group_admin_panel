@extends('layouts.main')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Groups</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Groups</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header text-end">             
                <!-- <button type="button" class="btn btn-info  m-l-15 text-white" data-bs-toggle="modal" data-bs-target="#add-games-modal" data-whatever="@mdo"><i class="fa fa-plus-circle"></i> Create New</button> -->
                            
              </div>
              <!-- /.card-header -->
              <div class="card-body p-3">
              <div class="table-responsive">
                <table class="table table-striped" id="games-details-list">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>                  
                       <th>Description</th>
                       <th>Image</th>
                       <th>Type</th>
                       <th>Group Link</th>
                       <th>Reports</th>
                       <th>Count</th>
                       <th>Status</th>
                    </tr>
                  </thead>
                  <tbody> 
                  </tbody>
                </table>
              </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div> 

 



  <script>
   $(document).ready(function () {         
  var table = $('#games-details-list').DataTable({         
    processing: true,
    serverSide: true,
    responsive: false,
    ajax: "{{ route('groups.list') }}",
    columns: [
      { data: 'DT_RowIndex', name: 's.no'},
      { data: 'name', name: 'name'},      
      { data: 'description', name: 'description'},  
      { data: 'image', name: 'image'},  
      { 
        data: function (row) {
          return row.is_link === 0 ? 'whatsapp' : 'Telegram';
        },
        name: 'is_link'
      },
      { data: 'link', name: 'link'},  
      { data: 'views', name: 'views'},
      { data: 'count', name: 'count'},
      { data: 'status', name: 'status'},
    ],
    //   order: [[1, 'desc']]
  });
});

</script>

<script>
  function changestatus(bid) {
      Swal.fire({
          title: 'Are you sure you want to change the status?',
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: 'Okay',
      }).then((result) => {
          if (result.isConfirmed) {
              // Get the CSRF token from the meta tag
              const csrfToken = $('meta[name="csrf-token"]').attr('content');
              $.ajax({
                  method: "POST",
                  url: '{{ route("groups.status") }}',
                  data: {
                      id: bid,
                      // Include the CSRF token in the request data
                      _token: csrfToken
                  },
                  success: function (data) {
                      if (data.error == 1) {                         
                      } else {                       
                           $('#games-details-list').DataTable().draw();
                          //location.reload();
                      }
                  },
              });
          } else if (result.isDenied) {
              // Handle denied action
          }
      });
  }
</script>
@endsection