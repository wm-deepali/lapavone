@extends('layouts.app')
@section('content')

<style>
    .lp-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }
    .lp-modal {
        background: #fff;
        border-radius: 12px;
        width: 100%;
        max-width: 580px;
        max-height: 90vh;
        overflow-y: auto;
        padding: 1.5rem;
    }
    .lp-modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.25rem;
    }
    .lp-modal-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
    }
    .lp-modal-close {
        background: none;
        border: none;
        font-size: 22px;
        cursor: pointer;
        line-height: 1;
        color: #666;
    }
</style>

<div class="orders-page-wrapper">
    <section class="dashboard-section">
        <div class="lp-container">
            <div class="dashboard-layout">

                @include('user._sidebar')

                <main class="dashboard-main">
                    <button class="dashboard-sidebar-toggle">
                        <i class="fa-solid fa-bars"></i> Menu
                    </button>

                    <div class="orders-header dashboard-content-header">
                        <h1 class="orders-title">MY ADDRESSES</h1>
                        <p class="orders-subtitle">Manage your shipping and billing addresses</p>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="addresses-grid">

                        <div class="address-card address-card-add-new" id="btn-open-add-modal">
                            <i class="fa-solid fa-plus add-new-icon"></i>
                            <span class="add-new-text">Add New Address</span>
                        </div>

                        @foreach ($addresses as $address)
                            <div class="address-card">
                                @if ($address->is_default)
                                    <div class="address-card-badge">Default Shipping</div>
                                @endif
                                <div class="address-header">
                                    <h3 class="address-name-display">
                                        {{ $address->name }}
                                        <span class="address-type-tag">{{ ucfirst($address->address_type) }}</span>
                                    </h3>
                                </div>
                                <div class="address-body">
                                    <p>{{ $address->address_line_1 }}</p>
                                    @if ($address->address_line_2)
                                        <p>{{ $address->address_line_2 }}</p>
                                    @endif
                                    <p>{{ $address->city?->name }}, {{ $address->state?->name }} {{ $address->pincode }}</p>
                                    <p>India</p>
                                    <p style="margin-top: 10px;">Phone: {{ $address->phone }}</p>
                                </div>
                                <div class="address-footer">
                                    <button class="btn-address-action btn-edit-address" data-id="{{ $address->id }}">
                                        Edit
                                    </button>
                                    @unless ($address->is_default)
                                        <form action="{{ route('user.addresses.default', $address->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn-address-action">Set as Default</button>
                                        </form>
                                    @endunless
                                    <form action="{{ route('user.addresses.destroy', $address->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this address?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-address-action btn-address-delete">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </main>

            </div>
        </div>
    </section>

    {{-- ADD MODAL --}}
    <div class="lp-modal-overlay" id="add-modal" style="display:none;">
        <div class="lp-modal">
            <div class="lp-modal-header">
                <h3>Add New Address</h3>
                <button class="lp-modal-close" id="btn-close-add-modal">&times;</button>
            </div>
            <form action="{{ route('user.addresses.store') }}" method="POST">
                @csrf
                @include('user._address-form', ['address' => null, 'states' => $states])
                <div class="form-actions mt-3">
                    <button type="submit" class="lp-btn lp-btn-solid">Save Address</button>
                    <button type="button" class="lp-btn lp-btn-outline" id="btn-cancel-add-modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    {{-- EDIT MODAL --}}
    <div class="lp-modal-overlay" id="edit-modal" style="display:none;">
        <div class="lp-modal">
            <div class="lp-modal-header">
                <h3>Edit Address</h3>
                <button class="lp-modal-close" id="btn-close-edit-modal">&times;</button>
            </div>
            <form id="edit-address-form" method="POST">
                @csrf
                @method('PUT')
                @include('user._address-form', ['address' => null, 'states' => $states])
                <div class="form-actions mt-3">
                    <button type="submit" class="lp-btn lp-btn-solid">Update Address</button>
                    <button type="button" class="lp-btn lp-btn-outline" id="btn-cancel-edit-modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    const addModal  = document.getElementById('add-modal');
    const editModal = document.getElementById('edit-modal');

    function openModal(el)  { el.style.display = 'flex'; }
    function closeModal(el) { el.style.display = 'none'; }

    document.getElementById('btn-open-add-modal').addEventListener('click', () => openModal(addModal));
    document.getElementById('btn-close-add-modal').addEventListener('click', () => closeModal(addModal));
    document.getElementById('btn-cancel-add-modal').addEventListener('click', () => closeModal(addModal));
    document.getElementById('btn-close-edit-modal').addEventListener('click', () => closeModal(editModal));
    document.getElementById('btn-cancel-edit-modal').addEventListener('click', () => closeModal(editModal));

    [addModal, editModal].forEach(modal => {
        modal.addEventListener('click', e => { if (e.target === modal) closeModal(modal); });
    });

    document.querySelectorAll('.btn-edit-address').forEach(btn => {
        btn.addEventListener('click', async () => {
            const id = btn.dataset.id;
            const res = await fetch(`/user/addresses/${id}/edit`);
            const { address, cities } = await res.json();

            const form = document.getElementById('edit-address-form');
            form.action = `/user/addresses/${id}`;

            ['name', 'phone', 'address_line_1', 'address_line_2', 'pincode'].forEach(field => {
                const el = form.querySelector(`[name="${field}"]`);
                if (el) el.value = address[field] ?? '';
            });

            form.querySelector('[name="state_id"]').value = address.state_id;

            const citySelect = form.querySelector('[name="city_id"]');
            citySelect.innerHTML = cities.map(c =>
                `<option value="${c.id}" ${c.id == address.city_id ? 'selected' : ''}>${c.name}</option>`
            ).join('');

            form.querySelector('[name="address_type"]').value = address.address_type;

            const defCheckbox = form.querySelector('[name="is_default"]');
            if (defCheckbox) defCheckbox.checked = !!address.is_default;

            openModal(editModal);
        });
    });

    document.querySelectorAll('[name="state_id"]').forEach(stateSelect => {
        stateSelect.addEventListener('change', async function () {
            const citySelect = this.closest('form').querySelector('[name="city_id"]');
            citySelect.innerHTML = '<option value="">Loading...</option>';
            const res = await fetch(`/user/addresses/cities?state_id=${this.value}`);
            const cities = await res.json();
            citySelect.innerHTML = '<option value="">— Select City —</option>' +
                cities.map(c => `<option value="${c.id}">${c.name}</option>`).join('');
        });
    });
</script>

@endsection