<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - Green University Rewards</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        html, body { max-width: 100%; overflow-x: hidden; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        *::-webkit-scrollbar { width: 8px !important; height: 8px !important; }
        *::-webkit-scrollbar-track { background: rgba(0, 0, 0, 0.04) !important; border-radius: 9999px !important; }
        *::-webkit-scrollbar-thumb { background-color: rgba(27, 128, 78, 0.4) !important; border-radius: 9999px !important; }
        *::-webkit-scrollbar-thumb:hover { background-color: rgba(27, 128, 78, 0.8) !important; }
        * { scrollbar-width: thin !important; scrollbar-color: rgba(27, 128, 78, 0.4) rgba(0, 0, 0, 0.04) !important; }
    </style>
</head>
<body class="bg-[#f4f7f5] min-h-screen text-gray-800 antialiased pb-10 sm:pb-12">

    <!-- Floating Navbar -->
    <header class="pt-4 sm:pt-6 px-3 sm:px-8 max-w-7xl mx-auto">
        <nav class="bg-white rounded-3xl sm:rounded-full px-4 sm:px-6 py-2.5 sm:py-3 shadow-lg shadow-gray-200/50 flex items-center justify-between gap-2 border border-gray-100">
            <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[#1b804e] flex items-center justify-center text-white font-bold shrink-0">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <span class="font-extrabold text-sm sm:text-lg tracking-tight text-gray-900 block leading-tight truncate">EcoLoop Campus</span>
                    <span class="text-[9px] sm:text-[10px] font-bold text-gray-400 uppercase tracking-widest">Student Portal</span>
                </div>
            </div>

            <!-- Student Profile Badge -->
            <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                <div class="text-right hidden lg:block">
                    <span class="text-xs font-bold text-gray-900 block leading-none">{{ auth()->user()?->name ?? 'Student' }}</span>
                    <span class="text-[10px] text-gray-400 font-semibold font-mono">ID: {{ auth()->user()?->university_id ?? auth()->user()?->id ?? '---' }}</span>
                </div>
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-emerald-100 text-[#1b804e] flex items-center justify-center font-extrabold text-xs shrink-0">
                    {{ strtoupper(substr(auth()->user()?->name ?? 'S', 0, 1)) }}
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-[#1b804e] hover:bg-[#15673e] text-white px-3.5 sm:px-5 py-2 sm:py-2.5 rounded-full text-[11px] sm:text-xs font-bold transition shadow-md shadow-[#1b804e]/20">
                        Sign Out
                    </button>
                </form>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-3 sm:px-8 mt-6 sm:mt-8 space-y-6 sm:space-y-8">

        <!-- Top Greeting Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-4">
            <div class="min-w-0">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] sm:text-xs font-bold tracking-wider text-[#1b804e] bg-emerald-100/60 uppercase mb-2">
                    <span class="w-2 h-2 rounded-full bg-[#1b804e]"></span>
                    Student Dashboard
                </div>
                <h1 class="text-xl sm:text-3xl font-extrabold text-gray-900 truncate">Welcome, {{ auth()->user()?->name ?? 'Student' }}</h1>
            </div>

            <!-- Live Rank Badge -->
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3.5 sm:px-4 py-1.5 sm:py-2 rounded-full bg-white border border-gray-200 text-[11px] sm:text-xs font-bold text-gray-700 shadow-sm whitespace-nowrap">
                    <span class="w-2 h-2 rounded-full bg-[#1b804e]"></span>
                    Campus Rank: <span class="text-[#1b804e] font-extrabold">#{{ $myRank ?? 1 }}</span>
                </span>
            </div>
        </div>

        <!-- Metric Cards Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">

            <!-- Card 1: My Points -->
            <div class="bg-[#1b804e] text-white rounded-3xl p-5 sm:p-7 shadow-lg flex flex-col justify-between min-h-[170px] sm:min-h-[190px]">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-white/15 text-white backdrop-blur-sm w-fit">
                    My Balance
                </span>
                <div>
                    <h3 class="text-3xl sm:text-5xl font-extrabold tracking-tight mt-4">
                        {{ number_format(auth()->user()?->points) ?? 0 }} <span class="text-lg sm:text-xl font-normal text-emerald-100">pts</span>
                    </h3>
                    <p class="text-emerald-100/80 text-xs mt-2 font-medium">Accumulated rewards across campus bins</p>
                </div>
            </div>

            <!-- Card 2: My Standing Card -->
            <div class="bg-white rounded-3xl p-5 sm:p-7 border border-gray-100 shadow-sm flex flex-col justify-between min-h-[170px] sm:min-h-[190px]">
                <div class="flex justify-between items-start">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-emerald-50 text-[#1b804e]">
                        Position
                    </span>
                    <span class="text-xs font-bold text-gray-400">All Students</span>
                </div>
                <div>
                    <div class="flex items-baseline gap-2 mt-3">
                        <span class="text-3xl sm:text-4xl font-extrabold text-gray-900">#{{ $myRank ?? 1 }}</span>
                        <span class="text-xs font-semibold text-gray-400">Current Standing</span>
                    </div>
                    <p class="text-gray-500 text-xs mt-2 font-medium">Earn more points with every verified deposit</p>
                </div>
            </div>

            <!-- Card 3: Total Recycled Weight -->
            <div class="bg-white rounded-3xl p-5 sm:p-7 border border-gray-100 shadow-sm flex flex-col justify-between min-h-[170px] sm:min-h-[190px]">
                <div class="flex justify-between items-start">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-emerald-50 text-[#1b804e]">
                        Environmental Impact
                    </span>
                    <div class="w-7 h-7 rounded-full bg-emerald-50 text-[#1b804e] flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <div class="flex items-baseline gap-1.5 mt-3">
                        <span class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">
                            {{ number_format($totalWeightg ?? 0, 1) }}
                        </span>
                        <span class="text-sm font-bold text-gray-400">g</span>
                    </div>
                    <p class="text-gray-500 text-xs mt-2 font-medium">Total materials diverted from waste streams</p>
                </div>
            </div>

        </div>

        <!-- Middle Section: Top 10 Leaderboard & Material Rates -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">

            <!-- Top 10 Leaderboard List (Takes 2 cols for clean layout) -->
            <div class="bg-white rounded-3xl p-4 sm:p-8 border border-gray-100 shadow-sm lg:col-span-2 space-y-4">
                <div class="flex items-center justify-between gap-2 pb-3 border-b border-gray-100">
                    <div class="min-w-0">
                        <h3 class="text-sm sm:text-base font-extrabold text-gray-900">Campus Top 10 Recyclers</h3>
                        <p class="text-xs text-gray-500 font-medium">Leading environmental champions this term</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-[#1b804e] shrink-0">Top Tier</span>
                </div>

                <div class="divide-y divide-gray-50">
                    @forelse($topTen ?? [] as $index => $leader)
                    <div class="flex items-center justify-between gap-2 py-2.5 px-2 sm:px-3 rounded-2xl transition {{ auth()->id() === $leader->id ? 'bg-emerald-50/80 border border-emerald-100' : 'hover:bg-gray-50/60' }}">
                        <div class="flex items-center gap-2.5 sm:gap-3 min-w-0">
                            <span class="w-5 sm:w-6 text-center text-xs font-black shrink-0 {{ $index < 3 ? 'text-[#1b804e]' : 'text-gray-400' }}">
                                #{{ $index + 1 }}
                            </span>
                            <div class="w-8 h-8 rounded-full {{ $index === 0 ? 'bg-[#1b804e] text-white' : 'bg-gray-100 text-gray-700' }} flex items-center justify-center font-bold text-xs shrink-0">
                                {{ strtoupper(substr($leader->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <span class="text-xs font-bold text-gray-900 block leading-tight truncate">
                                    {{ $leader->name }}
                                    @if(auth()->id() === $leader->id)
                                        <span class="ml-1 text-[10px] text-[#1b804e] font-extrabold">(You)</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <span class="text-xs font-extrabold text-[#1b804e] shrink-0 whitespace-nowrap">
                            {{ number_format($leader->points) ?? 0 }} <span class="text-[10px] font-normal text-gray-400">pts</span>
                        </span>
                    </div>
                    @empty
                    <p class="text-xs text-gray-400 py-6 text-center">No ranked students yet.</p>
                    @endforelse
                </div>
            </div>

            <!-- Material Catalog (1 col) -->
            <div class="bg-white rounded-3xl p-4 sm:p-8 border border-gray-100 shadow-sm space-y-5">
                <div>
                    <h3 class="text-sm sm:text-base font-extrabold text-gray-900">Exchange Rates</h3>
                    <p class="text-xs text-gray-500 font-medium">Configured point values per 1g</p>
                </div>

                <div class="space-y-3">
                    @forelse($materials ?? [] as $material)
                    <div class="flex items-center justify-between gap-2 p-3.5 rounded-2xl bg-gray-50 border border-gray-100">
                        <div class="min-w-0">
                            <h4 class="text-xs font-bold text-gray-900 truncate">{{ $material->type }}</h4>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-xs font-extrabold bg-emerald-50 text-[#1b804e] shrink-0 whitespace-nowrap">
                            +{{ $material->points }} pts
                        </span>
                    </div>
                    @empty
                    <p class="text-xs text-gray-400 py-3 text-center">No materials configured yet.</p>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- My Deposits Table Section -->
        <div class="bg-white rounded-3xl p-4 sm:p-8 border border-gray-100 shadow-sm space-y-5 sm:space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm sm:text-base font-extrabold text-gray-900">My Recent Activity</h3>
                    <p class="text-xs text-gray-500 font-medium">Your verified deposits</p>
                </div>
            </div>

            <!-- Horizontal scroll is intentional on phones: five columns of activity data
                 don't fit a narrow screen, so scrolling inside the card beats squeezing them. -->
            <div class="overflow-x-auto pb-3 -mx-4 px-4 sm:mx-0 sm:px-0">
                <table class="w-full text-left text-xs min-w-[500px]">
                    <thead>
                        <tr class="border-b border-gray-100 text-gray-400 uppercase tracking-wider font-extrabold">
                            <th class="pb-3 px-3">Location</th>
                            <th class="pb-3 px-3">Material</th>
                            <th class="pb-3 px-3">Weight</th>
                            <th class="pb-3 px-3">Points Earned</th>
                            <th class="pb-3 px-3 text-right">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-gray-700 font-medium">
                        @forelse($deposits ?? [] as $deposit)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-3.5 px-3 font-semibold text-gray-900">
                                {{ $deposit->container->location_name ?? $deposit->container_id ?? 'Campus Bin' }}
                            </td>
                            <td class="py-3.5 px-3">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-gray-100 text-gray-800 whitespace-nowrap">
                                    {{ $deposit?->material?? 'Recyclable' }}
                                </span>
                            </td>
                            <td class="py-3.5 px-3">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-gray-100 text-gray-800 whitespace-nowrap">
                                    {{ $deposit?->weight?? 'Unknown' }}
                                </span>
                            </td>
                            <td class="py-3.5 px-3 text-[#1b804e] font-extrabold whitespace-nowrap">
                                +{{ $deposit->points ?? 0 }} pts
                            </td>
                            <td class="py-3.5 px-3 text-right text-gray-400 font-mono whitespace-nowrap">
                                {{ $deposit->created_at?->format('Y-m-d H:i') ?? '-' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-xs text-gray-400">
                                No recycling activities recorded yet.
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