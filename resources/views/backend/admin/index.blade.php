@extends('backend.admin.layouts.app')
@section('content')
<h2>This is admin dashboard.</h2>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info" style="padding: 11px 0;">
              <div class="inner">
                <h6>Customers</h6>

                
              </div>
              <div class="icon">
              <i class="fas fa-solid fa-users"></i>
              </div>
              <a href="{{route('admin.users')}}" class="small-box-footer" >View <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success" style="padding: 11px 0;">
              <div class="inner">
                <h6>Agents<sup style="font-size: 20px"></sup></h6>

                
              </div>
              <div class="icon">
            <i class="fas fa-solid fa-user-tie"></i>
              </div>
              <a href="{{route('admin.agents')}}" class="small-box-footer" >View <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box " style="padding: 11px 0; background: #83CFE5;">
              <div class="inner">
                <h6>Units</h6>

                
              </div>
              <div class="icon">
				<i class="fas fa-home"></i>

              </div>
              <a href="{{route('admin.units')}}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary" style="padding: 11px 0;">
              <div class="inner">
                <h6>Submitted units</h6>

                
              </div>
              <div class="icon">
				<i class="fas fa-file-alt"></i>
              </div>
              <a href="{{route('admin.userunits')}}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
@endsection