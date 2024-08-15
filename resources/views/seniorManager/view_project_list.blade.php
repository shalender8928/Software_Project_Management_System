<!DOCTYPE html>
<html lang="en">

@include('seniorManager.css')

<body>
<div class="main-wrapper">

<!-- partial:partials/_sidebar.html -->
   @include('seniorManager.sidebar')

<!-- partial -->

<div class="page-wrapper">
            
    <!-- partial:partials/_navbar.html -->
    
         @include('seniorManager.header')  


         <div class="page-content"  style="margin-left:50px">
         
         <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                        <th class="pt-0">S. NO</th>
                        <th class="pt-0">Category Name</th>
                        <th class="pt-0">Description</th>
                        <th class="pt-0">Created By</th>
                        <th class="pt-0"> Select View Project Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 0;
                        @endphp
                        @foreach($category as $datas)
                            @php
                                $count++;
                            @endphp
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{$datas->cat_name}}</td>
                                <td>{!! Str::limit($datas->description,30)!!}</td>
                                <td>{{ $datas->creator ? $datas->creator->firstname : 'N/A' }}</td>
                                

                      <td>
                        <a class="btn btn-info" href="{{url('view_projects_by_category',$datas->id)}}">Select</a>
                      </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>




         
         
         



         </div>
         <!-- partial:partials/_footer.html -->

    @include('seniorManager.footer') 

      <!-- partial -->
    </div>

  </div>

  <!-- core:js -->
  @include('seniorManager.js')

</body>
</html>