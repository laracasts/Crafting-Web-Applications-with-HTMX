<html>
    <head>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-900 text-alternate">
        <header class="pt-4">
            <div class="px-4 lg:px-8 grid grid-cols-5 items-center gap-4">
                <div class="col-span-2 h-10 justify-self-start">
                    
                </div>
                <img
                    src="{{ Vite::asset('resources/assets/laracasts-symbol.svg') }}"
                    alt=""
                    class="hidden size-8 justify-self-center sm:block"
                />
            </div>
        </header>
        <main>
            <div>
                <div id="change-content"></div>
                <div class="mt-16">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </body>
</html>