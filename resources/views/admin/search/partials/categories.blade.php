<div class="table-responsive">
    <table class="table table-hover table-centered mb-0">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <div>
                        <h6 class="mb-0">{{ $category->name }}</h6>
                    </div>
                </td>
                <td><small>{{ $category->slug }}</small></td>
                <td>
                    @if($category->description)
                        <small class="text-muted">{{ Str::limit($category->description, 60) }}</small>
                    @else
                        <span class="text-muted">N/A</span>
                    @endif
                </td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="{{ route('admin.category.edit', $category->id) }}"
                           class="btn btn-sm btn-outline-primary rounded-3 px-2"
                           data-bs-toggle="tooltip"
                           title="Edit Category">
                            <i class="mdi mdi-pencil"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-3 text-muted">
                    <i class="mdi mdi-folder-off"></i> No categories found
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if(isset($categories) && method_exists($categories, 'links'))
    <div class="mt-3">
        {{ $categories->links() }}
    </div>
    @endif
</div>