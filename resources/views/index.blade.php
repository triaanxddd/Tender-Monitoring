@extends('layouts.app')
@php 
use Illuminate\Support\Carbon;

@endphp
@section('container')
<div class="container-fluid py-4">
      <div class="row">
        @include('partials.dashboard_panel', [
                  'title' => 'Total Pekerjaan', 
                  'numbers' => $tasks->count(), 
                  'line1' => $categories->count(), 
                  'line1Color' => 'success',
                  'line2' => 'Kategori',
                  'icon' => 'fa fa-tasks',
                  'iconColor' => 'primary',
                  'url' => route('tasks.index') ])

      <!-- loop categories for panels -->
      @foreach($categories as $category)

        @include('partials.dashboard_panel', [
                  'title' => $category->name, 
                  'numbers' => $category->task()->count(), 
                  'url' => route('tasks.index') . "?search_category={$category->id}",

                  'icon' => 'fa fa-table',
                  'iconColor' => 'success',

                  'line1' => $category->task()->whereYear('tanggal_upload', Carbon::now()->year)->count(), 
                  'line1Color' => 'success',
                  'line2' => 'Tender Baru (Bulan Ini)',
                  
                  'line1Win' => $category->task()->where('status_pemenang', 1)->count(), 
                  'line2Win' => 'Menang Lelang',
                  'lineWinColor' => 'info',
                  'line1Url' => route('tasks.index'). "?search_category={$category->id}&search_status=1",

                  'line1Lose' => $category->task()->where('status_pemenang', 2)->count(),
                  'line2Lose' => 'Kalah Lelang',
                  'lineLoseColor' => 'danger',
                  'line2Url' => route('tasks.index'). "?search_category={$category->id}&search_status=2",

                  ])

      @endforeach

      </div>
      <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
          <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <div id="search-results"></div>
              <h6 class="text-capitalize">Statistik Pelelangan</h6>
              <p class="text-sm mb-0">
              </p>
            </div>
            <div class="card-body p-3">
              <form action="" method="get">
                <div class="row d-flex">
                      <div class="col-2">
                        <select name="search_year" id="search_year" class="form-control">
                            <option value="0" selected>Pilih Tahun</option>
                            <option value="2023" >2023</option>
                            <option value="2024" >2024</option>
                        </select>
                      </div>
                      <div class="col">
                        <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                    </div>
              </form>
              <div class="chart">
                <canvas id="chart-line" class="chart-canvas" height="200"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <!-- Log Activity -->
          <div class="card">
          <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Stok Barang</h6>
            </div>
            <div class="card-body p-3">
              <ul class="list-group">
                @foreach($goods->take(15) as $good)
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                      <i class="fa fa-dropbox text-white opacity-10"></i>
                    </div>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">{{ $good->name }}</h6>
                      <span class="text-xs">{{ $good->total }} jumlah stok, <span class="font-weight-bold">{{ $good->demandedGoods->count() }} permintaan</span></span>
                    </div>
                  </div>
                  <div class="d-flex">
                    <a href="{{ route('goods.show', ['good' => $good->id]) }}" class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></a>
                  </div>
                </li>
                @endforeach
              </ul>
            </div>
        </div>
        </div>
        </div>
      </div>

</div>
  <script>
  // Sample data for the scatter plot
  const taskData = @json($taskData);
  console.log(taskData);

  const data = {
      datasets: [{
          label: '',
          data: taskData,

          backgroundColor: '#596CFF', // Dot color
      }]
  };

  // Chart configuration
  const config = {
      type: 'scatter',
      data: data,
      options: {
          animation: {
              duration: 2000,
              easing: 'easeInOutQuart'
          },
          interaction: {
              mode: 'index',
              intersect: false
          },
          scales: {
              x: {
                  type: 'category', // Use category scale for x-axis
                  position: 'bottom',
                  grid: {
                      display: false, // Hide x-axis grid lines
                  },
              },
              y: {
                  type: 'category', // Use category scale for y-axis
                  labels: ['Pekerjaan Selesai', 
                          'Pembayaran', 
                          'Penagihan', 
                          'Laporan', 
                          'Uraian', 
                          'Menunggu Proses Lelang',
                          'Kalah Lelang'], // Y-axis labels
                  position: 'left',
                  grid: {
                    display: true // Hide x-axis grid lines
                },
              }
          },
          layout: {
              padding: {
                  bottom: 20 // Adjust the bottom padding to lower the x-axis labels
              }
          },
          elements: {
              point: {
                  radius: 6,
                  backgroundColor: 'rgba(75, 192, 192, 0.5)',
                  borderColor: 'rgba(75, 192, 192, 1)',
                  borderWidth: 2
              }
          },
         
      },
  };

  // Get the canvas element and create the chart
  const ctx = document.getElementById('chart-line').getContext('2d');
  const scatterChart = new Chart(ctx, config);
  Chart.defaults.font.family = 'Arial';
  Chart.defaults.color = 'rgba(255, 99, 132, 1)';

  console.log(scatterChart.data.datasets[0].data);

  //year live search
    // $(document).ready(function () {
    //   $("#search_year").change(function () {
    //     var selectedYear = $(this).val();

    //     $.ajax({
    //       method: "GET",
    //       url: "/dashboard/get_tasks_by_year",
    //       data: { search_year: selectedYear },
    //       success: function (response) {
    //         // Filter existing chart data for the selected year
    //         const newData = response.tasksForYear;

    //         // Clear all existing data on the chart
    //         scatterChart.data.datasets[0].data = [];

    //         // Add only the new data for the selected year
    //         scatterChart.data.datasets[0].data = newData;

    //         console.log(scatterChart.data.datasets[0].data);

    //         // Update the chart
    //         scatterChart.update();
    //       },
    //       error: function (error) {
    //         console.error("Error:", error);
    //       },
    //     });
    //   });
    // });

  </script>
@endsection