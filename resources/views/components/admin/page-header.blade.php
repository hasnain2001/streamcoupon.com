<div class="page-title-box text-capitalize">
    <div class="row align-items-center">
        <div class="col">
            <h4>{{ $title ?? 'Dashboard' }}</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @foreach($breadcrumbs ?? [] as $label => $url)
                        @if ($loop->last)
                            <li class="breadcrumb-item active">{{ $label }}</li>
                        @else
                            <li class="breadcrumb-item"><a href="{{ $url }}">{{ $label }}</a></li>
                        @endif
                    @endforeach
                </ol>
            </nav>
        </div>
    </div>
</div>
