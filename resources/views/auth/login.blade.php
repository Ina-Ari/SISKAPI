<x-layouts.auth title="Masuk" :icon="false">
    <h3 class="text-center text-lg font-semibold mb-6 mt-9">Masuk ke Dashboard</h3>
    @if (session('status'))
        <div class="mb-5 text-center text-green-600">
            {{ session('status') }}
        </div>
    @endif
    @error ('status')
        <small class="text-red-600 text-center block mb-5">{{ $message }}</small>
    @enderror
    <form action="/login" method="POST">
        @csrf
        <div class="group mb-3">
            <label for="username" class="group-focus-within:text-sky-600 transition block mb-1">Nama Pengguna</label>
            <input type="text" name="username" id="username" value="{{ old('username') }}"
                class="px-2 py-2.5 w-full block outline-2 outline outline-slate-400 rounded focus:outline-sky-600 focus:outline-2 transition text-lg">
            @error('username')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>
        <div class="group mb-3">
            <label for="password"
                class="group-focus-within:text-sky-600 transition block mb-1">Kata Sandi</label>
            <input type="password" name="password" id="password"
                class="px-2 py-2.5 w-full block outline-2 outline outline-slate-400 rounded focus:outline-sky-600 focus:outline-2 transition text-lg">
            @error('password')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>
        <div class="flex justify-between mb-7">
            <label for="remember" class="flex items-center gap-1.5">
                <input type="checkbox" name="remember" id="remember" value="1" {{ old('remember', false) ? 'checked' : '' }}
                    class="w-[18px] h-[18px] checked:accent-sky-600">
                Ingat saya
            </label>
            <a href="/forgot-password" class="text-sky-600 underline active:text-sky-800">
                Lupa kata sandi?
            </a>
        </div>
        <button type="submit"
            class="p-3 bg-sky-600 hover:bg-sky-700 active:bg-sky-800 transition rounded w-full text-white font-medium">Masuk</button>
    </form>
    <p class="text-center mt-6">
        Belum memiliki akun?
        <a href="/register" class="text-sky-600 underline active:text-sky-800"> Registrasi sekarang</a>
    </p>
</x-layouts.auth>
