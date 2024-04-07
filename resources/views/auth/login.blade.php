<x-guest>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <a
                href="{{ route('dashboard') }}"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            >
                <img class="mx-auto h-14 w-auto" src="shield.png">
            </a>
            <h2 class="text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Login to your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('login.store') }}" method="POST">
                @csrf
                <div>
                    <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                    <div class="mt-2">
                        <input id="username" name="username" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->first('username')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">
                        <x-input-error :messages="$errors->first('password')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-red-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-red-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                        Login
                    </button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Need to Register?
                <a href="{{ route('register') }}" class="font-semibold leading-6 text-blue-500 hover:text-blue-600">Register an account</a>
            </p>

            @if (session('status') === 'user-registred')
                <p class="mt-5 text-center text-sm text-green-500">
                    You have successfully registered. Please login.
                </p>
            @elseif(session('status') === 'wrong-credentials')
                <p class="mt-5 text-center text-sm text-red-500">
                    Invalid credentials.
                </p>
            @endif

        </div>
    </div>
</x-guest>
