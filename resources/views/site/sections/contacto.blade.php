<section id="contacto" class="section" aria-labelledby="contacto-titulo">
    <div class="container">
        <div class="section__head">
            <p class="eyebrow">Contacto</p>
            <h2 id="contacto-titulo">Hablemos</h2>
            <p class="section__lead">Para oportunidades, consultas técnicas o revisión de alguno de los casos.</p>
        </div>

        <div class="contact">
            <dl class="contact__list">
                @if ($perfil->email)
                    <div class="contact__row"><dt>Email</dt><dd><a class="link" href="mailto:{{ $perfil->email }}">{{ $perfil->email }}</a><button class="copy" type="button" data-copy="{{ $perfil->email }}">Copiar</button></dd></div>
                @endif
                @if ($perfil->telefono)
                    <div class="contact__row"><dt>Teléfono</dt><dd><a class="link" href="tel:{{ $perfil->telefono_digitos }}">{{ $perfil->telefono }}</a><button class="copy" type="button" data-copy="{{ $perfil->telefono }}">Copiar</button></dd></div>
                @endif
                @if ($perfil->linkedin)
                    <div class="contact__row"><dt>LinkedIn</dt><dd><a class="link" href="{{ $perfil->linkedin }}" target="_blank" rel="noopener noreferrer">{{ preg_replace('#^https?://(www\.)?#', '', rtrim($perfil->linkedin, '/')) }}</a></dd></div>
                @endif
                @if ($perfil->github)
                    <div class="contact__row"><dt>GitHub</dt><dd><a class="link" href="{{ $perfil->github }}" target="_blank" rel="noopener noreferrer">{{ preg_replace('#^https?://(www\.)?#', '', rtrim($perfil->github, '/')) }}</a></dd></div>
                @endif
            </dl>

            <div>
                @if (session('contacto_ok'))
                    <p class="notice" role="status">{{ session('contacto_ok') }}</p>
                @else
                    @if ($errors->any())
                        <p class="notice notice--error" role="alert" style="margin-bottom:1rem">Revisa los campos marcados y vuelve a enviar.</p>
                    @endif
                    <form class="form" method="POST" action="{{ route('contacto.store') }}" data-contact-form novalidate>
                        @csrf
                        <div class="hp" aria-hidden="true"><label for="sitio_web">No completar</label><input id="sitio_web" name="sitio_web" tabindex="-1" autocomplete="off"></div>

                        @foreach ([['nombre', 'Nombre', 'text', 'name'], ['email', 'Correo', 'email', 'email']] as [$campo, $etiqueta, $tipo, $auto])
                            <div class="field">
                                <label for="c-{{ $campo }}">{{ $etiqueta }}</label>
                                <input id="c-{{ $campo }}" name="{{ $campo }}" type="{{ $tipo }}" value="{{ old($campo) }}" autocomplete="{{ $auto }}" required
                                       aria-invalid="{{ $errors->has($campo) ? 'true' : 'false' }}" aria-describedby="c-{{ $campo }}-error">
                                <p class="field__error" id="c-{{ $campo }}-error">{{ $errors->first($campo) }}</p>
                            </div>
                        @endforeach
                        <div class="field">
                            <label for="c-mensaje">Mensaje</label>
                            <textarea id="c-mensaje" name="mensaje" required minlength="10" maxlength="2000"
                                      aria-invalid="{{ $errors->has('mensaje') ? 'true' : 'false' }}" aria-describedby="c-mensaje-error">{{ old('mensaje') }}</textarea>
                            <p class="field__error" id="c-mensaje-error">{{ $errors->first('mensaje') }}</p>
                        </div>
                        <div><button class="btn btn--primary" type="submit">Enviar mensaje</button></div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</section>
