<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Containers Telemetry - Admin Portal</title>
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
                    <li><a href="{{ route('dashboard') }}" class="hover:text-[#1b804e] transition">Overview</a></li>
                    <li><a href="{{route('containers.index')}}" class="text-[#1b804e] transition">Containers</a></li>
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
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Nav Links (mobile dropdown) -->
            <div id="mobile-menu" class="md:hidden">
                <ul class="flex flex-col pt-3 mt-3 border-t border-gray-100 text-sm font-semibold text-gray-600">
                    <li><a href="{{ route('dashboard') }}" class="block py-2.5">Overview</a></li>
                    <li><a href="{{route('containers.index')}}" class="block py-2.5 text-[#1b804e]">Containers</a></li>
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
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] sm:text-xs font-bold tracking-wider text-[#1b804e] bg-emerald-100/60 uppercase mb-2">
                    <span class="w-2 h-2 rounded-full bg-[#1b804e]"></span>
                    Hardware Fleet Monitoring
                </div>
                <h1 class="text-xl sm:text-3xl font-extrabold text-gray-900">Smart Bins & Containers</h1>
            </div>
            <div class="flex flex-col xs:flex-row items-stretch sm:items-center gap-2 sm:gap-3">
                <a href="{{ route('dashboard') }}" class="bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2.5 rounded-full text-xs font-bold transition shadow-sm inline-flex items-center justify-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('containers.create') }}">
                    <button class="w-full sm:w-auto bg-[#1b804e] hover:bg-[#15673e] text-white px-5 py-2.5 rounded-full text-xs font-bold transition shadow-md shadow-[#1b804e]/20">
                        + Register New Bin
                    </button>
                </a>
            </div>
        </div>

        <!-- Containers Summary Metrics (3 Cards) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
            <!-- Metric 1: Total Units -->
            <div class="bg-white rounded-3xl p-5 sm:p-6 border border-gray-100 shadow-sm flex items-center justify-between">
                <div class="min-w-0">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Total Fleet</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mt-1">{{ $containers->total() ?? $containers->count() }} <span class="text-sm font-semibold text-gray-400">units</span></h3>
                </div>
                <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-gray-50 text-gray-600 flex items-center justify-center font-bold shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
            </div>

            <!-- Metric 2: Operational Units -->
            <div class="bg-white rounded-3xl p-5 sm:p-6 border border-gray-100 shadow-sm flex items-center justify-between">
                <div class="min-w-0">
                    <span class="text-xs font-bold text-[#1b804e] uppercase tracking-wider block">Optimal Fill (&lt; 70%)</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-[#1b804e] mt-1">{{ $containers->where('fill_level', '<', 70)->count() }} <span class="text-sm font-semibold text-emerald-600">units</span></h3>
                </div>
                <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-emerald-50 text-[#1b804e] flex items-center justify-center font-bold shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Metric 3: High Capacity Alert -->
            <div class="bg-white rounded-3xl p-5 sm:p-6 border border-gray-100 shadow-sm flex items-center justify-between">
                <div class="min-w-0">
                    <span class="text-xs font-bold text-rose-600 uppercase tracking-wider block">Needs Pickup (&ge; 80%)</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-rose-600 mt-1">{{ $containers->where('fill_level', '>=', 80)->count() }} <span class="text-sm font-semibold text-rose-400">critical</span></h3>
                </div>
                <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center font-bold shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Containers Table Card -->
        <div class="bg-white rounded-3xl p-4 sm:p-8 border border-gray-100 shadow-sm space-y-5 sm:space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div>
                    <h3 class="text-sm sm:text-base font-extrabold text-gray-900">Registered Telemetry Units</h3>
                    <p class="text-xs text-gray-500 font-medium">Real-time fill percentage and location data</p>
                </div>
            </div>

            <!-- Horizontal scroll is intentional on phones: six columns of telemetry data
                 don't fit a narrow screen, so scrolling inside the card beats squeezing them. -->
            <div class="overflow-x-auto pb-2 -mx-4 px-4 sm:mx-0 sm:px-0">
                <table class="w-full text-left text-xs min-w-[750px]">
                    <thead>
                        <tr class="border-b border-gray-100 text-gray-400 uppercase tracking-wider font-extrabold">
                            <th class="pb-3 px-3">Serial Number</th>
                            <th class="pb-3 px-3">Campus Location</th>
                            <th class="pb-3 px-3 w-56">Capacity & Fill Level</th>
                            <th class="pb-3 px-3">Status</th>
                            <th class="pb-3 px-3 text-right">Last Sync</th>
                            <th class="pb-3 px-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-gray-700 font-medium">
                        @forelse($containers as $container)
                        @php
                            $fill = (int) ($container->fill_level ?? 0);

                            // تخصيص لون شريط النسبة
                            if ($fill >= 90) {
                                $barColor = 'bg-rose-500';
                                $textColor = 'text-rose-600';
                            } elseif ($fill >= 70) {
                                $barColor = 'bg-amber-500';
                                $textColor = 'text-amber-600';
                            } else {
                                $barColor = 'bg-[#1b804e]';
                                $textColor = 'text-[#1b804e]';
                            }

                            // استخراج الحالة وقيمتها من العمود status
                            $currentStatus = strtolower($container->status ?? 'active');

                            if (in_array($currentStatus, ['critical', 'full', 'inactive', 'maintenance'])) {
                                $statusBadge = 'bg-rose-50 text-rose-700 border-rose-200';
                            } elseif (in_array($currentStatus, ['near full', 'warning', 'pending'])) {
                                $statusBadge = 'bg-amber-50 text-amber-700 border-amber-200';
                            } else {
                                $statusBadge = 'bg-emerald-50 text-[#1b804e] border-emerald-200';
                            }
                        @endphp
                        <tr class="hover:bg-gray-50/60 transition">
                            <!-- Identifier / Serial -->
                            <td class="py-4 px-3 font-mono font-bold text-gray-900 whitespace-nowrap">
                                {{ $container->serial_number ?? ('CONT-' . str_pad($container->id, 2, '0', STR_PAD_LEFT)) }}
                            </td>

                            <!-- Campus Location -->
                            <td class="py-4 px-3">
                                <span class="font-bold text-gray-900 block leading-tight">{{ $container->location_name ?? 'Campus Bin' }}</span>
                                <span class="text-[10px] text-gray-400">ID: #{{ $container->id }}</span>
                            </td>

                            <!-- Capacity & Fill Progress Bar -->
                            <td class="py-4 px-3">
                                <div class="space-y-1">
                                    <div class="flex justify-between items-center text-[11px] font-bold">
                                        <span class="text-gray-400 font-medium">Telemetry Fill</span>
                                        <span class="{{ $textColor }} font-extrabold">{{ $fill }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-100 h-2.5 rounded-full overflow-hidden">
                                        <div class="{{ $barColor }} h-2.5 rounded-full transition-all duration-500" style="width: {{ min($fill, 100) }}%"></div>
                                    </div>
                                </div>
                            </td>

                            <!-- Status Badge (Reads directly from container->status) -->
                            <td class="py-4 px-3">
                                @php
                                    $isActive = in_array(strtolower($container->status ?? ''), ['active', 'operational']);
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold border uppercase tracking-wider whitespace-nowrap {{ $isActive ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-red-50 text-red-700 border-red-200' }}">
                                    {{ $container->status ?? 'Not Active' }}
                                </span>
                            </td>

                            <!-- Last Sync Timestamp -->
                            <td class="py-4 px-3 text-right font-mono text-gray-400 whitespace-nowrap">
                                {{ $container->updated_at?->diffForHumans() ?? 'Just now' }}
                            </td>

                            <!-- Action Buttons: Edit & Delete -->
                            <td class="py-4 px-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Edit Button -->
                                    <a href="{{ route('containers.edit', ['containers'=>$container->id]) }}" class="p-2 rounded-xl bg-gray-50 text-gray-600 hover:bg-[#1b804e] hover:text-white transition shadow-sm" title="Edit Container">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </a>

                                    <!-- Delete Button Form -->
                                    <form action="{{ route('containers.destroy', ['containers'=>$container->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove container {{ $container->serial_number ?? $container->id }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-xl bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white transition shadow-sm" title="Delete Container">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-xs text-gray-400">
                                No containers registered in the system yet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if(method_exists($containers, 'links'))
            <div class="pt-4 border-t border-gray-100">
                {{ $containers->links() }}
            </div>
            @endif

        </div>

    </main>

</body>
</html>