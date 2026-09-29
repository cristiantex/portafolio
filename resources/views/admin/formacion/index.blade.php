<x-admin-layout titulo="Formación" activo="formacion.index">
    <x-admin.pagehead titulo="Formación" descripcion="Estudios, cursos y certificaciones.">
        <a class="btn btn--primary" href="{{ route('formacion.create') }}"><x-icon name="plus"/> Agregar</a>
    </x-admin.pagehead>

    <div class="panel">
        @if ($formaciones->isEmpty())
            <x-admin.empty texto="Todavía no hay formación registrada." :href="route('formacion.create')" accion="Agregar la primera"/>
        @else
            <table class="table" data-datatable>
                <thead><tr><th>Título</th><th>Institución</th><th>Tipo</th><th>Período</th><th data-sortable="false"><span class="sr-only">Acciones</span></th></tr></thead>
                <tbody>
                    @foreach ($formaciones as $f)
                        <tr>
                            <td>{{ $f->titulo }}</td>
                            <td>{{ $f->institucion }}</td>
                            <td>{{ $f->tipo }}</td>
                            <td class="nowrap">{{ $f->fecha_inicio->format('Y') }} – {{ $f->fecha_fin?->format('Y') ?? 'en curso' }}</td>
                            <td><x-admin.row-actions :edit="route('formacion.edit', $f)" :delete="route('formacion.destroy', $f)" :label="$f->titulo"/></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-admin-layout>
