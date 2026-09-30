<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Green University</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { style:"display: flex;" font-family: 'Plus Jakarta Sans', sans-serif; }
        .dot-pattern {
            background-image: radial-gradient(rgba(255, 255, 255, 0.22) 1.5px, transparent 1.5px);
            background-size: 20px 20px;
        }
    </style>
</head>
<body class="min-h-screen min-h-[100dvh] bg-[#1b804e] relative">

    <div class="absolute top-12 left-12 w-48 h-48 dot-pattern pointer-events-none opacity-70 hidden md:block"></div>
    <div class="absolute -bottom-10 -right-10 w-64 h-64 dot-pattern pointer-events-none opacity-50 hidden md:block"></div>

    <div class="w-full max-w-md my-auto relative z-10">
        <div class="flex justify-center mb-6">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold tracking-wider text-white uppercase bg-white/10 backdrop-blur-md border border-white/20 shadow-sm">
                SET NEW CREDENTIALS
            </span>
        </div>

        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Reset Password</h1>
            <p class="text-white/80 text-sm mt-2 font-medium">Create a new secure password for your account</p>
        </div>

        <div style=" justify-content:center" ; class="bg-white rounded-3xl p-8 shadow-2xl shadow-emerald-950/20">
            <form action="{{ route('reset_pass') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="token" value="{{ $token ?? request()->route('token') }}">
                <input type="hidden" name="email" value="{{ request('email') ?? old('email') }}">

                <div>
                    <label class="block text-xs font-bold tracking-wide uppercase text-gray-700 mb-1.5" for="password">New Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" required class="w-full px-4 py-3 rounded-2xl bg-gray-50 border border-gray-200 text-gray-900 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#1b804e]">
                    @error('password') <span class="text-xs text-red-600 mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold tracking-wide uppercase text-gray-700 mb-1.5" for="password_confirmation">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" required class="w-full px-4 py-3 rounded-2xl bg-gray-50 border border-gray-200 text-gray-900 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#1b804e]">
                </div>

                <button type="submit" class="w-full mt-2 py-4 px-6 rounded-full bg-[#1b804e] hover:bg-[#15673e] text-white font-bold text-sm tracking-wide shadow-lg shadow-[#1b804e]/25 transition duration-200 flex items-center justify-center gap-2">
                    Update Password
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </form>
        </div>
    </div>
</body>
</html>