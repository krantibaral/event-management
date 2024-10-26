<div class="form-group row">
    <div class="col-md-12">
        <label for="">Name *</label>
        <input type="text" required class="form-control" name="name" value="{{ old('name', $item->name) }}"
            placeholder="Enter name">
    </div>
</div>

<div class="form-group row">
    <div class="col-md-12">
        <label for="">Email *</label>
        <input type="email" required class="form-control" name="email" value="{{ old('email', $item->email) }}"
            placeholder="Enter email">
    </div>
</div>

<div class="form-group row">
    <div class="col-md-12">
        <label for="">Event *</label>
        <select required class="form-control" name="event_id">
            <option value="">Select Event</option>
            @foreach($events as $eventId => $eventName)
                <option value="{{ $eventId }}" {{ old('event_id', $item->event_id ?? '') == $eventId ? 'selected' : '' }}>
                    {{ $eventName }}
                </option>
            @endforeach
        </select>
    </div>
</div>
