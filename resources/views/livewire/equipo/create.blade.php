<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="card mt-2 col col-lg-9 mx-auto">
            <div class="card-body pb-0 w-100">            
                <form wire:submit.prevent="crear">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="equipo">Equipo</label>
                            <select name="" id="equipo" class="form-control @error('tipo') is-invalid @enderror" wire:model="tipo">
                                <option value="">-- Seleccionar --</option>                                
                                @foreach ($equipos as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                @endforeach
                            </select>
                            @error('tipo') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="marca">Marca</label>
                            <select name="" id="marca" class="form-control @error('marca') is-invalid @enderror" wire:model="marca">
                                <option value="">-- Seleccionar --</option>                                
                                @foreach ($marcas as $marca)
                                <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                                @endforeach
                            </select>
                            @error('marca') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="modelo">Modelo</label>
                            <select name="" id="modelo" class="form-control @error('modelo') is-invalid @enderror" wire:model="modelo">
                                <option value="">-- Seleccionar --</option>                                
                                @foreach ($modelos as $modelo)
                                <option value="{{ $modelo->id }}">{{ $modelo->nombre }}</option>
                                @endforeach
                            </select>
                            @error('modelo') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="serial">Serial</label>
                            <input type="text" class="form-control @error('serial') is-invalid @enderror" id="serial" wire:model="serial">
                            @error('serial') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="bien-nacional">Bien Nacional</label>
                            <input type="number" class="form-control @error('bien_nacional') is-invalid @enderror" id="bien-nacional" wire:model="bien_nacional">
                            @error('bien_nacional') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="equipo">Rol Equipo</label>
                            <select name="" id="equipo" class="form-control @error('rol') is-invalid @enderror" wire:model="rol">
                                <option value="">-- Seleccionar --</option>
                                @foreach ($roles as $rol)
                                    @if($rol->rol != 'Disponible')
                                    <option value="{{ $rol->id }}">{{ $rol->rol }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('rol') <span class="text-red">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="observacion">Observación</label>
                            <input type="text" class="form-control @error('observacion') is-invalid @enderror" id="observacion" wire:model="observacion">
                            @error('observacion') <span class="text-red">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="equipo">Departamento</label>
                            <select name="" id="equipo" class="form-control @error('departamento') is-invalid @enderror" wire:model="departamento">
                                <option value="">-- Seleccionar --</option>
                                @foreach ($departamentos as $departament)
                                <option value="{{ $departament->id }}">{{ $departament->nombre }}</option>
                                @endforeach
                            </select>
                            @error('departamento') <span class="text-red">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="equipo">Usuario</label>
                            <select name="" id="equipo" class="form-control @error('usuario') is-invalid @enderror" wire:model="usuario">
                                <option value="">-- Seleccionar --</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('usuario') <span class="text-red">{{ $message }}</span> @enderror
                        </div>

                        <div class="text-center col-12">
                            <button class="btn btn-primary m-4" type="submit">Crear</button>
                            <a href="{{ route('equipos.index') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


