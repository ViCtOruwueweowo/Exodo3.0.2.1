<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="{{ route('profile.show') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
             <!-- 
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

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
                <a href="{{ route('countries.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Continentes</p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{ route('cities.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Ciudad</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('address.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Direcicones</p>
                </a>
            </li>

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



            <li class="nav-item">
                <a href="{{ route('customers.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Clientes
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('films.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-film"></i>
                    <p>Películas</p>
                </a>
            </li>

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