@extends('layouts.app')

@section('title', 'My Addresses - E-Commerce Store')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/profile/addresses.css') }}">
@endsection

@section('content')
<section>
    <div>
        <a href="{{ route('profile.index') }}">← Back to Profile</a>
        <h2>My Addresses</h2>
    </div>
</section>

<section>
    <h3>Add New Address</h3>
    <form method="POST" action="{{ route('profile.addresses.store') }}">
        @csrf

        <div>
            <label for="address_line1">Address Line 1:</label>
            <input type="text" id="address_line1" name="address_line1" value="{{ old('address_line1') }}" required>
            @error('address_line1')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="address_line2">Address Line 2 (optional):</label>
            <input type="text" id="address_line2" name="address_line2" value="{{ old('address_line2') }}">
            @error('address_line2')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="city">City:</label>
            <input type="text" id="city" name="city" value="{{ old('city') }}" required>
            @error('city')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="state">State/Province:</label>
            <input type="text" id="state" name="state" value="{{ old('state') }}" required>
            @error('state')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="postal_code">Postal Code:</label>
            <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code') }}" required>
            @error('postal_code')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="country">Country:</label>
            <input type="text" id="country" name="country" value="{{ old('country') }}" required>
            @error('country')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>
                <input type="checkbox" name="is_default" value="1" {{ old('is_default') ? 'checked' : '' }}>
                Set as default address
            </label>
        </div>

        <button type="submit">Add Address</button>
    </form>
</section>

<section>
    <h3>Saved Addresses</h3>
    @if($addresses->count() > 0)
        <div>
            @foreach($addresses as $address)
            <article>
                <div>
                    <h4>
                        {{ $address->address_line1 }}
                        @if($address->is_default)
                            <span>(Default)</span>
                        @endif
                    </h4>
                    @if($address->address_line2)
                        <p>{{ $address->address_line2 }}</p>
                    @endif
                    <p>{{ $address->city }}, {{ $address->state }} {{ $address->postal_code }}</p>
                    <p>{{ $address->country }}</p>
                </div>

                <div>
                    <button onclick="document.getElementById('edit-form-{{ $address->id }}').style.display='block'">Edit</button>
                    <form method="POST" action="{{ route('profile.addresses.destroy', $address->id) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this address?')">Delete</button>
                    </form>
                </div>

                <div id="edit-form-{{ $address->id }}" style="display:none;">
                    <h4>Edit Address</h4>
                    <form method="POST" action="{{ route('profile.addresses.update', $address->id) }}">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="edit_address_line1_{{ $address->id }}">Address Line 1:</label>
                            <input type="text" id="edit_address_line1_{{ $address->id }}" name="address_line1" value="{{ $address->address_line1 }}" required>
                        </div>

                        <div>
                            <label for="edit_address_line2_{{ $address->id }}">Address Line 2:</label>
                            <input type="text" id="edit_address_line2_{{ $address->id }}" name="address_line2" value="{{ $address->address_line2 }}">
                        </div>

                        <div>
                            <label for="edit_city_{{ $address->id }}">City:</label>
                            <input type="text" id="edit_city_{{ $address->id }}" name="city" value="{{ $address->city }}" required>
                        </div>

                        <div>
                            <label for="edit_state_{{ $address->id }}">State:</label>
                            <input type="text" id="edit_state_{{ $address->id }}" name="state" value="{{ $address->state }}" required>
                        </div>

                        <div>
                            <label for="edit_postal_code_{{ $address->id }}">Postal Code:</label>
                            <input type="text" id="edit_postal_code_{{ $address->id }}" name="postal_code" value="{{ $address->postal_code }}" required>
                        </div>

                        <div>
                            <label for="edit_country_{{ $address->id }}">Country:</label>
                            <input type="text" id="edit_country_{{ $address->id }}" name="country" value="{{ $address->country }}" required>
                        </div>

                        <div>
                            <label>
                                <input type="checkbox" name="is_default" value="1" {{ $address->is_default ? 'checked' : '' }}>
                                Set as default
                            </label>
                        </div>

                        <button type="submit">Update Address</button>
                        <button type="button" onclick="document.getElementById('edit-form-{{ $address->id }}').style.display='none'">Cancel</button>
                    </form>
                </div>
            </article>
            @endforeach
        </div>
    @else
        <p>You don't have any saved addresses yet.</p>
    @endif
</section>
@endsection