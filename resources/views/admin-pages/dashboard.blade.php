<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Smart Waste Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        html, body { max-width: 100%; overflow-x: hidden; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        *::-webkit-scrollbar { width: 8px !important; height: 8px !important; }
        *::-webkit-scrollbar-track { background: rgba(0, 0, 0, 0.04) !important; border-radius: 9999px !important; }
        *::-webkit-scrollbar-thumb { background-color: rgba(27, 128, 78, 0.4) !important; border-radius: 9999px !important; }
        *::-webkit-scrollbar-thumb:hover { background-color: rgba(27, 128, 78, 0.8) !important; }
        * { scrollbar-width: thin !important; scrollbar-color: rgba(27, 128, 78, 0.4) rgba(0, 0, 0, 0.04) !important; }

        #mobile-menu { max-height: 0; opacity: 0; overflow: hidden; transition: max-height .25s ease, opacity .2s ease; }
        #mobile-menu.open { max-height: 400px; opacity: 1; }
    </style>
</head>
<body class="bg-[#f4f7f5] min-h-screen text-gray-800 antialiased pb-10 sm:pb-12">

    <!-- Floating Top Navigation Bar -->
    <header class="pt-4 sm:pt-6 px-3 sm:px-8 max-w-7xl mx-auto">
        <nav class="bg-white rounded-3xl sm:rounded-full px-4 sm:px-6 py-2.5 sm:py-3 shadow-lg shadow-gray-200/50 border border-gray-100">
            <div class="flex items-center justify-between gap-2">
                <!-- Brand Logo -->
                <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[#1b804e] flex items-center justify-center text-white shrink-0">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <span class="font-extrabold text-base sm:text-xl tracking-tight text-gray-900 truncate">EcoLoop Campus</span>
                </div>

                <!-- Nav Links (desktop) -->
                <ul class="hidden md:flex items-center gap-8 text-sm font-semibold text-gray-600">
                    <li><a href="{{ route('dashboard') }}" class="text-[#1b804e] transition">Overview</a></li>
                    <li><a href="{{route('containers.index')}}" class="hover:text-[#1b804e] transition">Containers</a></li>
                    <li><a href="{{ route('catalog.index') }}" class="hover:text-[#1b804e] transition">Materials</a></li>
                    <li><a href="{{ route('students_index') }}" class="hover:text-[#1b804e] transition">Students</a></li>
                    <li><a href="{{ route('employee_index') }}" class="hover:text-[#1b804e] transition">Employees</a></li>
                </ul>

                <!-- Profile & Sign Out -->
                <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                    <div class="text-right hidden lg:block">
                        <span class="text-xs font-bold text-gray-900 block leading-none">{{ auth()->user()?->name ?? 'Administrator' }}</span>
                        <span class="text-[10px] text-gray-400 font-semibold font-mono uppercase">Admin Session</span>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-[#1b804e] hover:bg-[#15673e] text-white px-3.5 sm:px-5 py-2 sm:py-2.5 rounded-full text-[11px] sm:text-xs font-bold transition shadow-md shadow-[#1b804e]/20">
                            Sign Out
                        </button>
                    </form>

                    <!-- Hamburger (mobile) -->
                    <button
                        type="button"
                        id="menu-toggle"
                        onclick="document.getElementById('mobile-menu').classList.toggle('open'); this.setAttribute('aria-expanded', this.getAttribute('aria-expanded') === 'true' ? 'false' : 'true');"
                        class="md:hidden w-9 h-9 shrink-0 flex items-center justify-center rounded-full border border-gray-200 text-gray-600"
                        aria-expanded="false"
                        aria-controls="mobile-menu"
                        aria-label="Toggle navigation menu"
                    >
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Nav Links (mobile dropdown) -->
            <div id="mobile-menu" class="md:hidden">
                <ul class="flex flex-col pt-3 mt-3 border-t border-gray-100 text-sm font-semibold text-gray-600">
                    <li><a href="{{ route('dashboard') }}" class="block py-2.5 text-[#1b804e]">Overview</a></li>
                    <li><a href="{{route('containers.index')}}" class="block py-2.5">Containers</a></li>
                    <li><a href="{{ route('catalog.index') }}" class="block py-2.5">Materials</a></li>
                    <li><a href="{{ route('students_index') }}" class="block py-2.5">Students</a></li>
                    <li><a href="{{ route('employee_index') }}" class="block py-2.5">Employees</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main Content Container -->
    <main class="max-w-7xl mx-auto px-3 sm:px-8 mt-6 sm:mt-8 space-y-6 sm:space-y-8">

        <!-- Top Section Badge & Heading -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] sm:text-xs font-bold tracking-wider text-[#1b804e] bg-emerald-100/60 uppercase mb-2">
                    <span class="w-2 h-2 rounded-full bg-[#1b804e]"></span>
                    Campus Telemetry Overview
                </div>
                <h1 class="text-xl sm:text-3xl font-extrabold text-gray-900">IoT System Dashboard</h1>
            </div>
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center gap-1.5 px-3.5 sm:px-4 py-1.5 sm:py-2 rounded-full bg-white border border-gray-200 text-[11px] sm:text-xs font-bold text-gray-700 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-[#1b804e]"></span>
                    System Live
                </span>
            </div>
        </div>

        <!-- Metric KPI Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">

            <!-- Card 1: Total Recycled Weight -->
            <div class="bg-[#1b804e] text-white rounded-3xl p-5 sm:p-7 shadow-lg relative overflow-hidden flex flex-col justify-between min-h-[180px] sm:min-h-[200px]">
                <div class="flex justify-between items-start">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-white/15 text-white backdrop-blur-sm">
                        Total Collected
                    </span>
                    <span class="text-emerald-200 font-semibold text-xs">All Units</span>
                </div>

                <div class="my-auto py-2">
                    @if($totalRecycledWeight != 0)
                        <h3 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-center">
                            {{ (($totalRecycledWeight)/1000) }}  <span class="text-lg sm:text-xl font-normal text-emerald-100">kg</span>
                        </h3>
                    @else
                        <div class="flex justify-center items-center">
                            <div class="inline-flex items-center justify-center gap-2.5 px-4 sm:px-5 py-2 sm:py-2.5 rounded-2xl bg-white/10 border border-white/20 backdrop-blur-md shadow-sm">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-300 animate-pulse"></span>
                                <span class="text-base sm:text-2xl font-bold tracking-tight text-white drop-shadow-sm">
                                    No Recycled Yet
                                </span>
                            </div>
                        </div>
                    @endif
                </div>

                <div>
                    <p class="text-emerald-100/80 text-xs text-center font-medium">Recycled across all active university collection points</p>
                </div>
            </div>

            <!-- Card 2: Total Points Awarded -->
            <div class="bg-white rounded-3xl p-5 sm:p-7 border border-gray-100 shadow-sm flex flex-col justify-between min-h-[180px] sm:min-h-[200px]">
                <div class="flex justify-between items-start">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-gray-100 text-gray-700">
                        Total Points Awarded
                    </span>
                    <span class="text-emerald-600 font-bold text-xs">In Circulation</span>
                </div>
                <div>
                    <h3 class="text-3xl sm:text-5xl font-extrabold text-gray-900 tracking-tight mt-4">
                        {{ number_format($totalPointsAwarded ) }}
                    </h3>
                    <p class="text-gray-500 text-xs mt-2 font-medium">Distributed to {{ number_format($totalStudents ?? 0) }} registered student accounts</p>
                </div>
            </div>

            <!-- Card 3: Active Containers & Threshold Alert -->
            <div class="bg-white rounded-3xl p-5 sm:p-7 border border-gray-100 shadow-sm flex flex-col justify-between min-h-[180px] sm:min-h-[200px]">
                <div class="flex justify-between items-start">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-emerald-50 text-[#1b804e]">
                        Smart Bins
                    </span>
                    <span class="text-gray-400 text-xs font-semibold">{{ $totalContainers ?? 0 }} Deployed</span>
                </div>
                <div>
                    <h3 class="text-3xl sm:text-5xl font-extrabold text-gray-900 tracking-tight mt-4">
                        {{ $criticalContainers?->count() ?? 0 }} <span class="text-lg sm:text-xl font-normal text-gray-400">critical</span>
                    </h3>
                    <p class="text-gray-500 text-xs mt-2 font-medium">
                        Units exceeding
                    </p>
                </div>
            </div>

        </div>

        <!-- Section: Containers Status Cards -->
        <div class="space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div>
                    <h2 class="text-base sm:text-lg font-bold text-gray-900">Container Telemetry Monitor</h2>
                    <p class="text-xs text-gray-500 font-medium">Real-time capacity tracking across campus units</p>
                </div>
                <a href="{{ route('containers.index') }}" class="inline-flex items-center gap-1.5 text-xs font-extrabold text-[#1b804e] hover:text-[#15673e] transition hover:underline">
                    <span>View All Containers</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-5">
                @forelse(($criticalContainers ?? collect())->take(3) as $container)
                @php
                    $fill = (int) ($container->fill_level ?? 0);
                    if ($fill >= 90) {
                        $statusLabel = 'Critical';
                        $badgeClasses = 'bg-rose-50 text-rose-700 border-rose-100';
                        $barColor = 'bg-rose-500';
                        $textColor = 'text-rose-600';
                        $cardBorder = 'border-rose-200';
                    } elseif ($fill >= 70) {
                        $statusLabel = 'Near Full';
                        $badgeClasses = 'bg-amber-50 text-amber-700 border-amber-100';
                        $barColor = 'bg-amber-500';
                        $textColor = 'text-amber-600';
                        $cardBorder = 'border-amber-200';
                    } else {
                        $statusLabel = 'Operational';
                        $badgeClasses = 'bg-emerald-50 text-[#1b804e] border-emerald-100';
                        $barColor = 'bg-[#1b804e]';
                        $textColor = 'text-[#1b804e]';
                        $cardBorder = 'border-gray-100';
                    }
                @endphp

                <div class="bg-white rounded-3xl p-5 border {{ $cardBorder }} shadow-sm hover:shadow-md transition flex flex-col justify-between min-h-[175px]">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-extrabold text-gray-400 font-mono tracking-wider">
                            {{ $container->serial_number ?? ('CONT-' . str_pad($container->id, 2, '0', STR_PAD_LEFT)) }}
                        </span>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold border {{ $badgeClasses }}">
                            {{ $statusLabel }}
                        </span>
                    </div>

                    <div class="space-y-3">
                        <div>
                            <h4 class="font-extrabold text-gray-900 text-sm truncate" title="{{ $container->location_name ?? 'Campus Unit' }}">
                                {{ $container->location_name ?? 'Campus Unit' }}
                            </h4>
                            <span class="text-[11px] text-gray-400 font-medium block mt-0.5">Automated Telemetry Sensor</span>
                        </div>

                        <div class="space-y-1.5">
                            <div class="flex justify-between items-center text-xs font-bold">
                                <span class="text-gray-500 font-semibold text-[11px]">Fill Level</span>
                                <span class="{{ $textColor }} font-extrabold">{{ $fill }}%</span>
                            </div>
                            <div class="w-full bg-gray-100 h-2.5 rounded-full overflow-hidden">
                                <div class="{{ $barColor }} h-2.5 rounded-full transition-all duration-700" style="width: {{ min($fill, 100) }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full bg-white rounded-3xl p-8 border border-gray-100 text-center text-gray-400 text-xs">
                    No active containers reporting telemetry data.
                </div>
                @endforelse
            </div>
        </div>

        <!-- Section: Recent Activity Table -->
        <div class="bg-white rounded-3xl p-4 sm:p-8 border border-gray-100 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-5 sm:mb-6">
                <div>
                    <h3 class="text-sm sm:text-base font-extrabold text-gray-900">Recent Deposit Logs</h3>
                    <p class="text-xs text-gray-500 font-medium">Real-time incoming telemetry from campus bins</p>
                </div>
                <span class="self-start sm:self-auto px-3 py-1 rounded-full text-[11px] font-bold bg-gray-100 text-gray-600">Audit Active</span>
            </div>

            <!-- Horizontal scroll is intentional here: it keeps the table readable on phones
                 instead of squeezing six columns into a narrow screen. -->
            <div class="overflow-x-auto -mx-4 px-4 sm:mx-0 sm:px-0">
                <table class="w-full text-left text-xs min-w-[650px]">
                    <thead>
                        <tr class="border-b border-gray-100 text-gray-400 uppercase tracking-wider font-bold">
                            <th class="pb-3 px-3">Student / Causer</th>
                            <th class="pb-3 px-3">Target Container</th>
                            <th class="pb-3 px-3">Material</th>
                            <th class="pb-3 px-3">Weight</th>
                            <th class="pb-3 px-3">Points</th>
                            <th class="pb-3 px-3 text-right">Timestamp</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-gray-700 font-medium">
                        @forelse($recentActivities ?? [] as $activity)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-3.5 px-3 font-semibold text-gray-900">
                                {{ $activity->user?->name ?? $activity->university_id ?? 'Student' }}
                            </td>
                            <td class="py-3.5 px-3 font-mono text-gray-600">
                                {{ $activity->container?->serial_number ?? $activity->container?->location_name ?? ('BIN: ' . $activity->serial_number) }}
                            </td>
                            <td class="py-3.5 px-3">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-gray-100 text-gray-700">
                                    {{ $activity?->material ?? 'Recyclable' }}
                                </span>
                            </td>
                            <td class="py-3.5 px-3 font-bold">
                                {{ $activity->weight ?? 0 }} g
                            </td>
                            <td class="py-3.5 px-3 text-[#1b804e] font-extrabold">
                                +{{ $activity->points ?? 0 }} pts
                            </td>
                            <td class="py-3.5 px-3 text-right text-gray-400 font-mono">
                                {{ $activity->created_at?->diffForHumans() ?? '-' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-xs text-gray-400">
                                No deposit activities logged yet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>