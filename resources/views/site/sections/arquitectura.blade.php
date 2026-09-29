<section id="arquitectura" class="section" aria-labelledby="arquitectura-titulo">
    <div class="container">
        <div class="section__head">
            <p class="eyebrow">Arquitectura</p>
            <h2 id="arquitectura-titulo">Cómo está construido este sitio</h2>
            <p class="section__lead">Este portafolio es una aplicación Laravel con MySQL. El contenido se edita desde un mantenedor propio y las secciones sin datos no se muestran.</p>
        </div>

        <figure class="arch__diagram">
            <svg viewBox="0 0 900 250" role="img" aria-labelledby="arch-t arch-d">
                <title id="arch-t">Flujo de una petición</title>
                <desc id="arch-d">El navegador envía la petición a las rutas y middleware, que la pasan a un controlador; este usa un servicio y los modelos Eloquent sobre MySQL, y devuelve una vista Blade como HTML.</desc>
                <defs><marker id="ah" markerWidth="8" markerHeight="8" refX="7" refY="4" orient="auto"><path d="M0 0 8 4 0 8z" class="head"/></marker></defs>

                @php
                    $nodos = [
                        ['Navegador', 'HTML · CSS · JS', 20],
                        ['Rutas', 'middleware', 190],
                        ['Controlador', 'delgado', 360],
                        ['Servicio', 'reglas y datos', 530],
                        ['Modelos', 'Eloquent · MySQL', 700],
                    ];
                @endphp
                @foreach ($nodos as [$nombre, $sub, $x])
                    <rect class="box {{ $loop->first || $loop->last ? 'box--edge' : '' }}" x="{{ $x }}" y="30" width="160" height="64" rx="4"/>
                    <text x="{{ $x + 80 }}" y="60" text-anchor="middle" font-size="14" font-weight="500">{{ $nombre }}</text>
                    <text class="sub" x="{{ $x + 80 }}" y="80" text-anchor="middle" font-size="11">{{ $sub }}</text>
                    @unless ($loop->last)<line class="line" x1="{{ $x + 160 }}" y1="62" x2="{{ $x + 190 }}" y2="62" marker-end="url(#ah)"/>@endunless
                @endforeach

                @php
                    $apoyos = [
                        ['Protección', 'throttle · CSRF · sesión', 190],
                        ['Validación', 'Form Request', 360],
                        ['Lógica', 'arma los datos', 530],
                        ['Persistencia', 'migraciones · casts', 700],
                    ];
                @endphp
                @foreach ($apoyos as [$a, $b, $x])
                    <line class="line" x1="{{ $x + 80 }}" y1="94" x2="{{ $x + 80 }}" y2="126"/>
                    <rect class="box" x="{{ $x }}" y="126" width="160" height="52" rx="4" stroke-dasharray="3 3"/>
                    <text x="{{ $x + 80 }}" y="148" text-anchor="middle" font-size="11" font-weight="500">{{ $a }}</text>
                    <text class="sub" x="{{ $x + 80 }}" y="165" text-anchor="middle" font-size="10">{{ $b }}</text>
                @endforeach

                <path class="line" d="M440 178 V214 H100 V100" marker-end="url(#ah)" stroke-dasharray="4 4"/>
                <text class="sub" x="270" y="232" text-anchor="middle" font-size="11">Vista Blade → HTML semántico</text>
            </svg>
        </figure>

        <div class="arch__notes">
            <div><h3>Responsabilidades separadas</h3><p>Los controladores solo coordinan. La validación vive en Form Requests, el armado de datos en servicios y las vistas no consultan la base de datos.</p></div>
            <div><h3>Contenido editable</h3><p>Perfil, experiencias, proyectos y tecnologías salen de MySQL. Los campos opcionales que no se completan no se dibujan.</p></div>
            <div><h3>Seguridad del acceso</h3><p>Sesión regenerada al ingresar, protección CSRF, límite de intentos, contraseña comparada en tiempo constante o con bcrypt, y archivos validados por tipo y tamaño.</p></div>
            <div><h3>Frontend liviano</h3><p>CSS y JavaScript propios compilados con Vite, fuentes autoalojadas y HTML semántico. Se lee completo sin JavaScript.</p></div>
        </div>
    </div>
</section>
