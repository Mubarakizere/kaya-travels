<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $trip?->title ?? '') }}" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Destination</label>
    <select name="destination_id" class="form-select" required>
      <option value="" disabled {{ !isset($trip) ? 'selected' : '' }}>Select Destination</option>
      @foreach(\App\Models\Destination::all() as $destination)
        <option value="{{ $destination->id }}" {{ old('destination_id', $trip?->destination_id ?? '') == $destination->id ? 'selected' : '' }}>
          {{ $destination->name }}
        </option>
      @endforeach
    </select>
  </div>
  <div class="col-md-4">
    <label class="form-label">Price (RWF)</label>
    <input type="number" name="price" class="form-control" value="{{ old('price', $trip?->price ?? '') }}" required>
  </div>
  <div class="col-md-4">
    <label class="form-label">Duration</label>
    <input type="text" name="duration" class="form-control" placeholder="e.g. 3 Days" value="{{ old('duration', $trip?->duration ?? '') }}" required>
  </div>
  <div class="col-md-4">
    <label class="form-label">Category</label>
    <select name="category" class="form-select" required>
      @foreach(['adventure','luxury','cultural','weekend'] as $cat)
        <option value="{{ $cat }}" {{ old('category', $trip?->category ?? '') == $cat ? 'selected' : '' }}>
          {{ ucfirst($cat) }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="col-12 mt-4"><h6 class="text-gold border-bottom pb-2 mb-3" style="font-size:0.85rem;font-weight:700;">Descriptions</h6></div>

  <div class="col-md-6">
    <label class="form-label">Short Description</label>
    <textarea name="short_description" class="form-control" rows="3">{{ old('short_description', $trip?->short_description ?? '') }}</textarea>
  </div>
  <div class="col-md-6">
    <label class="form-label">Full Description</label>
    <textarea name="full_description" class="form-control" rows="3">{{ old('full_description', $trip?->full_description ?? '') }}</textarea>
  </div>
  <div class="col-md-12">
    <label class="form-label">Itinerary <small class="text-muted text-lowercase">(each line = one day)</small></label>
    <textarea name="itinerary" class="form-control" rows="3">{{ old('itinerary', isset($trip) ? implode("\n", $trip?->itinerary ?? []) : '') }}</textarea>
  </div>

  <div class="col-12 mt-4"><h6 class="text-gold border-bottom pb-2 mb-3" style="font-size:0.85rem;font-weight:700;">Details & Options</h6></div>

  <div class="col-md-6">
    <label class="form-label">Inclusions <small class="text-muted text-lowercase">(one per line)</small></label>
    <textarea name="inclusions" class="form-control" rows="3">{{ old('inclusions', isset($trip) ? implode("\n", $trip?->inclusions ?? []) : '') }}</textarea>
  </div>
  <div class="col-md-6">
    <label class="form-label">Exclusions <small class="text-muted text-lowercase">(one per line)</small></label>
    <textarea name="exclusions" class="form-control" rows="3">{{ old('exclusions', isset($trip) ? implode("\n", $trip?->exclusions ?? []) : '') }}</textarea>
  </div>

  <div class="col-12 mt-3 p-3 bg-light rounded border">
    <div class="form-check form-switch mb-2">
      <input class="form-check-input" type="checkbox" role="switch" name="status" id="statusSwitch" {{ old('status', $trip?->status ?? true) ? 'checked' : '' }}>
      <label class="form-check-label ms-2" for="statusSwitch">Active (Visible to public)</label>
    </div>
    <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" role="switch" name="is_top" id="topSwitch" {{ old('is_top', $trip?->is_top ?? false) ? 'checked' : '' }}>
      <label class="form-check-label ms-2" for="topSwitch">Top Featured</label>
    </div>
  </div>
</div>
