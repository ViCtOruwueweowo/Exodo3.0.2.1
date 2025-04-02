<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional)
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
        <a href="{{ route('profile.show') }}" class="d-block">Perfil</a>
        </div>
    </div>-->

    @php
        $role_id = request()->cookie('role_id');
    @endphp
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">

            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

        
            
            
             <!-- 
         

            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        {{ __('Users') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('about') }}" class="nav-link">
                    <i class="nav-icon far fa-address-card"></i>
                    <p>
                        {{ __('About us') }}
                    </p>
                </a>
            </li>
-->
<li class="nav-item">
    <a href="{{ route('logout') }}" class="nav-link"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>Cerrar Sesión</p>
    </a>
</li>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@if(in_array($role_id, [1, 3]))
            <li class="nav-item">
                <a href="{{ route('countries.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-globe"></i>
                    <p>Continentes</p>
                </a>
            </li>
@endif

@if(in_array($role_id, [1, 3]))
            <li class="nav-item">
                <a href="{{ route('cities.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-building"></i>
                    <p>Ciudades</p>
                </a>
            </li>

@endif
@if(in_array($role_id, [1, 3]))
            <li class="nav-item">
                <a href="{{ route('address.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-map-marker-alt"></i>
                    <p>Direcciones</p>
                </a>
            </li>
@endif
            <li class="nav-item">
                <a href="{{ route('actors.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Actores</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('categories.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>Categorías</p>
                </a>
            </li>
            @if(in_array($role_id, [1, 3]))
            <li class="nav-item">
                <a href="{{ route('customers.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Clientes
                    </p>
                </a>
            </li>
@endif

@if(in_array($role_id, [1, 3]))
            <li class="nav-item">
                <a href="{{ route('languages.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Lenguaje
                    </p>
                </a>
            </li>
@endif
            <li class="nav-item">
                <a href="{{ route('films.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-film"></i>
                    <p>Películas</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('films.show') }}" class="nav-link">
                    <i class="nav-icon fas fa-film"></i>
                    <p>Texto de la película</p>
                </a>
            </li>
            @if(in_array($role_id, [1, 3]))
            <li class="nav-item">
                <a href="{{ route('inventarios.show') }}" class="nav-link">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>Inventario</p>
                </a>
            </li>
@endif
@if(in_array($role_id, [1, 3]))
            <li class="nav-item">
                <a href="{{ route('Payments.show') }}" class="nav-link">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>Pagos</p>
                </a>
            </li>
@endif
            <li class="nav-item">
                <a href="{{ route('film_actors.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-user-tag"></i>
                    <p>Relación Películas - Actores</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('film_categories.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-tags"></i>
                    <p>Relación Películas - Categorías</p>
                </a>
            </li>
            @if(in_array($role_id, [1, 3]))
            <li class="nav-item">
                <a href="{{ route('store.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-tags"></i>
                    <p>Store</p>
                </a>
            </li>
@endif
            <li class="nav-item">
                <a href="{{ route('staff.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-tags"></i>
                    <p>Staff</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('rentals.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-tags"></i>
                    <p>Rental</p>
                </a>
            </li>
 <!-- 
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        Two-level menu
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Child menu</p>
                        </a>
                    </li>
                </ul>
            </li>
            -->
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->