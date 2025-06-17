<x-layouts.auth title="Lupa Kata Sandi" :icon="false">
    <div class="mb-5 mt-9">
        <h3 class="text-center text-lg font-semibold">Lupa Kata Sandi?</h3>
        <small class="block text-center text-slate-600">Masukkan email yang terdaftar untuk mengatur ulang kata sandi Anda.</small>
    </div>
    @if (session('status'))
        <div class="mb-5 text-center text-green-600">
            {{ session('status') }}
        </div>
    @endif
    @error ('status')
        <small class="text-red-600 text-center block mb-5">{{ $message }}</small>
    @enderror
    <form action="/forgot-password" method="POST">
        @csrf
        <div class="group mb-7">
            <label for="email" class="group-focus-within:text-sky-600 transition block mb-1">Email</label>
            <input type="text" name="email" id="email" value="{{ old('email') }}"
                class="px-2 py-2.5 w-full block outline-2 outline outline-slate-400 rounded focus:outline-sky-600 focus:outline-2 transition text-lg">
            @error('email')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit"
            class="p-3 bg-sky-600 hover:bg-sky-700 active:bg-sky-800 transition rounded w-full text-white font-medium mb-5">Kirim Permintaan</button>
    </form>
    <a href="/login" class="block text-center underline text-sky-600 active:text-sky-800">Kembali Masuk</a>
</x-layouts.auth>
