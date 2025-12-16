@foreach($categories as $category)
<tr>
    <td>{{ $category->id }}</td>
    <td>{{ $category->name }}</td>
    <td>{{ $category->slug }}</td>
         <td>
                                    @if($category->image)
                                    <img src="{{ asset('storage/categories/' . $category->image) }}"
                                         class="img-thumbnail"
                                         style="width: 80px; height: 80px; object-fit: cover;"
                                         alt="{{ $category->name }}"
                                         width="80"
                                         height="80"
                                         loading="lazy"
                                         title="{{ $category->name }}"
                                         >
                                    @else
                                      <img src="{{ asset('assets/img/no-image-found.png') }}"
                                         class="img-thumbnail"
                                         style="width: 80px; height: 80px; object-fit: cover;"
                                         alt="{{ $category->name }}"
                                         width="80"
                                         height="80"
                                         loading="lazy"
                                         title="{{ $category->name }}"
                                         >
                                    @endif
                                </td>
    <td>
        @if($category->language)
            <span class="badge badge-info text-dark">{{ $category->language->name }}</span>
        @else
            <span class="badge badge-secondary">N/A</span>
        @endif
    </td>
    <td>
        @if($category->status)
            <span class="badge badge-success text-dark">Active</span>
        @else
            <span class="badge badge-danger">Inactive</span>
        @endif
    </td>
  <td>
        {{ $category->created_at->format('Y-m-d H:i') }}
    </td>
    <td>
        {{ $category->updated_at->format('Y-m-d H:i') }}
    </td>
    <td>
        <a href="{{ route('employee.category.edit', $category->id) }}" class="btn btn-sm btn-primary" title="Edit">
            <i class="fas fa-edit"></i>
        </a>

        <form action="{{ route('employee.category.destroy', $category->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure?')">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    </td>
</tr>
@endforeach

@if($categories->isEmpty())
<tr>
    <td colspan="8" class="text-center">No categories found</td>
</tr>
@endif
