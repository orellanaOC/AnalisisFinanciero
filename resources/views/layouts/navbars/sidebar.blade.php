<div class="sidebar">
    <div class="sidebar-wrapper">
    <p><br></p>
        <div class="logo__centered">
            <a href={{ route('home')}} class="text-center">
                <img class="logo" src="{{ asset('black') }}/img/stats.png" alt="logo SIAF">
            </a>
        </div>
        <div class="logo_centered text-center ">
            <a href={{ route('home')}} class="text-white logo-normal">
                <b>{{ __('SIAF') }}</b></a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'catalogo') class="active " @endif>
                <!--a href="{{ route('home') }}"-->
                <a href="{{ route('catalogo_prueba') }}">
                    <i class="tim-icons icon-bullet-list-67"></i> 
                    <p>{{ __('Catalogo de cuentas') }}</p>
                </a>
            </li>
            <!--Menusito desplegable-->
            <!--li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">
                    <i class="fab fa-laravel" ></i>
                    <span class="nav-link-text" >{{ __('Laravel Examples') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'profile') class="active " @endif>
                            <a href="{{ route('profile.edit')  }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ __('User Profile') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'users') class="active " @endif>
                            <a href="{{ route('user.index')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('User Management') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li-->
            <li @if ($pageSlug == 'balance') class="active " @endif>
                <a href="{{ route('balance_general_index') }}">
                    <i class="tim-icons icon-coins"></i>
                    <p>{{ __('Periodos') }}</p>
                </a>
            </li>
            <!--li @if ($pageSlug == 'resultados') class="active " @endif>
                <a href="{{ route('estado_resultado_index') }}">
                    <i class="tim-icons icon-money-coins"></i>
                    <p>{{ __('Estado de resultados') }}</p>
                </a>
            </li-->
            <li @if ($pageSlug == 'empresa') class="active " @endif>
                <a href="{{ route('analisis_empresa') }}">
                    <i class="tim-icons icon-bank"></i>
                    <p>{{ __('Empresa individual') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'analisis') class="active " @endif>
                <a href="{{ route('analisis') }}">
                    <i class="tim-icons icon-chart-bar-32"></i>
                    <p>{{ __('Análisis del sector') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'formulas') class="active " @endif>
                <a href="{{ route('formulas') }}">
                    <i class="tim-icons icon-bulb-63"></i>
                    <p>{{ __('Fórmulas de ratios') }}</p>
                </a>
            </li>
            @canany(['users.index', 'roles.index', 'permission_user.index'])
            <li>
                <a data-toggle="collapse" href="#seguridad" aria-expanded="false">
                    <i class="tim-icons icon-lock-circle" ></i>
                    <span class="nav-link-text" >{{ __('Seguridad') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="seguridad">
                    <ul class="nav pl-4">
                        @can('users.index')
                            <li @if ($pageSlug == 'usuarios') class="active " @endif>
                                <a href="{{ route('users.index') }}">
                                    <i class="tim-icons icon-single-02"></i>
                                    <p>{{ __('Usuarios') }}</p>
                                </a>
                            </li>
                        @endcan
                        @can('role.index')
                            <li @if ($pageSlug == 'permisos') class="active " @endif>

                                <a href="{{ route('roles.index') }}">
                                    <i class="tim-icons icon-badge"></i>
                                    <p>{{ __('Roles') }}</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
            @endcanany
            <!--li @if ($pageSlug == 'rtl') class="active " @endif>
                <a href="{{ route('pages.rtl') }}">
                    <i class="tim-icons icon-world"></i>
                    <p>{{ __('RTL Support') }}</p>
                </a>
            </li>
            <li class=" {{ $pageSlug == 'upgrade' ? 'active' : '' }} bg-info">
                <a href="#">
                    <i class="tim-icons icon-spaceship"></i>
                    <p>{{ __('Upgrade to PRO') }}</p>
                </a>
            </li-->
        </ul>
    </div>
</div>
