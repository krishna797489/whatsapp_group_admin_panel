@extends('layouts.main')
@section('content')

<div class="content-wrapper" style="width: 100vw">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" style="width: 100vw">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header text-end">
              
                 
              </div>
              <!-- /.card-header -->
              <div class="card-body p-3">
                <table class="table table-striped" id="category-details-list">
                  <thead>
                    <tr>
                      <th>#</th>
                     <th>Image</th>                  
                      <th>Category Name</th>
                     
                    </tr>
                  </thead>
                  <tbody> 
                  </tbody>
                </table>
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
      var table = $('#category-details-list').DataTable({         
      processing: true,
      serverSide: true,
      responsive: false,
    
      ajax: "{{ route('category.list') }}",
      columns: [
      { data: 'DT_RowIndex', name: 's.no'},
      { data: 'image', name: 'image'},      
      { data: 'category', name: 'category'},  
               
      ],
    //   order: [[1, 'desc']]
      });
    });
</script>


@endsection
