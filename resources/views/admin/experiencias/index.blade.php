<x-admin-layout titulo="Experiencias" activo="experiencias.index">
    <x-admin.pagehead titulo="Experiencias" descripcion="Cada experiencia puede contarse como historia: contexto, problema, solución y resultado.">
        <a class="btn btn--primary" href="{{ route('experiencias.create') }}"><x-icon name="plus"/> Agregar</a>
    </x-admin.pagehead>

    <div class="panel">
        @if ($experiencias->isEmpty())
            <x-admin.empty texto="Todavía no hay experiencias." :href="route('experiencias.create')" accion="Agregar la primera"/>
        @else
            <table class="table" data-datatable>
                <thead><tr><th>Empresa</th><th>Cargo</th><th>Período</th><th>Historia</th><th data-sortable="false"><span class="sr-only">Acciones</span></th></tr></thead>
                <tbody>
                    @foreach ($experiencias as $e)
                        <tr>
                            <td>{{ $e->empresa }}</td>
                            <td>{{ $e->cargo }}</td>
                            <td class="nowrap">{{ $e->fecha_inicio->format('m/Y') }} – {{ $e->fecha_fin?->format('m/Y') ?? 'actual' }}</td>
                            <td>@if ($e->es_caso)<span class="badge badge--ok">completa</span>@else<span class="badge badge--warn">sin detalle</span>@endif</td>
                            <td><x-admin.row-actions :edit="route('experiencias.edit', $e)" :delete="route('experiencias.destroy', $e)" :label="$e->cargo.' en '.$e->empresa"/></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-admin-layout>
