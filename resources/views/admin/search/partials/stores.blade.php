<div class="table-responsive">
    <table class="table table-hover table-centered mb-0">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Category</th>
                <th>Network</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stores as $store)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('storage/stores/' . $store->image) }}"
                             class="rounded me-2"
                             alt="{{ $store->name }}"
                             width="40"
                             height="40"
                             onerror="this.onerror=null;this.src='{{ asset('assets/img/no-image-found.png') }}'"
                             loading="lazy">
                        <div>
                            <h6 class="mb-0">{{ $store->name }}</h6>
                            <small class="text-muted d-block">Slug: {{ $store->slug }}</small>
                        </div>
                    </div>
                </td>
                <td><small>{{ $store->category->name ?? 'N/A' }}</small></td>
                <td><small>{{ $store->network->name ?? 'N/A' }}</small></td>
                <td>
                    <span class="badge bg-{{ $store->status == '1' ? 'success' : 'danger' }}-subtle text-{{ $store->status == '1' ? 'success' : 'danger' }} rounded-pill">
                        {{ $store->status == '1' ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="{{ route('admin.store.show', $store->id) }}"
                           class="btn btn-sm btn-outline-info rounded-3 px-2"
                           data-bs-toggle="tooltip"
                           title="View Store">
                            <i class="mdi mdi-eye"></i>
                        </a>
                        <a href="{{ route('admin.store.edit', $store->id) }}"
                           class="btn btn-sm btn-outline-primary rounded-3 px-2"
                           data-bs-toggle="tooltip"
                           title="Edit Store">
                            <i class="mdi mdi-pencil"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-3 text-muted">
                    <i class="mdi mdi-store-off"></i> No stores found
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if(isset($stores) && method_exists($stores, 'links'))
    <div class="mt-3">
        {{ $stores->links() }}
    </div>
    @endif
</div>