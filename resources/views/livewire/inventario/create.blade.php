<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="card mt-2 col col-lg-9 mx-auto">
            <div class="card-body pb-0 w-100">            
                <form wire:submit.prevent="crear">
                    <div class="form-row">
                        <div class="form-group col-12" wire:ignore>
                            <label for="equipo">Nombre</label>
                            <select name="" id="equipo" class="form-control select2 @error('tipo') is-invalid @enderror" wire:model="tipo">
                                <option value="">-- Seleccionar --</option>                                
                                @foreach ($equipos as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                @endforeach
                            </select>
                            @error('tipo') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-12" wire:ignore>
                            <label for="marca">Marca</label>
                            <select name="" id="marca" class="form-control select2 @error('marca') is-invalid @enderror" wire:model="marca">
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
                            <label for="bien-pdvsa">Bien Nacional PDVSA</label>
                            <input type="number" class="form-control @error('bien_pdvsa') is-invalid @enderror" id="bien-pdvsa" wire:model="bien_pdvsa">
                            @error('bien_pdvsa') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="bien-menpet">Bien Nacional Menpet</label>
                            <input type="number" class="form-control @error('bien_menpet') is-invalid @enderror" id="bien-menpet" wire:model="bien_menpet">
                            @error('bien_menpet') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="adquisicion">Fecha de Adquisición</label>
                            <input type="date" class="form-control @error('adquisicion') is-invalid @enderror" id="adquisicion" wire:model="adquisicion">
                            @error('adquisicion') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="costo_compra">Costo de Compra</label>
                            <input type="number" class="form-control @error('costo_compra') is-invalid @enderror" id="costo_compra" wire:model="costo_compra">
                            @error('costo_compra') <span class="text-red">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="proveedor">Proveedor</label>
                            <select name="" id="proveedor" class="form-control @error('proveedor') is-invalid @enderror" wire:model="proveedor">
                                <option value="">-- Seleccionar --</option>
                                @foreach ($proveedores as $provee)
                                <option value="{{ $provee->id }}">{{ $provee->nombre }}</option>
                                @endforeach
                            </select>
                            @error('proveedor') <span class="text-red">{{ $message }}</span> @enderror
                        </div>

                        <div class="text-center col-12">
                            <button class="btn btn-primary m-4" type="submit">Crear</button>
                            <a href="{{ route('inventario.index') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function(){
            $('.select2').select2();

            $('#equipo').on('change', function(){
                @this.set('tipo', this.value);
            });

            $('#marca').on('change', function(){
                @this.set('marca', this.value);
            });
        });
    </script>

</div>