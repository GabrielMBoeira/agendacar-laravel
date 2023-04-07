<div class="row mt-2">
    <div class="col-md-2">
        <label for="agenda_id">Cód. Agendamento</label>
        <input type="text" class="form-control" name="agenda_id" value="{{ $scheduling->id ?? old('agenda_id') }} "
            readonly>
        <small class="text-danger">
            @error('agenda_id')
                {{ $message }}
            @enderror
        </small>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-6">
        <label for="profissional_name">Profissional</label>
        <input type="text" class="form-control" name="profissional_name"
            value="{{ $professional->name ?? old('profissional_name') }}" readonly>
        <small class="text-danger">
            @error('profissional_name')
                {{ $message }}
            @enderror
        </small>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-3">
        <label for="scheduling_date">Data do agendamento</label>
        <input type="date" class="form-control" name="scheduling_date"
            value="{{ $scheduling->date ?? old('scheduling_date') }}" readonly>
        <small class="text-danger">
            @error('scheduling_date')
                {{ $message }}
            @enderror
        </small>
    </div>
    <div class="col-md-3">
        <label for="scheduling_hour">Hora do agendamento</label>
        <input type="time" class="form-control" name="scheduling_hour"
            value="{{ $scheduling->hour ?? old('scheduling_hour') }}" readonly>
        <small class="text-danger">
            @error('scheduling_hour')
                {{ $message }}
            @enderror
        </small>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-6">
        <label for="client">Cliente</label>
        <input type="text" class="form-control" style="text-transform: uppercase;" name="client"
            value="{{ $scheduling->client ?? old('client') }}">
        <small class="text-danger">
            @error('client')
                {{ $message }}
            @enderror
        </small>
    </div>
</div>


<div class="row mt-2">
    <div class="col-md-4">
        <label for="email">E-mail</label>
        <input type="emmail" class="form-control" style="text-transform: uppercase;" name="email"
            value="{{ $scheduling->email ?? old('email') }}">
        <small class="text-danger">
            @error('email')
                {{ $message }}
            @enderror
        </small>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-6">
        <label for="service">Serviço</label>
        <select name="service" id="service" class="form-control">
            @foreach ($services as $service)
                    <option value="{{ $service->service }}" {{ $service->service == $scheduling->service ? "selected" : '' }}>  {{ $service->service }} </option>
            @endforeach
        </select>
        <small class="text-danger">
            @error('service')
                {{ $message }}
            @enderror
        </small>
    </div>

</div>

<div class="row mt-2">
    <div class="col-md-4">
        <label for="status">Status do agendamento</label>
        <input type="text" class="form-control" style="text-transform: uppercase;" name="status"
            value="{{ $scheduling->status ?? old('status') }}" readonly>
        <small class="text-danger">
            @error('status')
                {{ $message }}
            @enderror
        </small>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-2">
        <label for="updated_at">Agendamento atualizado em:</label>
        <input type="datetime" class="form-control" name="updated_at"
            value="{{ $scheduling->updated_at ?? old('updated_at') }}" readonly>
        <small class="text-danger">
            @error('updated_at')
                {{ $message }}
            @enderror
        </small>
    </div>
</div>
