@foreach ($stores as $store)
<tr id="store-row-{{ $store->id }}">
    <!-- Checkbox -->
    <td class="text-center">
        <input type="checkbox" class="form-check-input select-checkbox" name="selected[]" value="{{ $store->id }}">
    </td>

    <!-- Index -->
    <td class="text-center">
        <small class="text-muted">{{ $loop->iteration }}</small>
    </td>

    <!-- Store ID -->
    <td class="text-center">
        <small class="fw-bold text-primary">#{{ $store->id }}</small>
    </td>

    <!-- Store Info (Name, Slug, Image) -->
    <td>
        <div class="d-flex align-items-center">
            <!-- Image -->
            <div class="me-3">
                <img src="{{ $store->image ? asset('uploads/stores/' . $store->image) : asset('images/default-store.png') }}"
                     alt="{{ $store->name }}"
                     class="store-image"
                     width="50"
                     height="50"
                     loading="lazy"
                     onerror="this.onerror=null;this.src='{{ asset('assets/img/no-image-found.png') }}'">
            </div>

            <!-- Name & Slug -->
            <div>
                <h6 class="mb-1 store-name fw-semibold">{{ $store->name }}</h6>
                <small class="text-muted d-block">
                    <i class="mdi mdi-link-variant me-1"></i>{{ $store->slug }}
                </small>
                @if($store->user)
                    <small class="text-primary">
                        <i class="mdi mdi-account-outline me-1"></i>By {{ $store->user->name }}
                    </small>
                @endif
            </div>
        </div>
    </td>

    <!-- Category -->
    <td>
        @if($store->category)
            <span class="badge bg-info text-white">
                <i class="mdi mdi-tag-outline me-1"></i>{{ $store->category->name }}
            </span>
        @else
            <span class="badge bg-light text-muted">N/A</span>
        @endif
    </td>

    <!-- Network -->
    <td>
        @if($store->network)
            <span class="badge bg-secondary text-white">
                <i class="mdi mdi-server-network me-1"></i>{{ $store->network->name }}
            </span>
        @else
            <span class="badge bg-light text-muted">N/A</span>
        @endif
    </td>

    <!-- Language -->
    <td>
        @if($store->language)
            <span class="badge bg-dark text-white">
                <i class="mdi mdi-translate me-1"></i>{{ $store->language->name }}
            </span>
        @else
            <span class="badge bg-light text-muted">N/A</span>
        @endif
    </td>

    <!-- Status -->
    <td class="text-center">
        @if($store->status)
            <span class="badge bg-success">
                <i class="mdi mdi-check-circle-outline me-1"></i>Active
            </span>
        @else
            <span class="badge bg-danger">
                <i class="mdi mdi-close-circle-outline me-1"></i>Inactive
            </span>
        @endif
    </td>

    <!-- Timeline -->
    <td>
        <div class="timeline-info">
            <small class="text-muted d-block">
                <i class="mdi mdi-calendar-plus me-1"></i>
                {{ $store->created_at->format('M d, Y') }}
            </small>

            @if ($store->updatedby)
                <small class="text-info d-block">
                    <i class="mdi mdi-account-edit me-1"></i>
                    {{ $store->updatedby->name }}
                </small>
            @endif

            <small class="text-muted d-block">
                <i class="mdi mdi-calendar-refresh me-1"></i>
                {{ $store->updated_at->format('M d, Y') }}
            </small>
        </div>
    </td>

    <!-- Actions -->
    <td class="text-center">
        <div class="btn-group btn-group-sm" role="group">
            <!-- Edit -->
            <a href="{{ route('admin.store.edit', $store->id) }}"
               class="btn btn-outline-primary rounded-start"
               data-bs-toggle="tooltip"
               title="Edit Store">
               <i class="mdi mdi-pencil-outline"></i>
            </a>

            <!-- Admin View -->
            <a href="{{ route('admin.store.show', $store->id) }}"
               class="btn btn-outline-success"
               data-bs-toggle="tooltip"
               title="View Coupons">
               <i class="mdi mdi-tag-multiple-outline"></i>
            </a>

            <!-- Front View -->
            <a href="{{ route('store.detail', $store->slug) }}"
               class="btn btn-outline-info"
               target="_blank"
               data-bs-toggle="tooltip"
               title="Preview Store">
               <i class="mdi mdi-eye-outline"></i>
            </a>

            <!-- Delete -->
            <button type="button"
                onclick="return confirm('Are you sure you want to delete this store?')"
                class="btn btn-outline-danger rounded-end delete-store-btn"
                data-id="{{ $store->id }}"
                data-bs-toggle="tooltip"
                title="Delete Store">
                <i class="mdi mdi-trash-can-outline"></i>
            </button>
        </div>
    </td>
</tr>
@endforeach
