@extends('layouts.dashboard')

@section('title')
    LOA Center
@endsection

@section('content')
<div class="container-fluid" style="background-color:#F0F0F0;">
    &nbsp;
    <h2>LOA Management</h2>
    &nbsp;
</div>
<br>

<div class="container">
    <ul class="nav nav-tabs nav-justified" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" href="#new" role="tab" data-toggle="tab" style="color:black">New</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#info" role="tab" data-toggle="tab" style="color:black">More Info</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#accepted" role="tab" data-toggle="tab" style="color:black">Accepted</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#active" role="tab" data-toggle="tab" style="color:black">Active</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#inactive" role="tab" data-toggle="tab" style="color:black">Inactive</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#denied" role="tab" data-toggle="tab" style="color:black">Denied</a>
        </li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="new">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Controller</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Requested At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($pending) > 0)
                        @foreach ($pending as $loa)
                        <tr>
                            <td>{{$loa->controller_name}}</td>
                            <td>{{$loa->start_date}}</td>
                            <td>{{$loa->end_date}}</td>
                            <td>{{$loa->created_at}}</td>
                            <td>
                                <a class="btn btn-warning simple-tooltip"
                                    href="/dashboard/admin/loas/edit/{{ $loa->id }}" data-toggle="tooltip"
                                    title="View LOA"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <p>No pending LOA's</p>
                    @endif
                </tbody>
            </table>
        </div>

        <div role="tabpanel" class="tab-pane" id="info">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Controller</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Requested At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($info) > 0)
                        @foreach ($info as $loa)
                        <tr>
                            <td>{{$loa->controller_name}}</td>
                            <td>{{$loa->start_date}}</td>
                            <td>{{$loa->end_date}}</td>
                            <td>{{$loa->created_at}}</td>
                            <td>
                                <a class="btn btn-warning simple-tooltip"
                                    href="/dashboard/admin/loas/edit/{{ $loa->id }}" data-toggle="tooltip"
                                    title="View LOA"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <p>No LOA's that require more information.</p>
                    @endif
                </tbody>
            </table>
        </div>

        <div role="tabpanel" class="tab-pane" id="accepted">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Controller</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Requested At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($accepted) > 0)
                        @foreach ($accepted as $loa)
                        <tr>
                            <td>{{$loa->controller_name}}</td>
                            <td>{{$loa->start_date}}</td>
                            <td>{{$loa->end_date}}</td>
                            <td>{{$loa->created_at}}</td>
                            <td>
                                <a class="btn btn-warning simple-tooltip"
                                    href="/dashboard/admin/loas/edit/{{ $loa->id }}" data-toggle="tooltip"
                                    title="View LOA"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <p>No accepted LOA's</p>
                    @endif
                </tbody>
            </table>
        </div>

        <div role="tabpanel" class="tab-pane" id="active">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Controller</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Requested At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($active) > 0)
                        @foreach ($active as $loa)
                        <tr>
                            <td>{{$loa->controller_name}}</td>
                            <td>{{$loa->start_date}}</td>
                            <td>{{$loa->end_date}}</td>
                            <td>{{$loa->created_at}}</td>
                            <td>
                                <a class="btn btn-warning simple-tooltip"
                                    href="/dashboard/admin/loas/edit/{{ $loa->id }}" data-toggle="tooltip"
                                    title="View LOA"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <p>No active LOA's</p>
                    @endif
                </tbody>
            </table>
        </div>

        <div role="tabpanel" class="tab-pane" id="inactive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Controller</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Requested At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($inactive) > 0)
                        @foreach ($inactive as $loa)
                        <tr>
                            <td>{{$loa->controller_name}}</td>
                            <td>{{$loa->start_date}}</td>
                            <td>{{$loa->end_date}}</td>
                            <td>{{$loa->created_at}}</td>
                            <td>
                                <a class="btn btn-warning simple-tooltip"
                                    href="/dashboard/admin/loas/edit/{{ $loa->id }}" data-toggle="tooltip"
                                    title="View LOA"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <p>No inactive LOA's</p>
                    @endif
                </tbody>
            </table>
        </div>

        <div role="tabpanel" class="tab-pane" id="denied">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Controller</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Requested At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($denied) > 0)
                        @foreach ($denied as $loa)
                        <tr>
                            <td>{{$loa->controller_name}}</td>
                            <td>{{$loa->start_date}}</td>
                            <td>{{$loa->end_date}}</td>
                            <td>{{$loa->created_at}}</td>
                            <td>
                                <a class="btn btn-warning simple-tooltip"
                                    href="/dashboard/admin/loas/edit/{{ $loa->id }}" data-toggle="tooltip"
                                    title="View LOA"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <p>No inactive LOA's</p>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection