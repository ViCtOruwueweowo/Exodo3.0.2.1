@extends('layouts.app')

@section('content')
<br>
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @php
                                $boxes = [
                                    ['count' => 150, 'text' => 'Categorias', 'icon' => 'ion-bag', 'bg' => 'info'],
                                    ['count' => '53%', 'text' => 'Peliculas', 'icon' => 'ion-stats-bars', 'bg' => 'info'],
                                    ['count' => 44, 'text' => 'Actores', 'icon' => 'ion-person-add', 'bg' => 'info'],
                                    ['count' => 65, 'text' => 'Lenguajes', 'icon' => 'ion-pie-graph', 'bg' => 'info']
                                ];
                            @endphp

                            @foreach ($boxes as $box)
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-{{ $box['bg'] }}">
                                        <div class="inner">
                                            <h3>{{ $box['count'] }}</h3>
                                            <p>{{ $box['text'] }}</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion {{ $box['icon'] }}"></i>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header border-0 d-flex justify-content-between">
                                        <h3 class="card-title">Registro De Inventario</h3>                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex">
                                           
                                        </div>
                                        <div class="position-relative mb-4">
                                            <canvas id="visitors-chart" height="250" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-lg-6">
                                @php
                                    $infoBoxes = [
                                        ['text' => 'Inventory', 'count' => '5,200', 'icon' => 'fas fa-tag', 'bg' => 'warning'],
                                        ['text' => 'Mentions', 'count' => '92,050', 'icon' => 'far fa-heart', 'bg' => 'success'],
                                        ['text' => 'Downloads', 'count' => '114,381', 'icon' => 'fas fa-cloud-download-alt', 'bg' => 'danger'],
                                        ['text' => 'Direct Messages', 'count' => '163,921', 'icon' => 'far fa-comment', 'bg' => 'info']
                                    ];
                                @endphp

                                @foreach ($infoBoxes as $box)
                                    <div class="info-box mb-3 bg-{{ $box['bg'] }}">
                                        <span class="info-box-icon"><i class="{{ $box['icon'] }}"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">{{ $box['text'] }}</span>
                                            <span class="info-box-number">{{ $box['count'] }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
