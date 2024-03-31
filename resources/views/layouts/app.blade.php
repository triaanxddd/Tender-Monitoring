<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('dashboard-template') }}/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="{{ asset('logo') }}/energia-64x64.png">
  <title>
    Kegiatan Tender Energia
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('dashboard-template') }}/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="{{ asset('dashboard-template') }}/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('dashboard-template') }}/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('dashboard-template') }}/assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
  <link id="pagestyle" href="{{ asset('dashboard-template') }}/assets/css/modal.css" rel="stylesheet" />
  <script src="{{ asset('dashboard-template') }}/assets/js/plugins/chartjs.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  
  <script src="{{ asset('dashboard-template') }}/assets/js/jquery.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <!-- Include the dom-to-image library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>

  <!-- Include the jsPDF library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

  <script>
    $( function() {
      var availableTags = [];

        $.ajax({
            method: "GET",
            url: "/task-list",
            success: function (response) {
                //console.log(response);
                startAutoComplete(response);
            }
        });

        function startAutoComplete(tasks) {
            var names = tasks.map(task => task.name);
            var ids = tasks.map(task => task.id);

            $("#search_bar").autocomplete({
                source: names,
                select: function (event, ui) {
                    var selectedId = ids[names.indexOf(ui.item.label)];
                    var formAction = "/tasks/" + selectedId;
                    $('#search_form').attr('action', formAction);
                }
            });
        }

    } );
  </script>
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('layouts.sidebar')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('layouts.navbar')
    @include('partials.modal')
    <!-- End Navbar -->
    @yield('container')
  </main>

  @include('layouts.configurator')
  
  <!--   Core JS Files   -->
  <script src="{{ asset('dashboard-template') }}/assets/js/modal.js"></script>
  <script src="{{ asset('dashboard-template') }}/assets/js/currency-masking.js"></script>
  <script src="{{ asset('dashboard-template') }}/assets/js/core/popper.min.js"></script>
  <script src="{{ asset('dashboard-template') }}/assets/js/core/bootstrap.min.js"></script>
  <script src="{{ asset('dashboard-template') }}/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="{{ asset('dashboard-template') }}/assets/js/plugins/smooth-scrollbar.min.js"></script>

  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    };

    //toggle slide
    $(document).ready(function() {
        $('.title-name').click(function() {
            $(this).next('.sub-div').slideToggle('slow');
            $(this).find('.icon').toggleClass('fa-angle-down fa-angle-up');
        });
    });
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('dashboard-template') }}/assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>