<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="icon" href="{{ asset('/storage/pictures/logo.png') }}">
    @if ($icon ?? false)
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endif
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <main class="bg-cover bg-center min-h-screen min-w-full"
        style="background-image: url({{ asset('storage/pictures/authbg.png') }})">
        <div
            class="container flex flex-col min-h-screen w-full py-8 max-w-full mx-auto backdrop-blur-sm bg-black/70">
            <div class="my-auto mx-6">
                <h1 class="text-5xl text-center font-bold text-sky-600 tracking-[0.8rem] drop-shadow-2xl mb-3">
                    SISKAPI
                </h1>
                <h2 class="text-xl text-center font-semibold text-white drop-shadow-2xl mb-16">
                    Politeknik Negeri Bali
                </h2>
                <div
                    class="w-full max-w-sm mx-auto bg-white p-7 rounded-lg shadow-2xl border-sky-600 border-[3px] relative">
                    <img src="{{ asset('storage/pictures/logo.png') }}" alt="Logo PNB"
                        class="w-24 h-24 absolute -top-12 left-1/2 -translate-x-1/2">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </main>
</body>

</html>
