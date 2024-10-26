@extends('layouts.app')

@section('content')
<div class="container-fluid" style="height: 100vh; padding: 0;">
    <div class="row justify-content-center align-items-center" style="height: 100%;">
        <div class="col-md-10">
            <div class="card h-100">
                <div class="card-header">{{ __('Upcoming Events') }}</div>

                <div class="card-body">
                  

                    @if($upcomingEvents->isEmpty())
                        <p>No upcoming events found.</p>
                    @else
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Location</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($upcomingEvents as $event)
                                    <tr>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ $event->date }}</td> 
                                        <td>{{ $event->location }}</td>
                                        <td>
                                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-info btn-sm">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
