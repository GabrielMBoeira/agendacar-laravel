<div class="row mt-2">
    <div class="col-md-2">
        <label for="id">ID: Serviço</label>
        <input type="text" class="form-control" name="id"  value="{{ $service->id ?? old('id') }}" readonly>
        <small class="text-danger">
            @error('id')
                {{ $message }}
            @enderror
        </small>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-6">
        <label for="professional_name">Profissional</label>
        <input type="text" class="form-control" name="professional_name" value="{{ $professional->name ?? old('professional_name') }}" readonly>
        <small class="text-danger">
            @error('professional_name')
                {{ $message }}
            @enderror
        </small>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-7">
        <label for="service">Tipo de serviço</label>
        <input type="text" class="form-control" style="text-transform: uppercase;" name="service" value="{{ $service->service ?? old('service') }}">
        <small class="text-danger">
            @error('service')
                {{ $message }}
            @enderror
        </small>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-3">
        <label for="time_service">Tempo de serviço</label>
        <input type="time" class="form-control" name="time_service" value="{{ $service->time_service ?? old('time_service') }}">
        <small class="text-danger">
            @error('time_service')
                {{ $message }}
            @enderror
        </small>
    </div>
</div>
