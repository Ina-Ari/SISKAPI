<x-layouts.auth title="Registrasi Akun" :icon="true">
    <div class="mb-5 mt-9">
        <h3 class="text-center text-lg font-semibold">Registrasi Akun Mahasiswa</h3>
        <small class="block text-center text-slate-600">Masukkan NIM dan email yang terdaftar di SION. <strong class="text-sky-600">Pastikan email tersebut masih aktif atau ubah email pada akun SION Anda terlebih dahulu.</strong></small>
    </div>
    @error ('status')
        <small class="text-red-600 text-center block mb-5">{{ $message }}</small>
    @enderror
    <form action="/register" method="POST">
        @csrf
        <input type="hidden" name="type" value="student">
        <div class="group mb-3">
            <label for="nim" class="group-focus-within:text-sky-600 transition block mb-1">Nomor Induk Mahasiswa (NIM)</label>
            <input type="text" name="nim" id="nim" value="{{ old('nim') }}"
                class="px-2 py-2.5 w-full block outline-2 outline outline-slate-400 rounded focus:outline-sky-600 focus:outline-2 transition text-lg">
            @error('nim')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>
        <div class="group mb-7">
            <label for="email" class="group-focus-within:text-sky-600 transition block mb-1">Email SION <small class="text-sky-600 align-top">*pastikan email aktif</small></label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                class="px-2 py-2.5 w-full block outline-2 outline outline-slate-400 rounded focus:outline-sky-600 focus:outline-2 transition text-lg">
            @error('email')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit"
            class="p-3 bg-sky-600 hover:bg-sky-700 active:bg-sky-800 transition rounded w-full text-white font-medium mb-5">Kirim Permintaan</button>
    </form>
    <a href="/login" class="block text-center underline text-sky-600 active:text-sky-800">Kembali Masuk</a>
</x-layouts>
