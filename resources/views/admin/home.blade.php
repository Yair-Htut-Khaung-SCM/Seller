@extends('admin.layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin_home.css') }}">
@endsection

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <!-- Tag Card -->
        <div class="row row-cols-5">
            <div class="col">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <p class="count-value">{{ $users_count }}</p>
                        <h5 class="count-key">Register User</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <p class="count-value">{{ $posts_count }}</p>
                        <h5 class="count-key">Uploaded Posts</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">
                        <p class="count-value">{{ $manufacturers_count }}</p>
                        <h5 class="count-key">Manufacturers</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        <p class="count-value">{{ $build_types_count }}</p>
                        <h5 class="count-key">Build Types</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-info text-white mb-4">
                    <div class="card-body">
                        <p class="count-value">{{ $plate_division_count }}</p>
                        <h5 class="count-key">Plate Division</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="col">
                    <div class="card text-white mb-4 navbar-custom">
                        <div class="card-body">
                            <p class="count-value">{{ $buy_posts }}</p>
                            <h5 class="count-key">Buy Posts</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col">
                    <div class="card text-white mb-4 navbar-custom">
                        <div class="card-body">
                            <p class="count-value">{{ $sale_posts }}</p>
                            <h5 class="count-key">Sale Posts</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-pie me-1"></i>
                        Post By Build Type Pie Chart
                    </div>
                    <div class="card-body"><canvas id="BuildTypePieChart" width="100%" height="50"></canvas></div>
                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-pie me-1"></i>
                        Post By Plate Division Doughnut Chart
                    </div>
                    <div class="card-body"><canvas id="PlateDivisionDoughnutChart" width="100%" height="50"></canvas></div>
                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                </div>
            </div>
        </div>

        <div class="tabs">
            <div class="tab active" data-tab-content="tab1-content">All Data</div>
            <div class="tab" data-tab-content="tab2-content">Latest Year</div>
            <div class="tab" data-tab-content="tab3-content">Latest Month</div>
            <div class="tab" data-tab-content="tab4-content">Latest Week</div>
        </div>

        <div class="tab-content col-12">
            <div class="col-12 tab-content-item active" id="tab1-content">
                <div class="card mb-4 mt-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Post By Manufacturers
                    </div>
                    <div class="card-body"><canvas id="PostByManufacturerBarChart" width="100%" height="50"></canvas></div>
                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                </div>
            </div>

            <div class="col-12 tab-content-item" id="tab2-content">
                <div class="card mb-4 mt-4">
                    <div class="card-header d-flex col-12">
                        <i class="fas fa-chart-bar me-2 mt-1"></i>
                        <span class="col-11">Post Manufacturers By Latest Year</span>
                        <div class="col-1" style="text-align:center;">{{(now()->year-1)}}</div>
                    </div>
                    <div class="card-body"><canvas id="YearlyManufact" width="100%" height="50"></canvas></div>
                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                </div>
            </div>

            @php( $dt = (now()->toFormattedDateString()))
            @Php($dpast = now())
            @php($dpast->subMonth(1))

            <div class="col-12 tab-content-item" id="tab3-content">
                <div class="card mb-4 mt-4">
                    <div class="card-header d-flex col-12">
                        <i class="fas fa-chart-bar me-2 mt-1"></i>
                        <span class="col-9">Post Manufacturers By Latest Month</span>
                        <div class="col-3 text-center">{{$dpast->toFormattedDateString()}} to {{($dt)}}</div>
                    </div>
                    <div class="card-body"><canvas id="MonthlyManufact" width="100%" height="50"></canvas></div>
                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                </div>
            </div>

            @php( $dt = (now()->toFormattedDateString()))
            @Php($dpast = now())
            @php($dpast->subDays(7))
            <div class="col-12 tab-content-item" id="tab4-content">
                <div class="card mb-4 mt-4">
                    <div class="card-header d-flex col-12">
                        <i class="fas fa-chart-bar me-2 mt-1"></i>
                        <span class="col-9">Post Manufacturers By Latest Week</span>
                        <div class="col-3 text-center">{{($dpast)->toFormattedDateString()}} to {{$dt}}</div>
                    </div>
                    <div class="card-body"><canvas id="WeeklyManufact" width="100%" height="50"></canvas></div>
                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script>
    const tabs = document.querySelectorAll('.tab');
const tabContents = document.querySelectorAll('.tab-content-item');

