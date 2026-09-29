<x-admin-layout titulo="Proyectos" activo="proyectos.index">
    <x-admin.pagehead titulo="Proyectos" descripcion="Un proyecto con caso técnico se muestra con problema, arquitectura y decisiones. Solo los publicados aparecen en el sitio.">
        <a class="btn btn--primary" href="{{ route('proyectos.create') }}"><x-icon name="plus"/> Agregar</a>
    </x-admin.pagehead>

    <div class="panel">
        @if ($proyectos->isEmpty())
            <x-admin.empty texto="Todavía no hay proyectos." :href="route('proyectos.create')" accion="Agregar el primero"/>
        @else
            <table class="table" data-datatable>
                <thead><tr><th>Título</th><th>Tecnologías</th><th>Caso técnico</th><th>Estado</th><th data-sortable="false"><span class="sr-only">Acciones</span></th></tr></thead>
                <tbody>
                    @foreach ($proyectos as $p)
                        <tr>
                            <td>{{ $p->titulo }}</td>
                            <td class="wrap"><span class="clamp">{{ $p->tecnologias ?? '—' }}</span></td>
                            <td>@if ($p->es_caso)<span class="badge badge--ok">completo</span>@else<span class="badge">solo resumen</span>@endif</td>
                            <td>@if ($p->publicado)<span class="badge badge--ok">publicado</span>@else<span class="badge badge--warn">borrador</span>@endif</td>
                            <td><x-admin.row-actions :edit="route('proyectos.edit', $p)" :delete="route('proyectos.destroy', $p)" :label="$p->titulo"/></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-admin-layout>
