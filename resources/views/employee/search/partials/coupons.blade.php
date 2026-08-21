<div class="table-responsive">
    <table class="table table-hover table-centered mb-0">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Store Name</th>
                <th>Code</th>
                <th>Title</th>
                <th>Store</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($coupons as $coupon)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('employee.store.show', $coupon->store_id) }}" class="text-decoration-none">
                        <img src="{{ $coupon->stores->image_url }}"
                             class="rounded me-2"
                             alt="{{ $coupon->stores->name }}"
                             width="40"
                             height="40"
                             onerror="this.onerror=null;this.src='{{ asset('assets/img/no-image-found.png') }}'"
                             loading="lazy">
                    </a>
                    </div>
                </td>
                <td>
                    <a href="{{ route('employee.store.show', $coupon->store_id) }}" class="text-decoration-none">
                        {{ $coupon->stores->name ?? 'N/A' }}
                    </a>
                <td>
                    <span class="badge bg-info-subtle text-info">{{ $coupon->code }}</span>
                </td>
                <td>
                    <div>
                        <h6 class="mb-0">{{ $coupon->name ?? 'N/A' }}</h6>
                        @if($coupon->description)
                            <small class="text-muted">{{ Str::limit($coupon->description, 50) }}</small>
                        @endif
                    </div>
                </td>
                <td>
                    <a href="{{ route('employee.store.show', $coupon->store_id) }}" class="text-decoration-none">
                        {{ $coupon->store->name ?? 'N/A' }}
                    </a>
                </td>
                <td>
                    <span class="badge bg-{{ $coupon->status == '1' ? 'success' : 'danger' }}-subtle text-{{ $coupon->status == '1' ? 'success' : 'danger' }} rounded-pill">
                        {{ $coupon->status == '1' ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="{{ route('employee.coupon.edit', $coupon->id) }}"
                           class="btn btn-sm btn-outline-primary rounded-3 px-2"
                           data-bs-toggle="tooltip"
                           title="Edit Coupon">
                            <i class="mdi mdi-pencil"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-3 text-muted">
                    <i class="mdi mdi-tag-off"></i> No coupons found
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if(isset($coupons) && method_exists($coupons, 'links'))
    <div class="mt-3">
        {{ $coupons->links('vendor.pagination.bootstrap-5') }}
    </div>
    @endif
</div>