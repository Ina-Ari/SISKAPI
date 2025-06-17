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

<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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

<script>
    let formChanged = false;
    const simpanButton = document.getElementById('btn-simpan');
    const modal = new bootstrap.Modal(document.getElementById('unsavedModal'));

    // Jika user mengubah isi form
    document.querySelectorAll('input, select, textarea').forEach(el => {
        el.addEventListener('input', () => {
            formChanged = true;
        });
    });

    // Saat klik tombol simpan biasa
    simpanButton?.addEventListener('click', () => {
        formChanged = false;
    });

    // Saat user mau meninggalkan halaman
    window.addEventListener('beforeunload', function (e) {
        if (formChanged) {
            e.preventDefault();
            e.returnValue = '';
        }
    });

    // Tangkap event link atau refresh
    document.querySelectorAll('a, button').forEach(link => {
        link.addEventListener('click', function (e) {
            if (formChanged && this.id !== 'btn-simpan' && !this.closest('.modal')) {
                e.preventDefault();
                modal.show();
            }
        });
    });

    // Tombol "Simpan" di dalam modal
    document.getElementById('confirmSave').addEventListener('click', () => {
        modal.hide();
        simpanButton.click();
    });
</script>

SCRIPT.BLADE.PHP



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
