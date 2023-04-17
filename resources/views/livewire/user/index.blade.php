<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="card">
            
            <div class="card-body">
                <table class="table table-responsive table-hover w-100">
                    <thead>
                        <th><input wire:model="nombre" type="text" class="form-control" placeholder="Buscar:"><br>Nombre</th>
                        <th><input wire:model="email" type="text" class="form-control" placeholder="Buscar:"><br>Email</th>
                        <th><input wire:model="cedula" type="text" class="form-control" placeholder="Buscar:"><br>Cedula</th>
                        <th>Acciones</th>                    
                    </thead>
                    @if ($users->count())
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->cedula }}</td>
                            <td width="10px">
                                <a class="btn btn-primary" href="{{ route('users.edit', $user) }}">Editar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <tbody>
                        <tr>
                            <td colspan="4">
                                <h4 class="text-center">No se encontraron resultados</h4>
                            </td>
                        </tr>
                    </tbody>
                    @endif
                </table>
            </div>
            <div class="card-footer">
                
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
