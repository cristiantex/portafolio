<x-admin-layout titulo="Tecnologías" activo="tecnologias.index">
    <x-admin.pagehead titulo="Tecnologías" descripcion="Se agrupan por categoría en el sitio público. Describe para qué las has usado.">
        <a class="btn btn--primary" href="{{ route('tecnologias.create') }}"><x-icon name="plus"/> Agregar</a>
    </x-admin.pagehead>

    <div class="panel">
        @if ($tecnologias->isEmpty())
            <x-admin.empty texto="Todavía no hay tecnologías." :href="route('tecnologias.create')" accion="Agregar la primera"/>
        @else
            <table class="table" data-datatable>
                <thead><tr><th>Nombre</th><th>Categoría</th><th>Años</th><th>Uso</th><th data-sortable="false"><span class="sr-only">Acciones</span></th></tr></thead>
                <tbody>
                    @foreach ($tecnologias as $t)
                        <tr>
                            <td>{{ $t->nombre }}</td>
                            <td>@if ($t->categoria){{ $t->categoria }}@else<span class="badge badge--warn">sin categoría</span>@endif</td>
                            <td class="nowrap">{{ $t->experiencia_anios ?? '—' }}</td>
                            <td class="wrap"><span class="clamp">{{ $t->descripcion ?? '—' }}</span></td>
                            <td><x-admin.row-actions :edit="route('tecnologias.edit', $t)" :delete="route('tecnologias.destroy', $t)" :label="$t->nombre"/></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-admin-layout>
