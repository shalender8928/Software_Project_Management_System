
<div class="page-content">

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
 
  
</div>

<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow-1">
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">PROJECT</h6>
              <div class="dropdown mb-2">
                <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item d-flex align-items-center" href="{{url('view_project_list')}}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>

   
                </div>
              </div>
            </div>
            <div class="row">
            <div class="col-6 col-md-12 col-xl-5">
            <h3 class="mb-2">{{ $projects }}</h3>
              </div>
             
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">PENDING TASK</h6>
              <div class="dropdown mb-2">
                <a type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <a class="dropdown-item d-flex align-items-center" href="{{url('view_project_list')}}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
      
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
              <h3 class="mb-2">{{ $pending}}</h3>
              
              </div>
             
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">COMPLETED TASK</h6>
              <div class="dropdown mb-2">
                <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                  <a class="dropdown-item d-flex align-items-center" href="{{url('view_project_list')}}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                 
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
              <h3 class="mb-2">{{ $completed }}</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- view in the index start
      
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0"> TASK</h6>
              <div class="dropdown mb-2">
                <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                  <a class="dropdown-item d-flex align-items-center" href="{{url('view_task_list')}}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                 
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
              <h3 class="mb-2"> {{ $tasks }}</h3>
              </div>
            </div>
          </div>
        </div>
      </div> -->

      <!-- view in the index End -->

      <!-- Project Managers Card -->
      <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">PROJECT MANAGERS</h6>
                <div class="dropdown mb-2">
                  <a type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('seniorManager.view_project_managers') }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5">
                  <h3 class="mb-2">{{ $projectManagerRole }}</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
   <!-- the end of the project manager -->


        <!-- Developers Card -->
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">DEVELOPERS</h6>
                <div class="dropdown mb-2">
                  <a type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('seniorManager.view_list_developere') }}" ><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5">
                  <h3 class="mb-2">{{ $developers }}</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End of new cards -->

    </div>
  </div>
</div> <!-- row -->



</div>

