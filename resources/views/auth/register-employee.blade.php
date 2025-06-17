<x-layouts.auth title="Registrasi Akun" :icon="true">
    <div class="mt-9 flex gap-10 justify-center">
        <a href="/register?type=student"><i class="fa-solid fa-user-graduate text-slate-400 text-5xl"></i></a>
        <div class="w-[1.5px] h-12 bg-gray-300"></div>
        <a href="/register?type=employee"><i class="fa-solid fa-user-tie text-sky-600 text-5xl"></i></a>
    </div>
    <div class="mb-5 mt-4">
        <h3 class="text-center text-lg font-semibold">Registrasi Akun Pegawai</h3>
        <small class="block text-center text-slate-600">Masukkan email Anda dan token registrasi yang diberikan oleh admin. <strong class="text-sky-600">Pastikan email Anda masih aktif.</strong></small>
    </div>
    @error ('status')
        <small class="text-red-600 text-center block mb-5">{{ $message }}</small>
    @enderror
    <form action="/register" method="POST">
        @csrf
        <input type="hidden" name="type" value="employee">
        <div class="group mb-3">
            <label for="token" class="group-focus-within:text-sky-600 transition block mb-1">Token Registrasi</label>
            <input type="text" name="token" id="token" value="{{ old('token') }}"
                class="px-2 py-2.5 w-full block outline-2 outline outline-slate-400 rounded focus:outline-sky-600 focus:outline-2 transition text-lg">
            @error('token')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>
        <div class="group mb-7">
            <label for="email" class="group-focus-within:text-sky-600 transition block mb-1">Email <small class="text-sky-600 align-top">*pastikan email aktif</small></label>
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
