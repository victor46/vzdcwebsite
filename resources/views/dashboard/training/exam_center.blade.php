@extends('layouts.dashboard')

@section('title')
Exam Center
@endsection

@section('content')
<div class="container-fluid" style="background-color:#F0F0F0;">
    &nbsp;
    <h2>Exam Center</h2>
    &nbsp;
</div>
<br>
<div class="container">
    <ul class="nav nav-tabs nav-justified" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" href="#pending" role="tab" data-toggle="tab" style="color:black">Pending
                Requests</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#accepted" role="tab" data-toggle="tab" style="color:black">Accepted Requests</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#assigned" role="tab" data-toggle="tab" style="color:black">Assigned Requests</a>
        </li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="pending">
            @if(count($pending) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Student</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Exam Requested</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pending as $entry)
                    <tr>
                        <td>{{ $entry->student_name }}</td>
                        <td>{{ $entry->student_rating }}</td>
                        <td>{{ $entry->exam_name }}</td>
                        <td>
                            <a class="btn btn-success simple-tooltip"
                                href="/dashboard/training/exams/accept/{{ $entry->id }}" data-toggle="tooltip"
                                title="Accept Exam Request"><i class="fas fa-check"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No pending exam requests.</p>
            @endif
        </div>

        <div role="tabpanel" class="tab-pane" id="accepted">
            @if(count($accepted) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Student</th>
                        <th scope="col">Instructor</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Exam Requested</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accepted as $entry)
                    <tr>
                        <td>{{ $entry->student_name }}</td>
                        <td>{{ $entry->instructor_name }}</td>
                        <td>{{ $entry->student_rating }}</td>
                        <td>{{ $entry->exam_name}}</td>
                        <td>
                            <a href="#assignmodal" class="btn btn-primary" data-toggle="model"
                                data-target="#assignmodel">
                                Assign Exam <i class="fas fa-check"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No accepted exam requests.</p>
            @endif
        </div>

        <div role="tabpanel" class="tab-pane" id="assigned">
            @if(count($assigned) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Student</th>
                        <th scope="col">Instructor</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Exam Requested</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assigned as $entry)
                    <tr>
                        <td>{{ $entry->student_name }}</td>
                        <td>{{ $entry->instructor_name }}</td>
                        <td>{{ $entry->student_rating }}</td>
                        <td>{{ $entry->exam_name}}</td>
                        <td>
                            <a class="btn btn-danger simple-tooltip"
                                href="/dashboard/training/exams/delete/{{ $entry->id }}" data-toggle="tooltip"
                                title="Delete Exam Assignment"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No assigned exam requests.</p>
            @endif
        </div>
    </div>
</div>

<!-- Models -->
<div class="modal fade" id="assignmodal" tabindex="-1" role="dialog" aria-labelledby="assignmodeltitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignmodeltitle">Confirm Exam Assignment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="exams">Select Exam</label>
                        <select class="form-control" id="exams" name="exams">
                            <option>Washington Basic</option>
                            <option>Washington S2 Knowledge</option>
                            <option>Washington S2 Major Facilities</option>
                            <option>Washington S3 Knowledge</option>
                            <option>Washington S3 Chesapeake (CHP)</option>
                            <option>Washington S3 Mount Vernon (MTV)</option>
                            <option>Washington S3 Shenandoah (SHD)</option>
                            <option>Washington C1 Knowledge</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection