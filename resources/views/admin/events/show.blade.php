@extends('admin.templates.show')
@push('styles')
@endpush
@section('form_content')
    <div class="row my-4">
        <div class="col-md-7">
            <div class="row form-group">
                <div class="col-md-3">
                    <label for=""><span class="show-text">Title:</span> </label><br>
                </div>
                <div class="col-md-8">
                    {{ $item->title }}
                </div>
            </div>

            <div class="row form-group">
                <div class="col-md-3">
                    <label for=""><span class="show-text">Location:</span> </label><br>
                </div>
                <div class="col-md-8">
                    {{ $item->location }}
                </div>
            </div>

            <div class="row form-group">
                <div class="col-md-3">
                    <label for=""><span class="show-text">Date:</span> </label><br>
                </div>
                <div class="col-md-8">
                    {{ $item->date }}
                </div>
            </div>

            <div class="row form-group">
                <div class="col-md-3">
                    <label for=""><span class="show-text">Category:</span> </label><br>
                </div>
                <div class="col-md-8">
                    {{ $item->category->name ?? 'N/A' }}
                </div>
            </div>

            <div class="row form-group">
                <div class="col-md-3">
                    <label for=""><span class="show-text">Description:</span> </label><br>
                </div>
                <div class="col-md-8">
                    {{ $item->description }}
                </div>
            </div>
        </div>
    </div>
@endsection
