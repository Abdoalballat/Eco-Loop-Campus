<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deploy Container - GreenAdmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f4f7f5] min-h-screen text-gray-800 antialiased pb-12">
<!-- System Notifications & Alerts Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-8 mt-4 space-y-3">

    <!-- 1. Form Validation Errors ($errors) -->
    @if ($errors->any())
    <div class="bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl p-4 shadow-sm flex items-start gap-3">
        <div class="w-8 h-8 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0 mt-0.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div class="flex-1">
            <h4 class="text-xs font-extrabold uppercase tracking-wider text-rose-900 mb-1">Action Required</h4>
            <ul class="list-disc list-inside text-xs font-medium space-y-0.5 text-rose-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <!-- 2. Flash Session Error (e.g. back()->with('error', '...')) -->
    @if (session('error'))
    <div class="bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl p-4 shadow-sm flex items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <p class="text-xs font-semibold text-rose-900">{{ session('error') }}</p>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-rose-400 hover:text-rose-600">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    @endif

    <!-- 3. Flash Session Success (e.g. back()->with('success', '...')) -->
    @if (session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-900 rounded-2xl p-4 shadow-sm flex items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-emerald-100 text-[#1b804e] flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <p class="text-xs font-semibold text-emerald-900">{{ session('success') }}</p>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-600">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    @endif

</div>
    <main class="max-w-2xl mx-auto px-4 sm:px-6 pt-10">
        <a href="{{ route('containers.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-gray-500 hover:text-[#1b804e] transition mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Dashboard
        </a>

        <div class="bg-white rounded-3xl p-6 sm:p-10 border border-gray-100 shadow-sm space-y-6">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-emerald-50 text-[#1b804e] mb-2">
                    HARDWARE DEPLOYMENT
                </span>
                <h1 class="text-2xl font-extrabold text-gray-900">ADD New Container</h1>
                <p class="text-xs text-gray-500 mt-1">Bind a new IoT telemetry microcontroller to an on-campus location</p>
            </div>

            <form action="{{ route('containers.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Serial Number</label>
                        <input type="text" name="serial_number" placeholder="CONT-CS-04" required class="w-full px-4 py-3 rounded-2xl bg-gray-50 border border-gray-200 text-xs focus:ring-2 focus:ring-[#1b804e] outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Status</label>
                        <select name="status" required class="w-full px-4 py-3 rounded-2xl bg-gray-50 border border-gray-200 text-xs focus:ring-2 focus:ring-[#1b804e] outline-none">
                            <option value="active">Active</option>
                            <option value="notactive">Not Active</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Physical Location</label>
                    <input type="text" name="location_name" placeholder="e.g. Faculty of Science - Main Gate" required class="w-full px-4 py-3 rounded-2xl bg-gray-50 border border-gray-200 text-xs focus:ring-2 focus:ring-[#1b804e] outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 mb-1">latitude</label>
                    <input type="text" name="latitude" placeholder="31.441427 (N or S)" required class="w-full px-4 py-3 rounded-2xl bg-gray-50 border border-gray-200 text-xs focus:ring-2 focus:ring-[#1b804e] outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 mb-1">longitude</label>
                    <input type="text" name="longitude" placeholder="31.493702 (E or W)" required class="w-full px-4 py-3 rounded-2xl bg-gray-50 border border-gray-200 text-xs focus:ring-2 focus:ring-[#1b804e] outline-none">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Fill level</label>
                        <input type="number" name="fill_level" value="0" required class="w-full px-4 py-3 rounded-2xl bg-gray-50 border border-gray-200 text-xs focus:ring-2 focus:ring-[#1b804e] outline-none">
                    </div>
                </div>

                <button type="submit" class="w-full mt-3 py-3.5 px-6 rounded-full bg-[#1b804e] hover:bg-[#15673e] text-white font-bold text-xs tracking-wide shadow-md shadow-[#1b804e]/20 transition">
                    Register Container Unit
                </button>
            </form>
        </div>
    </main>
</body>
</html>