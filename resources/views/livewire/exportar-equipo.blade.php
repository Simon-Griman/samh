<div class="">
    <div class="row d-flex justify-content-center">
        <h2 class="text-center mt-2">Exportar Registros</h2>
        <div class="card mt-2" style="max-height: 70vh; width: 75vw">
            <div class="card-head">
                <h3 class="h3 text-center mt-2">Aplicar Filtros</h3>
            </div>
            <div class="card-body overflow-auto">
                <div class="" wire:ignore>
                    <p>Departamento</p>
                    <select class="form-control select2" id="sel1" wire:model="departamento">
                        <option value="">Todo</option>
                        @foreach ($departamentos as $departament)
                            <option value="{{ $departament->id }}">{{ $departament->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4" wire:ignore>
                    <p>Ubicación</p>
                    <select class="form-control select2" id="sel2" wire:model="ubica">
                        <option value="">Todo</option>
                        @foreach ($ubicaciones as $ubicacion)
                            <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4" wire:ignore>
                    <p>Usuario</p>
                    <select class="form-control select2" id="sel3" wire:model="usuario">
                        <option value="">Todo</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4">
                    <p>Fecha de Adquisición</p>
                    <input type="date" class="form-control" wire:model="adquisicion">
                </div>
                <div class="mt-4">
                    <p>Rol Equipo</p>
                    <select name="" id="" class="form-control" wire:model="role">
                        <option value="">-- Seleccionar --</option>
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->rol }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('exportar_equipos.pdf', ['user_id' => $usuario, 'departamento_id' => $departamento, 'ubicacion_id' => $ubica, 'f_adquisicion' => $adquisicion, 'rol_id' => $role]) }}" class="btn btn-danger"><i class="fas fa-file-pdf"></i>&nbsp;Exportar</a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ url('js/jquery.js') }}"></script>
    
    <script>
        document.addEventListener('livewire:load', function(){
            $('.select2').select2();

            $('#sel1').on('change', function(){
                @this.set('departamento', this.value);
            });

            $('#sel2').on('change', function(){
                @this.set('ubica', this.value);
            });

            $('#sel3').on('change', function(){
                @this.set('usuario', this.value);
            });
        });
    </script>
</div>