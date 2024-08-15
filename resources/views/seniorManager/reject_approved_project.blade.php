<!DOCTYPE html>
<html lang="en">
<head>
    @include('seniorManager.css')
    <style>
        /* Form label styling */
        label {
            font-size: 16px;
            font-weight: 600;
            color: #555555;
            margin-bottom: 10px;
            display: block;
        }

        /* Form textarea styling */
        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border-radius: 4px;
            border: 1px solid #cccccc;
            transition: border-color 0.3s ease-in-out;
        }

        .form-control:focus {
            border-color: #007bff;
            outline: none;
            
        }

        /* Button styling */
        .btn-danger {
            background-color: #d9534f;
            color: #ffffff;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-danger:hover {
            background-color: #c9302c;
        }
    </style>
    
</head>
<body>
    <div class="main-wrapper">
        @include('seniorManager.sidebar')

        <div class="page-wrapper">
            @include('seniorManager.header')

            <div class="page-content">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                        <h6 class="card-title">Rereject Form for the <span style="color: aqua; font-weight:bolder">{{$projectPlan->name}}</span> Project Plan</h6>
                 <form action="{{ route('seniorManager.reject_approved_pp', $projectPlan->id) }}" method="POST">
                                 @csrf
                            <div class="form-group">
                              <label for="rejection_reason" style="font-weight: bold; font-size: 1.1rem; color: #333;">Rejection Reason</label>
                              <textarea name="rejection_reason" id="rejection_reason" class="form-control" required></textarea>
                          </div>
                   <div class="text-center" style="margin-top: 20px;">
                   <button type="submit" class="btn btn-danger">Reject</button>
                    </div>
                 </form>
                        </div>
                    </div>
                </div>
            </div>

            @include('seniorManager.footer')
        </div>
    </div>

    @include('seniorManager.js')
</body>
</html>