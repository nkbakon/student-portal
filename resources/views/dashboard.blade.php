@extends('layouts.app')
@section('bodycontent')
@if (session('status'))
    <div class="text-black m-2 p-4 bg-green-200">
        {{ session('status') }}
    </div>
@endif
@if (session('success'))
    <div class="text-black m-2 p-4 bg-yellow-200">
        {{ session('success') }}
    </div>
@endif
@if (session('delete'))
    <div class="text-black m-2 p-4 bg-red-200">
        {{ session('delete') }}
    </div>
@endif
<h1 class="text-center font-bold text-neutral-800 uppercase">Student Portal's Dashboard</h1>
<h2 class="text-center font-semibold text-neutral-800">@if(auth()->user()->type == 1)
    Admin
    @elseif(auth()->user()->type == 2)
    Teacher
    @else
    Student
    @endif
    : {{ auth()->user()->name }}
</h2>
<br>
<div class="py-12 ml-4 md:ml-0">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sm:px-24 lg:px-26">
      @if(auth()->user()->type == 1 || auth()->user()->type == 2)
      <h1 class="text-gray-500 text-lg font-semibold">This Year</h1><br>
      <div class="md:flex md:space-x-40 justify-center">
        <a href="{{ route('payments.index') }}">
          <div class="justify-center inline-flex bg-gray-200 rounded-2xl overflow-hidden shadow-lg" style="width:320px; height:128px;">
            <div class="px-6 py-4 text-center">
              <p class="text-gray-500">
                Total Earnings
              </p>
              <div class="font-bold text-5xl text-gray-700">
                @if(auth()->user()->type == 1)
                Rs.{{ number_format(App\Models\Payment::whereYear('created_at', now())->sum('amount'), 2) }}
                @else
                Rs.{{ number_format(App\Models\Cashout::where('teacher_id', auth()->user()->id)->whereYear('created_at', now())->sum('amount'), 2) }}
                @endif
              </div>  
              <span class="text-gray-500 text-sm">(in LKR)</span>                        
            </div>
          </div>
        </a>
      </div><br>
      <h1 class="text-gray-500 text-lg font-semibold">This Month</h1><br>
      <div class="md:flex md:space-x-40">
        <a href="{{ route('payments.index') }}">
          <div class="justify-center inline-flex bg-gray-200 rounded-2xl overflow-hidden shadow-lg" style="width:320px; height:128px;">
            <div class="px-6 py-4 text-center">                        
              <p class="text-gray-500">
                Total Earnings
              </p>
              <div class="font-bold text-5xl text-green-500">
                @if(auth()->user()->type == 1)
                Rs.{{ number_format(App\Models\Payment::whereMonth('created_at', now())->sum('amount'), 2) }}
                @else                  
                Rs.{{ number_format(App\Models\Cashout::where('teacher_id', auth()->user()->id)->whereMonth('created_at', now())->sum('amount'), 2) }}
                @endif
              </div>
              <span class="text-gray-500 text-sm">(in LKR)</span>
            </div>
          </div>
        </a>
        <a href="{{ route('users.index') }}">
          <div class="justify-center inline-flex bg-gray-200 rounded-2xl overflow-hidden shadow-lg" style="width:320px; height:128px;">
            <div class="px-6 py-4 text-center">                      
              <p class="text-gray-500">
                New Students
              </p>
              <div class="font-bold text-5xl text-blue-700">
                @if(auth()->user()->type == 1)
                {{ App\Models\User::whereMonth('created_at', now())->where('type', 3)->count() }}
                @else
                  @php 
                    $classIds = App\Models\TClass::where('teacher_id', auth()->user()->id)->pluck('id');
                    $studentCount = App\Models\ClassStudent::whereIn('class_id', $classIds)->whereMonth('created_at', now())->count();
                  @endphp
                {{ $studentCount }}
                @endif
              </div>
              <span class="text-gray-500 text-sm">(No. of Students Registered)</span>
            </div>
          </div>
        </a>
      </div><br>
      <div class="py-6">
        <div class="px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sm:px-24 lg:px-26">
            <div class="chart">
              <canvas class="inline-flex" id="mnthincomeChart" width="400" height="300"></canvas>
            </div>  
          </div>
        </div>
      </div><br>
      <div class="py-6">
        <div class="px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sm:px-24 lg:px-26">
            <div class="chart">
              <canvas class="inline-flex" id="mnstudentChart" width="400" height="300"></canvas>
            </div>  
          </div>
        </div>
      </div>
      @endif
      @if(auth()->user()->type == 1)
      <div class="py-6">
        <div class="sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sm:px-24 lg:px-26">
            <div class="chart">
              <canvas id="chart-line" height="300" width="400"></canvas>
            </div>
          </div>
        </div>
      </div><br>
      @endif
    </div>        
  </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  <?php
    $earningData = [];
    $expenseData = [];
    $studentData = [];
    for ($month = 1; $month <= 12; $month++) {
        if(auth()->user()->type == 1){
          $sum = App\Models\Payment::whereMonth('created_at', $month)->sum('amount');
        }else{
          $sum = App\Models\Cashout::where('teacher_id', auth()->user()->id)->whereMonth('created_at', $month)->sum('amount');
        }        
        array_push($earningData, $sum);
        $exsum = App\Models\Cashout::whereMonth('created_at', $month)->sum('amount');
        array_push($expenseData, $exsum);
        if(auth()->user()->type == 1){
          $studentCount = App\Models\User::whereMonth('created_at', $month)->where('type', 3)->count();
        }else{
          $classIds = App\Models\TClass::where('teacher_id', auth()->user()->id)->pluck('id');
          $studentCount = App\Models\ClassStudent::whereIn('class_id', $classIds)->whereMonth('created_at', $month)->count();
        }
        array_push($studentData, $studentCount);
    }
  ?>

  var ctx = document.getElementById("mnthincomeChart").getContext("2d");

  new Chart(ctx, {
    type: "bar",
    data: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [
        {
          label: "# earning in lkr",
          tension: 0.4,
          borderWidth: 0,
          borderRadius: 4,
          borderSkipped: false,
          backgroundColor: "#16a34a",
          data: <?php echo json_encode($earningData); ?>,
          maxBarThickness: 15,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
        },
      },
      interaction: {
        intersect: false,
        mode: "index",
      },
      scales: {
        y: {
          grid: {
            drawBorder: true,
            display: true,
            drawOnChartArea: true,
            drawTicks: true,
          },
          ticks: {
            suggestedMin: 0,
            suggestedMax: 600,
            beginAtZero: true,
            padding: 15,
            font: {
              size: 14,
              family: "Open Sans",
              style: "normal",
              lineHeight: 2,
            },
            color: "#b2b9bf",
          },
        },
        x: {
          grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: false,
            drawTicks: false,
          },
          ticks: {
            display: true,
            color: "#b2b9bf",
            padding: 20,
            font: {
              size: 11,
              family: "Open Sans",
              style: "normal",
              lineHeight: 2,
            },
          },
        },
      },
    },
  });

  var ctx2 = document.getElementById("mnstudentChart").getContext("2d");

  new Chart(ctx2, {
    type: "bar",
    data: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [
        {
          label: "# no. of student registered",
          tension: 0.4,
          borderWidth: 0,
          borderRadius: 4,
          borderSkipped: false,
          backgroundColor: "#1447e6",
          data: <?php echo json_encode($studentData); ?>,
          maxBarThickness: 15,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
        },
      },
      interaction: {
        intersect: false,
        mode: "index",
      },
      scales: {
        y: {
          grid: {
            drawBorder: true,
            display: true,
            drawOnChartArea: true,
            drawTicks: true,
          },
          ticks: {
            suggestedMin: 0,
            suggestedMax: 600,
            beginAtZero: true,
            padding: 15,
            font: {
              size: 14,
              family: "Open Sans",
              style: "normal",
              lineHeight: 2,
            },
            color: "#b2b9bf",
          },
        },
        x: {
          grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: false,
            drawTicks: false,
          },
          ticks: {
            display: true,
            color: "#b2b9bf",
            padding: 20,
            font: {
              size: 11,
              family: "Open Sans",
              style: "normal",
              lineHeight: 2,
            },
          },
        },
      },
    },
  });

  var ctx5 = document.getElementById("chart-line").getContext("2d");

  var gradientStroke1 = ctx5.createLinearGradient(0, 0, 0, 400);
  gradientStroke1.addColorStop(1, "rgba(22, 163, 74, 0.2)");
  gradientStroke1.addColorStop(0.2, "rgba(22, 163, 74, 0.0)");
  gradientStroke1.addColorStop(0, "rgba(22, 163, 74, 0)");

  var gradientStroke2 = ctx5.createLinearGradient(0, 230, 0, 50);
  gradientStroke2.addColorStop(1, "rgba(220, 38, 38, 0.2)");
  gradientStroke2.addColorStop(0.2, "rgba(220, 38, 38, 0.0)");
  gradientStroke2.addColorStop(0, "rgba(220, 38, 38, 0)");

  new Chart(ctx5, {
    type: "line",
    data: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [
        {
          label: "# earning in lkr",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#16a34a",
          borderWidth: 3,
          backgroundColor: gradientStroke1,
          fill: true,
          data: <?php echo json_encode($earningData); ?>,
          maxBarThickness: 6,
        },
        {
          label: "# cashout in lkr",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#dc2626",
          borderWidth: 3,
          backgroundColor: gradientStroke2,
          fill: true,
          data: <?php echo json_encode($expenseData); ?>,
          maxBarThickness: 6,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
        },
      },
      interaction: {
        intersect: false,
        mode: "index",
      },
      scales: {
        y: {
          grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5],
          },
          ticks: {
            display: true,
            padding: 10,
            color: "#b2b9bf",
            font: {
              size: 11,
              family: "Open Sans",
              style: "normal",
              lineHeight: 2,
            },
          },
        },
        x: {
          grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: false,
            drawTicks: false,
            borderDash: [5, 5],
          },
          ticks: {
            display: true,
            color: "#b2b9bf",
            padding: 20,
            font: {
              size: 11,
              family: "Open Sans",
              style: "normal",
              lineHeight: 2,
            },
          },
        },
      },
    },
  });
</script>
@endpush
