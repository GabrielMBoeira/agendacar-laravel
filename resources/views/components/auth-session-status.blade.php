@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600']) }}>
        <div class="alert alert-primary d-flex justify-content-center align-items-center" role="alert">
            {{ $status }}
        </div>
    </div>
@endif