tabs.forEach(tab => {
  tab.addEventListener('click', function() {
    // remove active class from all tabs and tab content
    tabs.forEach(tab => tab.classList.remove('active'));
    tabContents.forEach(content => content.classList.remove('active'));

    // add active class to current tab and its corresponding tab content
    this.classList.add('active');
    document.getElementById(this.dataset.tabContent).classList.add('active');
  });
});
</script>
<!-- Pie Chart - Build Type -->
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    var build_types_count = "{{ $build_types_count }}";
    var posts_by_build_types = "{{ json_encode($posts_by_build_types) }}";
    posts_by_build_types = JSON.parse(posts_by_build_types.replace(/&quot;/g, '"'));
    let lable_build_type = [];
    let value_build_type = [];
    let color = ['#ED836F', '#CC8DB9', '#60AAC5', '#54B282', '#ACA246',
        '#F5534E', '#F44B86', '#D063BA', '#8780DA', '#599911',
        '#F67263', '#DD79B4', '#6B9DDA', '#51AC58', '#B39723',
    ];
    for (let i = 0; i < build_types_count; i++) {
        lable_build_type[i] = posts_by_build_types[i].name;
        value_build_type[i] = posts_by_build_types[i].value;
    }
    // Pie Chart Example
    var ctx = document.getElementById("BuildTypePieChart");
    var BuildTypePieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: lable_build_type,
            datasets: [{
                data: value_build_type,
                backgroundColor: color,
            }],
        },
    });
</script>

<!-- Donut Chart - Plate Division -->
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    // Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    // Chart.defaults.global.defaultFontColor = '#292b2c';

    var plate_division_count = "{{ $plate_division_count }}";
    var posts_by_plate_divisions = "{{ json_encode($posts_by_plate_divisions) }}";
    posts_by_plate_divisions = JSON.parse(posts_by_plate_divisions.replace(/&quot;/g, '"'));
    let lable_post_division = [];
    let value_post_division = [];
    plate_division_count++;
    for (let i = 0; i < plate_division_count; i++) {
        lable_post_division[i] = posts_by_plate_divisions[i].name;
        value_post_division[i] = posts_by_plate_divisions[i].value;
    }
    // Pie Chart Example
    var ctx = document.getElementById("PlateDivisionDoughnutChart");
    var PlateDivisionDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: lable_post_division,
            datasets: [{
                data: value_post_division,
                backgroundColor: color,
            }],
        },
    });
</script>

<!-- Bar Chart - Manufacturer -->
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    // Data for View
    var manufacturers_count = "{{ $manufacturers_count }}";
    var posts_by_manufacturers = "{{ json_encode($posts_by_manufacturers) }}";
    posts_by_manufacturers = JSON.parse(posts_by_manufacturers.replace(/&quot;/g, '"'));
    let lable_post_manu = [];
    let value_post_manu = [];
    for (let i = 0; i < manufacturers_count; i++) {
        lable_post_manu[i] = posts_by_manufacturers[i].name;
        value_post_manu[i] = posts_by_manufacturers[i].value;
        console.log( lable_post_manu[i]);
    }
    
    // Max Value
    let max_value = Math.max.apply(null, value_post_manu);
    max_value_mod = parseInt(max_value / 100);
    max_value_mod++;
    max_value = max_value_mod * 100;

    // Bar Chart Example
    var ctx = document.getElementById("PostByManufacturerBarChart");
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: lable_post_manu,
            datasets: [{
                label: "Cars",
                backgroundColor: "rgba(2,117,216,1)",
                borderColor: "rgba(2,117,216,1)",
                data: value_post_manu,
                barPercentage : 0.2
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    barThickness: 10, 
                    maxBarThickness: 12,
                    barPercentage: 1.0,
                    categoryPercentage: 1.0,
                    time: {
                        unit: 'Car Brand - Manufacturer'
                    },
                    gridLines: {
                        display: true
                    },
                    ticks: {
                        maxTicksLimit: manufacturers_count,
                        fontSize: 10
                    },
                }],

                yAxes: [{
                    ticks: {
                        min: 0,
                        max: max_value,
                        maxTicksLimit: 20
                    },
                    gridLines: {
                        display: true
                    }
                }]
            },
            legend: {
                display: false
            },
        },

    });
