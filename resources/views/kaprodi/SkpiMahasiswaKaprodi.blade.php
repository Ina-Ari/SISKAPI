@extends('kaprodi.masterKaprodi')

@section('title', 'Daftar Mahasiswa')

@section('content')
    {{-- Header --}}
    <section class="m-4 d-flex align-items-center justify-content-between">
        <h1 class="text-bold text-primary drop">SKPI Mahasiswa</h1>
        <button type="button" class="btn btn-primary py-2 px-4" data-toggle="modal" data-target="#templatePreview">
            <i class="fa fa-eye mr-2"></i>
            Lihat Template SKPI
        </button>
    </section>

    {{-- Table --}}
    <section class="m-4 p-3 bg-white rounded shadow-sm">
        <form action="#" class="d-flex align-items-center" style="gap: 1rem">
            <label for="status" class="font-weight-normal">
                Status SKPI
                <select name="status" id="status" class="form-control w-auto">
                    <option value="Menunggu">Menunggu</option>
                    <option value="Diajukan">Diajukan</option>
                    <option value="Revisi">Revisi</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </label>
            <label for="angkatan" class="font-weight-normal">
                Angkatan
                <select name="angkatan" id="angkatan" class="form-control w-auto">
                    <option value="20222">20222</option>
                    <option value="20223">20223</option>
                    <option value="20224">20224</option>
                </select>
            </label>
        </form>

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Mahasiswa</th>
                    <th>Angkatan</th>
                    <th>No. Handphone</th>
                    <th>Status SKPI</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Muhammad Reza Haryanto</td>
                    <td>20222</td>
                    <td>082146934377</td>
                    <td>
                        <span class="py-2 px-4 bg-warning rounded m-auto d-block text-center">
                            Menunggu
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-primary">
                            <i class="fa fa-eye"></i>
                        </button>
                        <button class="btn btn-warning text-white">
                            <i class="fa fa-pen"></i>
                        </button>
                        <button class="btn btn-success">
                            <i class="fa fa-plus"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>


    {{-- Modal --}}
    <div class="modal fade" id="templatePreview" tabindex="-1" aria-labelledby="templatePreviewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header align-items-center py-2">
                    <h3 class="modal-title font-weight-bold text-primary" id="templatePreviewLabel">Template SKPI</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
