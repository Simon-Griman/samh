<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="card mt-2 col col-lg-9 mx-auto">
            <div class="card-body pb-0 w-100">            
                <form wire:submit.prevent="actualizar">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="equipo">Nombre</label>
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
                            <input type="text" class="form-control @error('serial') is-invalid @enderror" id="serial" wire:model="serial" value="{{ $equipo->serial }}">
                            @error('serial') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="bien-nacional">Bien Nacional</label>
                            <input type="number" class="form-control @error('bien_nacional') is-invalid @enderror" id="bien-nacional" wire:model="bien_nacional" value="{{ $equipo->bien_nacional }}">
                            @error('bien_nacional') <span class="text-red">{{ $message }}</span> @enderror
                        </div>

                        <div class="text-center col-12">
                            <button class="btn btn-primary m-4" type="submit">Actualizar</button>
                            <a href="{{ route('equipos.index') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
