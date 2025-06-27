<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100 text-gray-900 flex items-center justify-center px-4 sm:px-0">

    <div class="w-full max-w-screen-xl bg-white shadow sm:rounded-lg flex flex-col lg:flex-row overflow-hidden">
        <!-- Form Section -->
        <div class="w-full lg:w-1/2 p-6 sm:p-12">
            <div class="flex justify-center mb-6 lg:mb-0">
                <img src="https://storage.googleapis.com/devitary-image-host.appspot.com/15846435184459982716-LogoMakr_7POjrN.png" class="w-24 sm:w-32" />
            </div>

            <div class="flex flex-col items-center">
                <h1 class="text-xl sm:text-2xl lg:text-3xl font-extrabold mb-4">Log in</h1>

                @if (session('status'))
                    <div class="text-sm text-green-600 mb-4">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="w-full max-w-xs">
                    @csrf

                    <!-- Email -->
                    <label for="email" class="block mb-1 font-medium text-sm text-gray-700">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3 rounded-lg bg-gray-100 border border-gray-300 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                        placeholder="you@example.com">
                    @error('email')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Password -->
                    <label for="password" class="block mt-4 mb-1 font-medium text-sm text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-3 rounded-lg bg-gray-100 border border-gray-300 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                        placeholder="••••••••">
                    @error('password')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" name="remember"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-between mt-6">
                        @if (Route::has('password.request'))
                            <a class="text-sm text-indigo-600 hover:underline" href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        @endif

                        <button type="submit"
                            class="ml-3 tracking-wide font-semibold bg-indigo-500 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            Log in
                        </button>
                    </div>
                </form>

                <p class="mt-6 text-xs text-gray-600 text-center">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="border-b border-gray-500 hover:text-indigo-600">
                        Sign Up
                    </a>
                </p>
            </div>
        </div>

        <!-- Image Section -->
        <div class="hidden lg:flex w-full lg:w-1/2 bg-indigo-100 items-center justify-center">
            <div class="m-8 w-full h-64 bg-no-repeat bg-center bg-contain"
                style="background-image: url('https://storage.googleapis.com/devitary-image-host.appspot.com/15848031292911696601-undraw_designer_life_w96d.svg');">
            </div>
        </div>
    </div>

</body>
</html>
