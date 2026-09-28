<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Green University</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        html, body {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;          /* no horizontal scroll */
            scrollbar-width: none;       /* Firefox: hide scrollbar */
            -ms-overflow-style: none;    /* old Edge/IE */
        }
        html::-webkit-scrollbar,
        body::-webkit-scrollbar { display: none; }  /* Chrome, Safari, Android */

        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        .dot-pattern {
            background-image: radial-gradient(rgba(255, 255, 255, 0.22) 1.5px, transparent 1.5px);
            background-size: 20px 20px;
            box-sizing: border-box;
        }
    </style>
</head>
<body class="min-h-screen min-h-[100dvh] bg-[#1b804e] relative">

    <!-- Decorations: clipped inside a fixed layer so they never create scrollbars -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0" aria-hidden="true">
        <div class="absolute top-12 left-12 w-48 h-48 dot-pattern opacity-70 hidden md:block"></div>
        <div class="absolute -bottom-10 -right-10 w-64 h-64 dot-pattern opacity-50 hidden md:block"></div>
    </div>

    <!-- Page wrapper: centers content, scrolls only if the screen is really short -->
    <main class="relative z-10 min-h-screen min-h-[100dvh] w-full flex items-center justify-center px-4 py-6 sm:px-6 sm:py-10">
        <div class="w-full max-w-md">

            <!-- System Notifications & Alerts -->
            <div class="space-y-3 mb-5 empty:hidden">

                <!-- 1. Form Validation Errors -->
                @if ($errors->any())
                <div class="bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl p-3 sm:p-4 shadow-sm flex items-start gap-3">
                    <div class="w-8 h-8 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="text-xs font-extrabold uppercase tracking-wider text-rose-900 mb-1">Action Required</h4>
                        <ul class="list-disc list-inside text-xs font-medium space-y-0.5 text-rose-700 break-words">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <!-- 2. Flash Session Error -->
                @if (session('error'))
                <div class="bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl p-3 sm:p-4 shadow-sm flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-8 h-8 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-rose-900 break-words">{{ session('error') }}</p>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-rose-400 hover:text-rose-600 shrink-0" aria-label="Dismiss">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                @endif

                <!-- 3. Flash Session Success -->
                @if (session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-900 rounded-2xl p-3 sm:p-4 shadow-sm flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-8 h-8 rounded-xl bg-emerald-100 text-[#1b804e] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-emerald-900 break-words">{{ session('success') }}</p>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-600 shrink-0" aria-label="Dismiss">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                @endif

            </div>

            <!-- Badge -->
            <div class="flex justify-center mb-5 sm:mb-6">
                <span class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 rounded-full text-[10px] sm:text-xs font-semibold tracking-wider text-white uppercase bg-white/10 backdrop-blur-md border border-white/20 shadow-sm">
                    <svg class="w-4 h-4 text-emerald-300 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a10.99 10.99 0 00-.25 2.319 6.06 6.06 0 001.077 3.42 10.978 10.978 0 003.535 3.197 1 1 0 00.776 0 10.978 10.978 0 003.535-3.197 6.06 6.06 0 001.077-3.42 10.99 10.99 0 00-.25-2.319l2.644-1.131a1 1 0 000-1.84l-7-3zM10 4.218L14.757 6.26 10 8.3 5.243 6.26 10 4.218zM6.924 9.176L10 10.495l3.076-1.319c.148.65.234 1.332.25 2.036a4.06 4.06 0 01-.722 2.296 9.006 9.006 0 01-2.604 2.378 9.006 9.006 0 01-2.604-2.378 4.06 4.06 0 01-.722-2.296c.016-.704.102-1.386.25-2.036z"></path>
                    </svg>
                    Smart Waste Management
                </span>
            </div>

            <!-- Header Titles -->
            <div class="text-center mb-6 sm:mb-8">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">Welcome</h1>
                <p class="text-white/80 text-sm mt-2 font-medium">Log in to track your campus recycling activity</p>
            </div>

            <!-- Login Card -->
            <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-2xl shadow-emerald-950/20">
                <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Email Input -->
                    <div>
                        <label class="block text-xs font-bold tracking-wide uppercase text-gray-700 mb-2" for="email">
                            Email
                        </label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            placeholder="example@gmail.com"
                            autocomplete="email"
                            required
                            class="w-full px-4 py-3 sm:py-3.5 rounded-2xl bg-gray-50 border border-gray-200 text-gray-900 text-base sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#1b804e] focus:border-transparent transition-all duration-200"
                        >
                        @error('email')
                            <span class="text-xs text-red-600 mt-1.5 block font-medium">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label class="text-xs font-bold tracking-wide uppercase text-gray-700" for="password">
                                Password
                            </label>
                        </div>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="••••••••"
                            autocomplete="current-password"
                            required
                            class="w-full px-4 py-3 sm:py-3.5 rounded-2xl bg-gray-50 border border-gray-200 text-gray-900 text-base sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#1b804e] focus:border-transparent transition-all duration-200"
                        >
                        @error('password')
                            <span class="text-xs text-red-600 mt-1.5 block font-medium">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Remember Me / Forgot -->
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center">
                            <input
                                id="remember"
                                name="remember"
                                type="checkbox"
                                class="h-4 w-4 rounded border-gray-300 text-[#1b804e] focus:ring-[#1b804e]"
                            >
                            <label for="remember" class="ml-2.5 block text-xs font-medium text-gray-600">
                                Keep me logged in
                            </label>
                        </div>

                        <a href="{{ route('forget_page') }}" class="text-xs font-semibold text-[#1b804e] hover:underline whitespace-nowrap">
                            Forgot?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full py-3.5 sm:py-4 px-6 rounded-full bg-[#1b804e] hover:bg-[#15673e] text-white font-bold text-sm tracking-wide shadow-lg shadow-[#1b804e]/25 hover:shadow-none transition-all duration-200 flex items-center justify-center gap-2 group"
                    >
                        Sign In
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>

                </form>

                <!-- Card Footer -->
                <div class="mt-6 sm:mt-8 pt-5 sm:pt-6 border-t border-gray-100 text-center">
                    <p class="text-xs text-gray-600 font-medium">
                        Don't have an account?
                        <a href="{{ route('register_page') }}" class="font-bold text-[#1b804e] hover:underline ml-1">
                            Register here
                        </a>
                    </p>
                </div>
            </div>

        </div>
    </main>

</body>
</html>