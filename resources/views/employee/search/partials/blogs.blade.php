<div class="table-responsive">
    <table class="table table-hover table-centered mb-0">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Status</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($blogs as $blog)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <div class="d-flex align-items-center">
                        <img src="{{ $blog->image_url }}"
                             class="rounded me-2"
                             alt="{{ $blog->name }}"
                             width="40"
                             height="40"
                             onerror="this.onerror=null;this.src='{{ asset('assets/img/no-image-found.png') }}'"
                             loading="lazy">
                    </div>
                </td>
                <td>
                    <div>
                        <h6 class="mb-0">{{ $blog->name }}</h6>
                        @if($blog->excerpt)
                            <small class="text-muted">{{ Str::limit($blog->excerpt, 80) }}</small>
                        @endif
                    </div>
                </td>
                <td>
                    <span class="badge bg-{{ $blog->status == '1' ? 'success' : 'danger' }}-subtle text-{{ $blog->status == '1' ? 'success' : 'danger' }} rounded-pill">
                        {{ $blog->status == '1' ? 'Published' : 'Draft' }}
                    </span>
                </td>
                <td>
                    <small>
                        {{ $blog->created_at->setTimezone('Asia/Karachi')->format('M j, Y') }}
                    </small>
                </td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="{{ route('employee.blog.edit', $blog->id) }}"
                           class="btn btn-sm btn-outline-primary rounded-3 px-2"
                           data-bs-toggle="tooltip"
                           title="Edit Blog">
                            <i class="mdi mdi-pencil"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-3 text-muted">
                    <i class="mdi mdi-post-outline"></i> No blogs found
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if(isset($blogs) && method_exists($blogs, 'links'))
    <div class="mt-3">
        {{ $blogs->links('vendor.pagination.bootstrap-5') }}
    </div>
    @endif
</div>