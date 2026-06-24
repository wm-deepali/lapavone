<div class="form-row">
    <div class="form-group">
        <label>Full Name</label>
        <input type="text" name="name"
               value="{{ old('name', $address?->name) }}"
               class="lp-input @error('name') is-invalid @enderror" required>
        @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label>Phone</label>
        <input type="tel" name="phone"
               value="{{ old('phone', $address?->phone) }}"
               class="lp-input @error('phone') is-invalid @enderror" required>
        @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>
</div>

<div class="form-group">
    <label>Address Line 1</label>
    <input type="text" name="address_line_1"
           value="{{ old('address_line_1', $address?->address_line_1) }}"
           class="lp-input @error('address_line_1') is-invalid @enderror" required>
    @error('address_line_1') <span class="invalid-feedback">{{ $message }}</span> @enderror
</div>

<div class="form-group">
    <label>Address Line 2 <span class="text-muted">(optional)</span></label>
    <input type="text" name="address_line_2"
           value="{{ old('address_line_2', $address?->address_line_2) }}"
           class="lp-input @error('address_line_2') is-invalid @enderror">
    @error('address_line_2') <span class="invalid-feedback">{{ $message }}</span> @enderror
</div>

<div class="form-row">
    <div class="form-group">
        <label>State</label>
        <select name="state_id" class="lp-input @error('state_id') is-invalid @enderror" required>
            <option value="">— Select State —</option>
            @foreach ($states as $state)
                <option value="{{ $state->id }}"
                    {{ old('state_id', $address?->state_id) == $state->id ? 'selected' : '' }}>
                    {{ $state->name }}
                </option>
            @endforeach
        </select>
        @error('state_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label>City</label>
        <select name="city_id" class="lp-input @error('city_id') is-invalid @enderror" required>
            <option value="">— Select City —</option>
        </select>
        @error('city_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label>Pincode</label>
        <input type="text" name="pincode"
               value="{{ old('pincode', $address?->pincode) }}"
               class="lp-input @error('pincode') is-invalid @enderror" required>
        @error('pincode') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label>Address Type</label>
        <select name="address_type" class="lp-input @error('address_type') is-invalid @enderror" required>
            <option value="">— Select —</option>
            @foreach (['home' => 'Home', 'office' => 'Office', 'other' => 'Other'] as $val => $label)
                <option value="{{ $val }}"
                    {{ old('address_type', $address?->address_type) === $val ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('address_type') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>
</div>

<div class="form-group">
    <label class="lp-checkbox-label">
        <input type="checkbox" name="is_default" value="1"
               {{ old('is_default', $address?->is_default) ? 'checked' : '' }}>
        Set as default address
    </label>
</div>