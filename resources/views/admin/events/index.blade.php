@extends('admin.templates.index')

@section('title', $title)

@section('content_header')
    <h1>Event</h1>
@stop

@push('styles')
@endpush

@section('index_content')
    <div class="table-responsive">
        <table class="table" id="data-table">
            <thead>
                <tr class="text-left text-capitalize">
                    <th>id</th>
                    <th>title</th>

                    <th>date</th>
                    <th>location</th>
                    <th>action</th>
                </tr>
            </thead>

        </table>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            var table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('events.index') }}",
                columns: [{
                        data: 'id',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },

                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'location',
                        name: 'location'
                    },

                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
            });
        });
    </script>
@endpush
