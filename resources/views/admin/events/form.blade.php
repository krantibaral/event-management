<div class="form-group row">
    <div class="col-md-12">
        <label for="title">Title *</label>
        <input type="text" required class="form-control" name="title" value="{{ old('title', $item->title ?? '') }}"
            placeholder="Enter event title">
    </div>
</div>



<div class="form-group row">
    <div class="col-md-6">
        <label for="date">Date *</label>
        <input type="date" required class="form-control" name="date" value="{{ old('date', $item->date ?? '') }}">
    </div>
    <div class="col-md-6">
        <label for="location">Location *</label>
        <input type="text" required class="form-control" name="location"
            value="{{ old('location', $item->location ?? '') }}" placeholder="Enter event location">
    </div>
</div>

<div class="form-group">
    <label for="category_id">Category *</label>
    <select class="form-control" name="category_id" id="category_id">
        <option value="">Select Category</option>
        @foreach ($categories as $categoryId => $categoryName)
            <option value="{{ $categoryId }}" {{ old('category_id', $item->category_id ?? '') == $categoryId ? 'selected' : '' }}>
                {{ $categoryName }}
            </option>
        @endforeach
    </select>
</div>
<div class="form-group row">
    <div class="col-md-12">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" rows="4"
            placeholder="Enter event description">{{ old('description', $item->description ?? '') }}</textarea>
    </div>
</div>