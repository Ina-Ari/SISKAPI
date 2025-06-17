<x-layouts.auth title="Atur Ulang Kata Sandi">
    <div class="mb-5 mt-9">
        <h3 class="text-center text-lg font-semibold">Atur Ulang Kata Sandi</h3>
        <small class="block text-center text-slate-600">Masukkan kata sandi baru Anda di bawah ini.</small>
    </div>
    @error ('status')
        <small class="text-red-600 text-center block mb-5">{{ $message }}</small>
    @enderror
    <form action="/reset-password" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <div class="group mb-3">
            <label for="password" class="group-focus-within:text-sky-600 transition block mb-1">Kata Sandi</label>
            <input type="password" name="password" id="password" value="{{ old('password') }}"
                class="px-2 py-2.5 w-full block outline-2 outline outline-slate-400 rounded focus:outline-sky-600 focus:outline-2 transition text-lg">
            @error('password')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
            @error('email')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
            @error('token')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>
        <div class="group mb-7">
            <label for="password_confirmation" class="group-focus-within:text-sky-600 transition block mb-1">Konfirmasi Kata Sandi</label>
            <input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}"
                class="px-2 py-2.5 w-full block outline-2 outline outline-slate-400 rounded focus:outline-sky-600 focus:outline-2 transition text-lg">
            @error('password_confirmation')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit"
            class="p-3 bg-sky-600 hover:bg-sky-700 active:bg-sky-800 transition rounded w-full text-white font-medium">Simpan & Masuk</button>
    </form>
</x-layouts.auth>
