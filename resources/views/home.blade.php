@extends('layouts.app')

@section('content')
<br>
<!-- Main content FUNCIONAL MUESTRA DATOS REALES -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @php
                                $boxes = [
                                    ['count' => $categoriesCount, 'text' => 'Categorías', 'icon' => 'ion-bag', 'bg' => 'info'],
                                    ['count' => $filmsCount, 'text' => 'Películas', 'icon' => 'ion-stats-bars', 'bg' => 'info'],
                                    ['count' => $actorsCount, 'text' => 'Actores', 'icon' => 'ion-person-add', 'bg' => 'info'],
                                    ['count' => $languagesCount, 'text' => 'Lenguajes', 'icon' => 'ion-pie-graph', 'bg' => 'info']
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
                                        <h3 class="card-title">Películas Más Rentadas</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="position-relative mb-4">
                                            <canvas id="rental-chart" height="250"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                              <div class="card bg-gradient-success" style="position: relative; left: 0px; top: 0px;">
              <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52" aria-expanded="false">
                      <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                      <a href="#" class="dropdown-item">Add new event</a>
                      <a href="#" class="dropdown-item">Clear events</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">View calendar</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"><div class="bootstrap-datetimepicker-widget usetwentyfour"><ul class="list-unstyled"><li class="show"><div class="datepicker"><div class="datepicker-days" style=""><table class="table table-sm"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Month"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Month">March 2025</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Month"></span></th></tr><tr><th class="dow">Su</th><th class="dow">Mo</th><th class="dow">Tu</th><th class="dow">We</th><th class="dow">Th</th><th class="dow">Fr</th><th class="dow">Sa</th></tr></thead><tbody><tr><td data-action="selectDay" data-day="02/23/2025" class="day old weekend">23</td><td data-action="selectDay" data-day="02/24/2025" class="day old">24</td><td data-action="selectDay" data-day="02/25/2025" class="day old">25</td><td data-action="selectDay" data-day="02/26/2025" class="day old">26</td><td data-action="selectDay" data-day="02/27/2025" class="day old">27</td><td data-action="selectDay" data-day="02/28/2025" class="day old">28</td><td data-action="selectDay" data-day="03/01/2025" class="day weekend">1</td></tr><tr><td data-action="selectDay" data-day="03/02/2025" class="day weekend">2</td><td data-action="selectDay" data-day="03/03/2025" class="day">3</td><td data-action="selectDay" data-day="03/04/2025" class="day">4</td><td data-action="selectDay" data-day="03/05/2025" class="day">5</td><td data-action="selectDay" data-day="03/06/2025" class="day">6</td><td data-action="selectDay" data-day="03/07/2025" class="day">7</td><td data-action="selectDay" data-day="03/08/2025" class="day weekend">8</td></tr><tr><td data-action="selectDay" data-day="03/09/2025" class="day weekend">9</td><td data-action="selectDay" data-day="03/10/2025" class="day">10</td><td data-action="selectDay" data-day="03/11/2025" class="day">11</td><td data-action="selectDay" data-day="03/12/2025" class="day">12</td><td data-action="selectDay" data-day="03/13/2025" class="day">13</td><td data-action="selectDay" data-day="03/14/2025" class="day">14</td><td data-action="selectDay" data-day="03/15/2025" class="day weekend">15</td></tr><tr><td data-action="selectDay" data-day="03/16/2025" class="day weekend">16</td><td data-action="selectDay" data-day="03/17/2025" class="day">17</td><td data-action="selectDay" data-day="03/18/2025" class="day">18</td><td data-action="selectDay" data-day="03/19/2025" class="day active today">19</td><td data-action="selectDay" data-day="03/20/2025" class="day">20</td><td data-action="selectDay" data-day="03/21/2025" class="day">21</td><td data-action="selectDay" data-day="03/22/2025" class="day weekend">22</td></tr><tr><td data-action="selectDay" data-day="03/23/2025" class="day weekend">23</td><td data-action="selectDay" data-day="03/24/2025" class="day">24</td><td data-action="selectDay" data-day="03/25/2025" class="day">25</td><td data-action="selectDay" data-day="03/26/2025" class="day">26</td><td data-action="selectDay" data-day="03/27/2025" class="day">27</td><td data-action="selectDay" data-day="03/28/2025" class="day">28</td><td data-action="selectDay" data-day="03/29/2025" class="day weekend">29</td></tr><tr><td data-action="selectDay" data-day="03/30/2025" class="day weekend">30</td><td data-action="selectDay" data-day="03/31/2025" class="day">31</td><td data-action="selectDay" data-day="04/01/2025" class="day new">1</td><td data-action="selectDay" data-day="04/02/2025" class="day new">2</td><td data-action="selectDay" data-day="04/03/2025" class="day new">3</td><td data-action="selectDay" data-day="04/04/2025" class="day new">4</td><td data-action="selectDay" data-day="04/05/2025" class="day new weekend">5</td></tr></tbody></table></div><div class="datepicker-months" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Year"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Year">2025</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Year"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectMonth" class="month">Jan</span><span data-action="selectMonth" class="month">Feb</span><span data-action="selectMonth" class="month active">Mar</span><span data-action="selectMonth" class="month">Apr</span><span data-action="selectMonth" class="month">May</span><span data-action="selectMonth" class="month">Jun</span><span data-action="selectMonth" class="month">Jul</span><span data-action="selectMonth" class="month">Aug</span><span data-action="selectMonth" class="month">Sep</span><span data-action="selectMonth" class="month">Oct</span><span data-action="selectMonth" class="month">Nov</span><span data-action="selectMonth" class="month">Dec</span></td></tr></tbody></table></div><div class="datepicker-years" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Decade"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Decade">2020-2029</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Decade"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectYear" class="year old">2019</span><span data-action="selectYear" class="year">2020</span><span data-action="selectYear" class="year">2021</span><span data-action="selectYear" class="year">2022</span><span data-action="selectYear" class="year">2023</span><span data-action="selectYear" class="year">2024</span><span data-action="selectYear" class="year active">2025</span><span data-action="selectYear" class="year">2026</span><span data-action="selectYear" class="year">2027</span><span data-action="selectYear" class="year">2028</span><span data-action="selectYear" class="year">2029</span><span data-action="selectYear" class="year old">2030</span></td></tr></tbody></table></div><div class="datepicker-decades" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Century"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5">2000-2090</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Century"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectDecade" class="decade old" data-selection="2006">1990</span><span data-action="selectDecade" class="decade" data-selection="2006">2000</span><span data-action="selectDecade" class="decade" data-selection="2016">2010</span><span data-action="selectDecade" class="decade active" data-selection="2026">2020</span><span data-action="selectDecade" class="decade" data-selection="2036">2030</span><span data-action="selectDecade" class="decade" data-selection="2046">2040</span><span data-action="selectDecade" class="decade" data-selection="2056">2050</span><span data-action="selectDecade" class="decade" data-selection="2066">2060</span><span data-action="selectDecade" class="decade" data-selection="2076">2070</span><span data-action="selectDecade" class="decade" data-selection="2086">2080</span><span data-action="selectDecade" class="decade" data-selection="2096">2090</span><span data-action="selectDecade" class="decade old" data-selection="2106">2100</span></td></tr></tbody></table></div></div></li><li class="picker-switch accordion-toggle"></li></ul></div></div>
              </div>
              <!-- /.card-body -->
            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('rental-chart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($rentalTitles),
                datasets: [{
                    label: 'Número de Rentas',
                    data: @json($rentalCounts),
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection
