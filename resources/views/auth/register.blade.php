<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Green University</title>
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
        }
    </style>
</head>
<body class="min-h-screen min-h-[100dvh] bg-[#1b804e] relative">

    <!-- Decorations: clipped inside a fixed layer so they never create scrollbars -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0" aria-hidden="true">
        <div class="absolute top-8 left-8 w-40 h-40 dot-pattern opacity-60 hidden md:block"></div>
        <div class="absolute -bottom-10 -right-10 w-64 h-64 dot-pattern opacity-40 hidden md:block"></div>
    </div>

    <!-- Page wrapper: centers content, scrolls only if the screen is really short -->
    <main class="relative z-10 min-h-screen min-h-[100dvh] w-full flex items-center justify-center px-4 py-6 sm:px-6 sm:py-10">
        <div class="w-full max-w-lg">

            <!-- Badge -->
            <div class="flex justify-center mb-3">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-[10px] sm:text-[11px] font-semibold tracking-wider text-white uppercase bg-white/10 backdrop-blur-md border border-white/20 shadow-sm">
                    <svg class="w-3.5 h-3.5 text-emerald-300 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a10.99 10.99 0 00-.25 2.319 6.06 6.06 0 001.077 3.42 10.978 10.978 0 003.535 3.197 1 1 0 00.776 0 10.978 10.978 0 003.535-3.197 6.06 6.06 0 001.077-3.42 10.99 10.99 0 00-.25-2.319l2.644-1.131a1 1 0 000-1.84l-7-3zM10 4.218L14.757 6.26 10 8.3 5.243 6.26 10 4.218z"/>
                    </svg>
                    Create New Account
                </span>
            </div>

            <!-- Header Titles -->
            <div class="text-center mb-4 sm:mb-5">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">Join Green Campus</h1>
                <p class="text-white/80 text-xs sm:text-sm mt-1 font-medium">Start recycling and earning reward points</p>
            </div>

            <!-- Card Container -->
            <div class="bg-white rounded-3xl p-5 sm:p-8 shadow-2xl shadow-emerald-950/20">
                <form action="{{ route('register') }}" method="POST" class="space-y-3.5">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                        <div>
                            <label class="block text-[11px] font-bold tracking-wide uppercase text-gray-700 mb-1" for="university_id">University ID</label>
                            <input type="text" name="university_id" id="university_id" value="{{ old('university_id') }}" maxlength="9" placeholder="e.g. 20240123" required
                                class="w-full px-3.5 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 text-base sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#1b804e] focus:border-transparent">
                            @error('university_id') <span class="text-[11px] text-red-600 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold tracking-wide uppercase text-gray-700 mb-1" for="name">Full Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Your Name" autocomplete="name" required
                                class="w-full px-3.5 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 text-base sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#1b804e] focus:border-transparent">
                            @error('name') <span class="text-[11px] text-red-600 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                        <div>
                            <label class="block text-[11px] font-bold tracking-wide uppercase text-gray-700 mb-1" for="email">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="user@university.edu" autocomplete="email" required
                                class="w-full px-3.5 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 text-base sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#1b804e] focus:border-transparent">
                            @error('email') <span class="text-[11px] text-red-600 mt-1 block break-words">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold tracking-wide uppercase text-gray-700 mb-1" for="college">College / Faculty</label>
                            <input type="text" name="college" id="college" value="{{ old('college') }}" placeholder="e.g. Computer Science" required
                                class="w-full px-3.5 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 text-base sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#1b804e] focus:border-transparent">
                            @error('college') <span class="text-[11px] text-red-600 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                        <div>
                            <label class="block text-[11px] font-bold tracking-wide uppercase text-gray-700 mb-1" for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" autocomplete="new-password" required
                                class="w-full px-3.5 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 text-base sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#1b804e] focus:border-transparent">
                            @error('password') <span class="text-[11px] text-red-600 mt-1 block break-words">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold tracking-wide uppercase text-gray-700 mb-1" for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" autocomplete="new-password" required
                                class="w-full px-3.5 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 text-base sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#1b804e] focus:border-transparent">
                        </div>
                    </div>

                    <button type="submit" class="w-full mt-2 py-3.5 px-6 rounded-full bg-[#1b804e] hover:bg-[#15673e] text-white font-bold text-sm tracking-wide shadow-lg shadow-[#1b804e]/20 transition duration-200 flex items-center justify-center gap-2">
                        Create Account
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </form>

                <div class="mt-5 pt-4 border-t border-gray-100 text-center">
                    <p class="text-xs text-gray-600 font-medium">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-bold text-[#1b804e] hover:underline">Sign In</a>
                    </p>
                </div>
            </div>

        </div>
    </main>

</body>
</html>