</script>
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Data for View
var manufact_year = "{{ $manufacturers_count }}";
var posts_by_manufacturers = "{{ json_encode($latest_year_count) }}";
posts_by_manufacturers = JSON.parse(posts_by_manufacturers.replace(/&quot;/g, '"'));
let post_manu_year = [];
let post_value_year = [];
for (let i = 0; i < manufact_year; i++) {
    post_manu_year[i] = posts_by_manufacturers[i].name;
    post_value_year[i] = posts_by_manufacturers[i].value;
}
// Max Value
let max_year = Math.max.apply(null, post_value_year);
max_year_mod = parseInt(max_year / 100);
max_year_mod++;
max_year = max_year_mod * 100;
// Bar Chart Example
var ctx = document.getElementById("YearlyManufact");
var myLineChart = new Chart(ctx, {
type: 'bar',
data: {
    labels: post_manu_year,
    datasets: [{
        label: "Cars",
        backgroundColor: "rgba(2,117,216,1)",
        borderColor: "rgba(2,117,216,1)",
        data: post_value_year,
        barPercentage : 0.2
    }],
},
options: {
    scales: {
        xAxes: [{
            barThickness: 10, 
            maxBarThickness: 12,
            barPercentage: 1.0,
            categoryPercentage: 1.0,
            time: {
                unit: 'Car Brand - Manufacturer'
            },
            gridLines: {
                display: true
            },
            ticks: {
                maxTicksLimit: manufact_year,
                fontSize: 10
            }
        }],
        yAxes: [{
            ticks: {
                min: 0,
                max: max_value,
                maxTicksLimit: 20
            },
            gridLines: {
                display: true
            }
        }],
    },
    legend: {
        display: false
    }
}
});
</script>
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        // Data for View
        var manufact_month = "{{ $manufacturers_count }}";
        var posts_by_manufacturers = "{{ json_encode($latest_month_count) }}";
        posts_by_manufacturers = JSON.parse(posts_by_manufacturers.replace(/&quot;/g, '"'));
        let post_manu_month = [];
        let post_value_month = [];
        for (let i = 0; i < manufact_month; i++) {
            post_manu_month[i] = posts_by_manufacturers[i].name;
            post_value_month[i] = posts_by_manufacturers[i].value;
        }
        // Max Value
        let value_max = Math.max.apply(null, post_value_month);
        value_max_mod = parseInt(value_max / 100);
        value_max_mod++;
        value_max = value_max_mod * 100;
        // Bar Chart Example
        var ctx = document.getElementById("MonthlyManufact");
        var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: post_manu_month,
            datasets: [{
                label: "Cars",
                backgroundColor: "rgba(2,117,216,1)",
                borderColor: "rgba(2,117,216,1)",
                data: post_value_month,
                barPercentage : 0.2
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    barThickness: 10, 
                    maxBarThickness: 12,
                    barPercentage: 1.0,
                    categoryPercentage: 1.0,
                    time: {
                        unit: 'Car Brand - Manufacturer'
                    },
                    gridLines: {
                        display: true
                    },
                    ticks: {
                        maxTicksLimit: manufact_month,
                        fontSize: 10
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: max_value,
                        maxTicksLimit: 20
                    },
                    gridLines: {
                        display: true
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });
</script>
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Data for View
var manufact_week = "{{ $manufacturers_count }}";
var posts_by_manufacturers = "{{ json_encode($latest_week_count) }}";
posts_by_manufacturers = JSON.parse(posts_by_manufacturers.replace(/&quot;/g, '"'));
let post_manu_week = [];
let post_value_week = [];
for (let i = 0; i < manufact_week; i++) {
    post_manu_week[i] = posts_by_manufacturers[i].name;
    post_value_week[i] = posts_by_manufacturers[i].value;
}
// Max Value
let max_week = Math.max.apply(null, post_value_week);
max_week_mod = parseInt(max_week / 100);
max_week_mod++;
max_week = max_week_mod * 100;
// Bar Chart Example
var ctx = document.getElementById("WeeklyManufact");
var myLineChart = new Chart(ctx, {
type: 'bar',
data: {
    labels: post_manu_week,
    datasets: [{
        label: "Cars",
        backgroundColor: "rgba(2,117,216,1)",
        borderColor: "rgba(2,117,216,1)",
        data: post_value_week,
        barPercentage : 0.2
    }],
},
options: {
    scales: {
        xAxes: [{
            barThickness: 10, 
            maxBarThickness: 12,
            barPercentage: 1.0,
            categoryPercentage: 1.0,
            time: {
                unit: 'Car Brand - Manufacturer'
            },
            gridLines: {
                display: true
            },
            ticks: {
                maxTicksLimit: manufact_week,
                fontSize: 10
            }
        }],
        yAxes: [{
            ticks: {
                min: 0,
                max: max_value,
                maxTicksLimit: 20
            },
            gridLines: {
                display: true
            }
        }],
    },
    legend: {
        display: false
    }
}
});
</script>
@endsection