@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3></div>
                        @if (count($business) > 0)
                                <div class="panel-body">
                                    <table class="table table-striped task-table">

                                        <!-- Table Headings -->
                                        <thead>
                                        <th>Business</th>
                                        <th>&nbsp;</th>
                                        </thead>

                                        <!-- Table Body -->
                                        <tbody>
                                        @foreach ($business as $single_business)
                                            <tr>
                                                <!-- Business Name -->
                                                <td class="table-text">
                                                    <div>{{ $single_business->name }}</div>
                                                </td>

                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-3 col-sm-6">
                                                            <a href="{{url('/restaurant')}}"><button class="btn btn-default">
                                                                    <i class="fa fa-plus"></i> Add Restaurant
                                                                </button></a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> <button="submit" id="Edit-task-{{ $single_business->id }}" class="btn btn-danger">
                                                        <i class="fa fa-btn fa-trash"></i>Edit
                                                    </button>
                                                </td>

                                                <td>
                                                    <form action="{{ url('business/'.$single_business->id) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}

                                                        <button type="submit" id="delete-task-{{ $single_business->id }}" class="btn btn-danger">
                                                            <i class="fa fa-btn fa-trash"></i>Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection