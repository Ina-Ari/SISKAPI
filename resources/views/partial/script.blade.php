<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>


<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>


<!-- ApexCharts library -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" crossorigin="anonymous"></script>

<!-- Script untuk chart -->

<!-- Script untuk chart -->
<script>
   const skpi_chart_options = {
    series: [
       {
        name: 'Total Pengajuan SKPI',
        data: [28, 48, 40, 19, 86, 27, 90],
      },
      {
        name: 'Proses Verifikasi',
        data: [65, 59, 80, 81, 56, 55, 40],
      },
      {
        name: 'Telah Diverifikasi',
        data: [52, 30, 15, 45, 24, 60, 70],
      },
      {
        name: 'Pengajuan Direvisi',
        data: [5, 15, 10, 29, 24, 22, 23],
      },
    ],
    chart: {
      height: 300,
      type: 'area',
      toolbar: {
        show: false,
      },
    },
    legend: {
      show: false,
    },
    colors: ['#3B82F6', '#EAB308', '#059669', '#BA2532'],
    dataLabels: {
      enabled: false,
    },
    stroke: {
      curve: 'smooth',
    },
    xaxis: {
      type: 'datetime',
      categories: [

        '2025-01-01',
        '2025-02-01',
        '2025-03-01',
        '2025-04-01',
        '2025-05-01',
        '2025-06-01',
        '2025-07-01',
      ],
    },
    tooltip: {
      x: {
        format: 'MMMM yyyy',
      },
    },
  };

   const skpi_chart = new ApexCharts(document.querySelector("#skpi-chart"), skpi_chart_options);
  skpi_chart.render();
</script>

{{-- <script>
  const skpi_chart_options = {
    series: [
      {
        name: 'Total Pengajuan SKPI',
        data: [60, 80, 100, 140, 200, 260, 320, 382],
      },
      {
        name: 'Proses Verifikasi',
        data: [10, 20, 30, 45, 60, 80, 100, 120],
      },
      {
        name: 'Telah Diverifikasi',
        data: [20, 40, 60, 90, 120, 150, 180, 200],
      },
      {
        name: 'Pengajuan Direvisi',
        data: [5, 10, 15, 25, 40, 55, 70, 80],
      },
    ],
    chart: {
      type: 'line',
      height: 300,
      toolbar: {
        show: false,
      },
    },
    stroke: {
      curve: 'smooth',
      width: 3,
    },
    colors: ['#3B82F6', '#EAB308', '#059669', '#BA2532'],
    xaxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug'],
    },
    legend: {
      position: 'top',
      horizontalAlign: 'center',
    },
    tooltip: {
      shared: true,
      intersect: false,
    },
  };

  const skpi_chart = new ApexCharts(document.querySelector("#skpi-chart"), skpi_chart_options);
  skpi_chart.render();
</script> --}}

