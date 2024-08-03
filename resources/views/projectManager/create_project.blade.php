<!DOCTYPE html>
<html lang="en">

@include('projectManager.css')

<body>
    <div class="main-wrapper">
        @include('projectManager.sidebar')

        <div class="page-wrapper">
            @include('projectManager.header')

            <div class="page-content" style="margin-left:100px">
                <div class="row profile-body">
                    <div class="col-md-8 col-xl-9 middle-wrapper">
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h6>Create New Project</h6>

                                        <form action="{{ url('create_project_post') }}" method="POST">
                                            @csrf

                                            <div class="form-group">
                                                <label for="project_name">Project Name</label>
                                                <input type="text" class="form-control" id="project_name" name="project_name" required>

                                                @error('project_name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" id="description" name="description" required></textarea>

                                                @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="category_id">Category</label>
                                                <select class="form-control" id="category_id" name="category_id" required>
                                                    <option value="">Select category by clickin here</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                                    @endforeach
                                                </select>
                                                
                                                @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="start_date">Start Date</label>
                                                <input type="date" class="form-control" id="start_date" name="start_date" required>

                                                @error('start_date')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="deadline">Deadline</label>
                                                <input type="date" class="form-control" id="deadline" name="deadline" required>

                                                @error('deadline')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <button type="submit" class="btn btn-primary">Create Project</button>
                                            <a href="{{ route('projectManager.dashboard') }}" class="btn btn-secondary">Cancel</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-none d-xl-block col-xl-3">
                        <div class="row">
                            
                        </div>
                    </div>
                </div>
            </div>

            @include('projectManager.footer')
        </div>
    </div>

    @include('projectManager.js')
</body>

</html>
