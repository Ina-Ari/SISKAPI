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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin membatalkan kegiatan yang dipilih?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#E02D3C',
            cancelButtonColor: '#3B82F6',
            confirmButtonText: 'Ya, batalkan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formCancel').submit();
            }
        });
    });

    document.getElementById('btnCancelAll').addEventListener('click', function() {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin membatalkan semua kegiatan?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#E02D3C',
            cancelButtonColor: '#3B82F6',
            confirmButtonText: 'Ya, Batalkan Semua',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelectorAll('input[name="selected_kegiatan[]"]').forEach(checkbox => checkbox.checked = true);
                document.getElementById('formCancel').submit();
            }
        });
    });
</script>

<script>
    document.getElementById('btnVerifSelected').addEventListener('click', function(event) {
        event.preventDefault(); // cegah submit default jika button di dalam form

        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin memverifikasi kegiatan yang dipilih?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3B82F6', // biru
            cancelButtonColor: '#E02D3C',  // merah
            confirmButtonText: 'Ya, Verifikasi',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formVerify').submit();
            }
        });
    });

    document.getElementById('btnVerifAll').addEventListener('click', function(event) {
        event.preventDefault(); // cegah submit default jika button di dalam form

        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin memverifikasi semua kegiatan?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3B82F6',
            cancelButtonColor: '#E02D3C',
            confirmButtonText: 'Ya, Verifikasi Semua',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelectorAll('input[name="selected_kegiatan[]"]').forEach(checkbox => checkbox.checked = true);
                document.getElementById('formVerify').submit();
            }
        });
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
                <textarea name="${name1}[]" rows="2" class="form-control"></textarea>
            </div>
            <div class="col-md-6">
                <textarea name="${name2}[]" rows="2" class="form-control"></textarea>
            </div>
        `;
        container.appendChild(div);

        const textareas = div.querySelectorAll('textarea');
            textareas.forEach(textarea => {
                textarea.addEventListener('input', () => {
                    isFormChangedTab2 = true;
                });
                textarea.addEventListener('change', () => {
                    isFormChangedTab2 = true;
                });
        });
    }

    function hapus(containerId) {
        const container = document.getElementById(containerId);
        const children = container.querySelectorAll('.row.mb-2.mx-2');
        let deleted = false;

        const checkedRows = Array.from(children).filter(row => {
            const checkbox = row.querySelector('input[type="checkbox"]');
            return checkbox && checkbox.checked;
        });

        if (checkedRows.length === 0) {
            Swal.fire({
                icon: 'info',
                title: 'Tidak ada data yang dipilih',
                text: 'Silakan centang data yang ingin dihapus.',
                confirmButtonText: 'OK'
            });
            return;
        }

        Swal.fire({
            title: 'Yakin ingin menghapus data yang dipilih?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#E02D3C',
            cancelButtonColor: '#3B82F6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Hapus baris yang dipilih
                checkedRows.forEach(row => {
                    container.removeChild(row);
                });

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data berhasil dihapus.',
                    timer: 1500,
                    showConfirmButton: false
                });

                deleted = true;

                if (deleted) {
                    isFormChangedTab2 = true;
                }
            }
        });
    }

    let isFormChangedTab1 = false;
    let isFormChangedTab2 = false;

    document.querySelectorAll('#form1 input, #form1 textarea, #form1 select').forEach(el => {
        el.addEventListener('input', () => {
            isFormChangedTab1 = true;
        });
        el.addEventListener('change', () => {
            isFormChangedTab1 = true;
        });
    });

    document.querySelectorAll('#form2 input, #form2 textarea, #form2 select').forEach(el => {
        el.addEventListener('input', () => {
            isFormChangedTab2 = true;
        });
        el.addEventListener('change', () => {
            isFormChangedTab2 = true;
        });
    });

    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function(e) {

            // pengecualian untuk tombol simpan
            if (this.id === 'btn-simpan1' || this.id === 'btn-simpan2') {
                isFormChangedTab1 = false;
                isFormChangedTab2 = false;
                return;
            }

            let tabMessage = '';
            if (isFormChangedTab1) tabMessage += 'Tab Identitas Institusi & Prodi';
            if (isFormChangedTab2) tabMessage += 'Tab Kualifikasi & Kompetensi Akademik Lulusan';

            if (isFormChangedTab1 || isFormChangedTab2) {
                e.preventDefault(); // hentikan default

                Swal.fire({
                    title: 'Data belum disimpan!',
                    html: `Ada data yang belum tersimpan pada <b>${tabMessage}</b><br>Apakah Anda ingin menyimpan perubahan?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Simpan',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#3B82F6',
                    cancelButtonColor: '#E02D3C',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // klik tombol simpan pada form yang berubah
                        if (isFormChangedTab1) {
                            document.getElementById('btn-simpan1').click();
                            isFormChangedTab1 = false;
                        }
                        if (isFormChangedTab2) {
                            document.getElementById('btn-simpan2').click();
                            isFormChangedTab2 = false;
                        }
                    }
                });
            }
        });
    });

    document.getElementById('btn-simpan1').addEventListener('click', () => {
        isFormChangedTab1 = false;
    });

    document.getElementById('btn-simpan2').addEventListener('click', () => {
        isFormChangedTab2 = false;
    });

    window.addEventListener('beforeunload', function (e) {
        if (isFormChangedTab1 || isFormChangedTab2) {
            e.preventDefault();
            e.returnValue = '';
        }
    });
</script>

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Data berhasil disimpan.',
            timer: 1500,
            showConfirmButton: false
        });
    </script>
@endif

@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Data belum lengkap!!',
            html: `{!! implode('<br>', $errors->all()) !!}`,
        });
    </script>
@endif

<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data berhasil dihapus.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            })
        });
    });
</script>
