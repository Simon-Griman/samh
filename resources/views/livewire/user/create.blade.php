<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="card mt-2 col col-lg-9 mx-auto">
            <div class="card-body pb-0 w-100">            
                <form wire:submit.prevent="crear">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="name">Nombre del Usuario</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model="name">
                            @error('name') <span class="text-red">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="email">E-mail del Usuario</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" wire:model="email">
                            @error('email') <span class="text-red">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="cedula">Cedula del Usuario</label>
                            <input type="number" class="form-control @error('cedula') is-invalid @enderror" id="cedula" wire:model="cedula">
                            @error('cedula') <span class="text-red">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="departamento">Departamento del Usuario</label>
                            <select name="" id="departamento" class="form-control @error('departamento') is-invalid @enderror" wire:model="departamento">
                                <option value="">-- Seleccionar --</option>
                                @foreach ($departamentos as $departament)
                                <option value="{{ $departament->id }}">{{ $departament->nombre }}</option>
                                @endforeach
                            </select>
                            @error('departamento') <span class="text-red">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="ubicacion">Ubicación del Usuario</label>
                            <select name="" id="ubicacion" class="form-control @error('ubicacion') is-invalid @enderror" wire:model="ubicacion">
                                <option value="">-- Seleccionar --</option>
                                @foreach ($ubicaciones as $ubicacion)
                                <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                                @endforeach
                            </select>
                            @error('ubicacion') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="text-center col-12">
                            <button class="btn btn-primary m-4" type="submit">Crear</button>
                            <a href="{{ route('users.index') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>