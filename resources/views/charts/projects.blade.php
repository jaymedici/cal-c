
<div class="card card-success col-md-6">
        <div class="card-header">
            <h4 class="card-title">Project List</h4>
        </div>
        <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Project ID</th>
                    <th>Project Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($project as $projects)
                <tr>
                    <td>{{$projects->id}}</td>
                    <td>{{$projects->name}}</td>
                    <td><a class="pull-center" href="/projectData/{{$projects->id}}" role="button">View Data</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>

