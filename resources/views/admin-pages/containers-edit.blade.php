<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Container - GreenAdmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f4f7f5] min-h-screen text-gray-800 antialiased pb-12">

    <main class="max-w-2xl mx-auto px-4 sm:px-6 pt-10">
        <!-- Back Navigation -->
        <a href="{{ route('containers.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-gray-500 hover:text-[#1b804e] transition mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Return to Telemetry List
        </a>

        <!-- Validation Errors Display -->
        @if ($errors->any())
        <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800">
            <div class="flex items-center gap-2 mb-1">
                <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h4 class="text-xs font-bold uppercase">Please fix the following errors:</h4>
            </div>
            <ul class="list-disc list-inside text-xs space-y-0.5 font-medium">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="bg-white rounded-3xl p-6 sm:p-10 border border-gray-100 shadow-sm space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-gray-100 text-gray-700 mb-2 font-mono">
                        UNIT ID: {{ $container->serial_number ?? ('CONT-' . str_pad($container->id, 2, '0', STR_PAD_LEFT)) }}
                    </span>
                    <h1 class="text-2xl font-extrabold text-gray-900">Container Parameters</h1>
                </div>

                <!-- Fast Reset Button (Clearing load) -->
                @if(Route::has('containers.reset'))
                <form action="{{ route('containers.reset', $container->id) }}" method="POST" onsubmit="return confirm('Empty this container and reset its fill level to 0%?');">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="px-4 py-2 rounded-full border border-amber-300 bg-amber-50 text-amber-800 text-xs font-bold hover:bg-amber-100 transition">
                        Reset / Mark Emptied
                    </button>
                </form>
                @endif
            </div>

            <!-- Update Form -->
            <form action="{{ route('containers.update', ['containers' => $container?->id]) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Assigned Location -->
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Assigned Location</label>
                    <input type="text" name="location_name" value="{{ old('location', $container->location_name) }}" required class="w-full px-4 py-3 rounded-2xl bg-gray-50 border border-gray-200 text-xs focus:ring-2 focus:ring-[#1b804e] outline-none">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Operational State -->
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Operational State</label>
                        <select name="status" class="w-full px-4 py-3 rounded-2xl bg-gray-50 border border-gray-200 text-xs focus:ring-2 focus:ring-[#1b804e] outline-none">
                            <option value="active" {{ old('status', $container->status) == 'active' ? 'selected' : '' }}>Active / Operational</option>
                            <option value="notactive" {{ old('status', $container->status) == 'notactive' ? 'selected' : '' }}>Not Active</option>
                            <!-- <option value="maintenance" {{ old('status', $container->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option> -->
                        </select>
                    </div>

                    <!-- Fill Threshold Alert -->
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Fill Threshold Alert (%)</label>
                        <input type="number" min="0" max="100" name="fill_level" value="{{ old('threshold', $container->fill_level ?? 85) }}" required class="w-full px-4 py-3 rounded-2xl bg-gray-50 border border-gray-200 text-xs focus:ring-2 focus:ring-[#1b804e] outline-none">
                    </div>

                    <!-- Latitude (Corrected Name & Step) -->
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Latitude</label>
                        <input type="number" step="any" name="latitude" value="{{ old('latitude', $container->latitude) }}" placeholder="31.441427" class="w-full px-4 py-3 rounded-2xl bg-gray-50 border border-gray-200 text-xs focus:ring-2 focus:ring-[#1b804e] outline-none">
                    </div>

                    <!-- Longitude (Corrected Name & Step) -->
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Longitude</label>
                        <input type="number" step="any" name="longitude" value="{{ old('longitude', $container->longitude) }}" placeholder="31.493702" class="w-full px-4 py-3 rounded-2xl bg-gray-50 border border-gray-200 text-xs focus:ring-2 focus:ring-[#1b804e] outline-none">
                    </div>
                </div>

                <!-- Form Controls -->
                <div class="pt-4 flex items-center gap-3">
                    <a href="{{ route('containers.index') }}" class="w-1/3 py-3.5 rounded-full border border-gray-200 text-xs font-bold text-gray-600 hover:bg-gray-50 text-center transition">
                        Cancel
                    </a>
                    <button type="submit" class="w-2/3 py-3.5 rounded-full bg-[#1b804e] hover:bg-[#15673e] text-white text-xs font-bold shadow-md shadow-[#1b804e]/20 transition">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>