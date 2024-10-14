<div>
    @can('users.delete')
    <form wire:submit.prevent="editar" class="mb-0 pl-0">
        <h5>Actualizar Contraseña</h5>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" wire:model="password">
        @error('password') <span class="text-red">{{ $message }}</span> @enderror

        <h5 class="mt-2">Confirmar Contraseña</h5>
        <input type="password" class="form-control @error('confirPass') is-invalid @enderror" id="confirpass" wire:model="confirPass">
        @error('confirPass') <span class="text-red">{{ $message }}</span> @enderror

        <div class="mt-4 mb-4">
            <button class="btn btn-primary" type="submit">Actualizar Contraseña</button>
        </div>
    </form>
    <hr>
    <form wire:submit.prevent="editar_ubicacion" class="mb-0 pl-0">
        <h5>Actualizar Ubicación</h5>
        <select class="form-control" wire:model="ubicacion">
            @foreach ($ubicaciones as $ubica)
            <option value="{{ $ubica->id }}">{{ $ubica->nombre }}</option>
            @endforeach
        </select>
        <div class="mt-4 mb-4">
            <button class="btn btn-primary" type="submit">Actualizar Ubicación</button>
        </div>
    </form>
    <hr>
    @endcan
    @can('Super-User')
    <form wire:submit.prevent="editar_departamento" class="mb-0 pl-0">
        <h5>Actualizar Departamento</h5>
        <select class="form-control" wire:model="departamento">
            @foreach ($departamentos as $departament)
            <option value="{{ $departament->id }}">{{ $departament->nombre }}</option>
            @endforeach
        </select>
        <div class="mt-4 mb-4">
            <button class="btn btn-primary" type="submit">Actualizar Departamento</button>
        </div>
    </form>
    <hr>
    @endcan
    <form wire:submit.prevent="editar_cargo" class="mb-0 pl-0">
        <h5>Actualizar Cargo</h5>
        <select class="form-control" wire:model="cargo">
            @foreach ($cargos as $carga)
            <option value="{{ $carga->id }}">{{ $carga->nombre }}</option>
            @endforeach
        </select>
        <div class="mt-4 mb-4">
            <button class="btn btn-primary" type="submit">Actualizar Cargo</button>
        </div>
    </form>
    <hr>
</div>
