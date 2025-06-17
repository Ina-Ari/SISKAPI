<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

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

<script>
  document.getElementById('btnCancelSelected').addEventListener('click', function() {
      if (confirm('Apakah Anda yakin ingin membatalkan kegiatan yang dipilih?')) {
          document.getElementById('formCancel').submit();
      }
  });
  document.getElementById('btnCancelAll').addEventListener('click', function() {
      if (confirm('Apakah Anda yakin ingin membatalkan semua kegiatan?')) {
          document.querySelectorAll('input[name="selected_kegiatan[]"]').forEach(checkbox => checkbox.checked = true);
          document.getElementById('formCancel').submit();
      }
  });
</script>

<script>
  document.getElementById('btnVerifSelected').addEventListener('click', function() {
      if (confirm('Apakah Anda yakin ingin memverifikasi kegiatan yang dipilih?')) {
          document.getElementById('formVerify').submit();
      }
  });

  document.getElementById('btnVerifAll').addEventListener('click', function() {
      if (confirm('Apakah Anda yakin ingin memverifikasi semua kegiatan?')) {
          document.querySelectorAll('input[name="selected_kegiatan[]"]').forEach(checkbox => checkbox.checked = true);
          document.getElementById('formVerify').submit();
      }
  });
</script>

<script>
function setActiveTab(event, formIdToShow) {
    event.preventDefault();

    // Reset semua tab
    document.querySelectorAll('#customTabs .nav-link span').forEach(el => {
    el.classList.remove('custom-tab-active');
    });

    // Tambah active pada yang diklik
    event.currentTarget.querySelector('span').classList.add('custom-tab-active');

    // Tampilkan form yang sesuai
    document.querySelectorAll('#formContainer form').forEach(form => {
    form.style.display = 'none';
    });
    document.getElementById(formIdToShow).style.display = 'block';
}

// Set tab pertama aktif saat awal load
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('#customTabs .nav-link')[0].click();
});
</script>

{{-- <script>
function tambahPernyataan1() {
  const container = document.getElementById('statement-container1');

  const row = document.createElement('div');
  row.className = 'row mb-2';
  row.innerHTML = `
    <div class="col-md-6">
      <input type="text" name="sikap[]" class="form-control">
    </div>
    <div class="col-md-6">
      <input type="text" name="attitude[]" class="form-control">
    </div>
  `;

  container.appendChild(row);
}

function tambahPernyataan2() {
  const container = document.getElementById('statement-container2');

  const row = document.createElement('div');
  row.className = 'row mb-2';
  row.innerHTML = `
    <div class="col-md-6">
      <input type="text" name="pengetahuan[]" class="form-control">
    </div>
    <div class="col-md-6">
      <input type="text" name="knowledge[]" class="form-control">
    </div>
  `;

  container.appendChild(row);
}

function tambahPernyataan3() {
  const container = document.getElementById('statement-container3');

  const row = document.createElement('div');
  row.className = 'row mb-2';
  row.innerHTML = `
    <div class="col-md-6">
      <input type="text" name="ketUmum[]" class="form-control">
    </div>
    <div class="col-md-6">
      <input type="text" name="genSkills[]" class="form-control">
    </div>
  `;

  container.appendChild(row);
}

function tambahPernyataan4() {
  const container = document.getElementById('statement-container4');

  const row = document.createElement('div');
  row.className = 'row mb-2';
  row.innerHTML = `
    <div class="col-md-6">
      <input type="text" name="ketKhusus[]" class="form-control">
    </div>
    <div class="col-md-6">
      <input type="text" name="specSkills[]" class="form-control">
    </div>
  `;

  container.appendChild(row);
}
</script> --}}

<script>
        function tambahPernyataan(containerId, name1, name2) {
            const container = document.getElementById(containerId);
            const div = document.createElement('div');
            div.className = 'row mb-2 mx-2 align-items-center';

            div.innerHTML = `
                <div class="" >
                    <input type="checkbox" class="form-check-input mt-1">
                </div>
                <div class="col-md-6">
                    <input type="text" name="${name1}[]" class="form-control">
                </div>
                <div class="col-md-6">
                    <input type="text" name="${name2}[]" class="form-control">
                </div>
            `;
            container.appendChild(div);
        }

         function hapus(containerId) {
            const container = document.getElementById(containerId);
            const children = container.querySelectorAll('.row.mb-2.mx-2');
            children.forEach(row => {
                const checkbox = row.querySelector('input[type="checkbox"]');
                if (checkbox.checked) {
                    container.removeChild(row);
                }
            });
        }
    </script>

