<!DOCTYPE html>
<html lang="en">
  @include('projectManager.css')

<body>
<div class="main-wrapper">

  <!-- partial:partials/_sidebar.html -->
  @include('projectManager.sidebar')

  <!-- partial -->

  <div class="page-wrapper">
    <!-- partial:partials/_navbar.html -->
    @include('projectManager.header')  

    <div class="page-content" style="margin-left:100px">
      <div class="col-md-8 col-xl-9 middle-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Assign Task</h6>
                <form class="forms-sample" method="POST" action="{{ url('assign_task_post', $task->id) }}">
                  @csrf

                  <!-- Task Name -->
                  <div class="mb-3">
                    <label class="form-label">Task Name</label>
                    <input type="text" class="form-control" value="{{ $task->name }}" readonly>
                  </div>

                  <!-- Select Developer -->
                  <div class="mb-3">
                    <label for="developer_id" class="form-label">Select Developer</label>
                    <div class="row">
                      @foreach($freeDevelopers as $developer)
                        <div class="col-md-6 mb-4">
                          <div class="card developer-card" data-developer-id="{{ $developer->id }}">
                            <div class="card-body">
                              <div class="form-check">
                                <input class="form-check-input developer-radio" type="radio" name="developer_id" id="developer_{{ $developer->id }}" value="{{ $developer->id }}" required>
                                <label class="form-check-label" for="developer_{{ $developer->id }}">
                                  <strong>{{ $developer->firstname }} {{ $developer->lastname }}</strong>
                                </label>
                              </div>
                              <div class="mt-3">
                                <label>Qualifications:</label>
                                <div class="row">
                                  @foreach($developer->qualifications->chunk(ceil($developer->qualifications->count() / 3)) as $chunk)
                                    <div class="col">
                                      <ul class="list-group">
                                        @foreach($chunk as $qualification)
                                          <li class="list-group-item">{{ $qualification->name }}</li>
                                        @endforeach
                                      </ul>
                                    </div>
                                  @endforeach
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>

                  <button type="submit" class="btn btn-primary me-2">Assign</button>
                  <a href="{{ route('projectManager.dashboard') }}" class="btn btn-secondary">Cancel</a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- partial:partials/_footer.html -->
    @include('projectManager.footer')  
    <!-- partial -->
  </div>
</div>

<!-- core:js -->
@include('projectManager.js')

<script>
  document.querySelectorAll('.developer-card').forEach(card => {
    card.addEventListener('click', function() {
      const radio = this.querySelector('.developer-radio');
      radio.checked = !radio.checked;
      document.querySelectorAll('.developer-card').forEach(otherCard => {
        if (otherCard !== this) {
          otherCard.querySelector('.developer-radio').checked = false;
        }
      });
    });
  });
</script>

</body>
</html>
