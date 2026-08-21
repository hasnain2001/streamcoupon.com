@extends('employee.layouts.app')

@section('title', 'Blog Details · ' . $blog->name)

@section('content')
<div class="container-fluid px-4">
    {{-- Breadcrumb & Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('employee.blog.index') }}">Blogs</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $blog->name }}</li>
                </ol>
            </nav>
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                <h1 class="h2 mb-0"><i class="fas fa-newspaper me-2 text-primary"></i>{{ $blog->name }}</h1>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('employee.blog.edit', $blog->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                    <form action="{{ route('employee.blog.destroy', $blog->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this blog?')">
                            <i class="fas fa-trash me-1"></i> Delete
                        </button>
                    </form>
                    <a href="{{ route('employee.blog.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="row">
        {{-- Left Column: Main Details --}}
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                {{-- Card Header with Status Badge --}}
                <div class="card-header bg-gradient-primary text-white d-flex flex-wrap justify-content-between align-items-center">
                    <h3 class="card-title h5 mb-0">{{ $blog->name }}</h3>
                    <span class="badge {{ $blog->status == '1' ? 'bg-success' : 'bg-danger' }} fs-6 px-3 py-2">
                        <i class="fas {{ $blog->status == '1' ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
                        {{ $blog->status == '1' ? 'Published' : 'Draft' }}
                    </span>
                </div>

                <div class="card-body">
                    {{-- Featured Image --}}
                    <div class="text-center mb-4">
                        <img class="img-fluid rounded shadow-sm"
                             src="{{ $blog->image_url }}"
                             alt="{{ $blog->name }}"
                             style="max-height: 450px; width: 100%; object-fit: cover; border-radius: 8px;">
                    </div>

                    {{-- Blog Content --}}
                    <div class="blog-content">
                        <h5 class="border-bottom pb-2 mb-3"><i class="fas fa-align-left me-2 text-primary"></i>Content</h5>
                        <div class="content-body bg-light p-3 rounded">
                            {!! $blog->content !!}
                        </div>
                    </div>
                </div>
            </div>

            {{-- SEO Section (Collapsible) --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#seoCollapse" style="cursor: pointer;">
                    <h5 class="mb-0"><i class="fas fa-search me-2"></i>SEO Information</h5>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div id="seoCollapse" class="collapse show">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="fw-bold text-muted small text-uppercase">Meta Title</label>
                                    <p class="mb-0">{{ $blog->title ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="fw-bold text-muted small text-uppercase">Meta Keywords</label>
                                    <p class="mb-0">{{ $blog->meta_keyword ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="fw-bold text-muted small text-uppercase">Meta Description</label>
                            <p class="mb-0">{{ $blog->meta_description ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column: Sidebar Meta Info --}}
        <div class="col-lg-4">
            {{-- Author & Timestamps --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Details</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        {{-- <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="fas fa-user me-2 text-muted"></i>Author</span>
                            <span class="fw-semibold">{{ $blog->user->name ?? 'N/A' }}</span>
                        </li> --}}
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="fas fa-tag me-2 text-muted"></i>Category</span>
                            <span class="badge bg-secondary">{{ $blog->category->name ?? 'N/A' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="fas fa-store me-2 text-muted"></i>Store</span>
                            <span class="badge bg-secondary">{{ $blog->store->name ?? 'N/A' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="fas fa-calendar-plus me-2 text-muted"></i>Created</span>
                            <span class="small">{{ $blog->created_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="fas fa-calendar-check me-2 text-muted"></i>Updated</span>
                            <span class="small">{{ $blog->updated_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="fas fa-clock me-2 text-muted"></i>Timezone</span>
                            <span class="small">Asia/Karachi</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                </div>
                <div class="card-body d-grid gap-2">
                    <a href="{{ route('employee.blog.edit', $blog->id) }}" class="btn btn-outline-primary">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                    <button type="submit" form="deleteForm" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this blog?')">
                        <i class="fas fa-trash me-1"></i> Delete
                    </button>
                    <a href="{{ route('employee.blog.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-list me-1"></i> All Blogs
                    </a>
                    {{-- Optional: Preview on frontend --}}
                    @if($blog->status == '1')
                        <a href="{{ route('blog.detail', ['slug' => Str::slug($blog->slug)]) }}" target="_blank" class="btn btn-outline-success">
                            <i class="fas fa-eye me-1"></i> Preview
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Hidden delete form for sidebar button --}}
<form id="deleteForm" action="{{ route('employee.blog.destroy', $blog->id) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

<style>
    .card-header.bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        border-radius: 0.5rem 0.5rem 0 0;
    }
    .blog-content img {
        max-width: 100%;
        height: auto;
        margin: 15px 0;
        border-radius: 5px;
    }
    .blog-content p {
        line-height: 1.8;
        margin-bottom: 1.2rem;
    }
    .content-body {
        background: #f8f9fa;
        border-radius: 0.5rem;
        padding: 1.25rem;
    }
    .list-group-item {
        border-left: 0;
        border-right: 0;
        padding: 0.75rem 0;
    }
    .list-group-item:first-child {
        border-top: 0;
        padding-top: 0;
    }
    .list-group-item:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }
    @media (max-width: 768px) {
        .card-header h3 {
            font-size: 1.25rem;
        }
        .breadcrumb {
            font-size: 0.9rem;
        }
    }
</style>
@endsection