@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)

            <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert">
                {{ $error }}
            </div>

            @endforeach
        </ul>
    </div>
@endif
