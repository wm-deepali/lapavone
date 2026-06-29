@extends('layouts.app')
@section('content')

    <div class="dashboard-page-wrapper">

        <!-- DASHBOARD SECTION -->
        <section class="dashboard-section">
            <div class="lp-container">
                <div class="dashboard-layout">

                    @include('user._sidebar')


                    <!-- Dashboard Main Content -->
                    <main class="dashboard-main">
                        <button class="dashboard-sidebar-toggle">
                            <i class="fa-solid fa-bars"></i> Menu
                        </button>

                        <div class="orders-header dashboard-content-header">
                            <h1 class="orders-title">MY PROFILE</h1>
                            <p class="orders-subtitle">Manage your personal information and security</p>
                        </div>

                        <div class="profile-details-wrapper">

                            {{-- Personal Information Card --}}
                            <div class="profile-card">
                                <h3 class="profile-card-title">Personal Information</h3>

                                <form action="{{ route('user.profile.update') }}" method="POST" id="profile-form" class="profile-form">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-row">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="first_name"
                                                value="{{ old('first_name', $customer->first_name) }}"
                                                class="lp-input profile-field" >
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="last_name"
                                                value="{{ old('last_name', $customer->last_name) }}"
                                                class="lp-input profile-field" >
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email" name="email" value="{{ old('email', $customer->email) }}"
                                                class="lp-input profile-field" >
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="tel" name="mobile" value="{{ old('mobile', $customer->mobile) }}"
                                                class="lp-input profile-field" >
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <input type="date" name="dob"
                                                value="{{ old('dob', $customer->dob ? \Carbon\Carbon::parse($customer->dob)->format('Y-m-d') : '') }}"
                                                class="lp-input profile-field" >
                                        </div>
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select name="gender" class="lp-input profile-field" >
                                                <option value="">— Select —</option>
                                                @foreach (['male' => 'Male', 'female' => 'Female', 'other' => 'Other'] as $val => $label)
                                                    <option value="{{ $val }}" {{ old('gender', $customer->gender) === $val ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-actions" id="form-actions">

                                        {{-- Editing state: Save + Cancel (hidden by default) --}}
                                        <button type="submit" class="lp-btn lp-btn-solid" id="save-btn">Save
                                            Changes</button>
                                    </div>

                                </form>
                            </div>

                            <script>
                                const saveBtn = document.getElementById('save-btn');

                                // Store original values to restore on cancel
                                const originalValues = {};
                                fields.forEach(f => originalValues[f.name] = f.value);

                            </script>

                            {{-- Default Shipping Address Card --}}
                            <div class="profile-card">
                                <h3 class="profile-card-title">Default Shipping Address</h3>

                                @php
                                    $defaultAddress = $customer->addresses->firstWhere('is_default', true);
                                @endphp

                                @if ($defaultAddress)
                                    <div class="address-display">
                                        <p class="address-name">{{ $defaultAddress->name }}</p>

                                        <p class="address-line">{{ $defaultAddress->address_line_1 }}</p>

                                        @if ($defaultAddress->address_line_2)
                                            <p class="address-line">{{ $defaultAddress->address_line_2 }}</p>
                                        @endif

                                        <p class="address-line">
                                            {{ $defaultAddress->city?->name }},
                                            {{ $defaultAddress->state?->name }}
                                            {{ $defaultAddress->pincode }}
                                        </p>

                                        <p class="address-line">India</p>

                                        <p class="address-phone">T: {{ $defaultAddress->phone }}</p>
                                    </div>
                                @else
                                    <p class="text-muted">No default address set.</p>
                                @endif

                                <div class="form-actions mt-3">
                                    <a href="{{ route('user.addresses.index') }}" class="lp-btn lp-btn-outline">Manage
                                        Addresses</a>
                                </div>
                            </div>

                        </div>
                    </main>

                </div>
            </div>
        </section>

    </div>

@endsection