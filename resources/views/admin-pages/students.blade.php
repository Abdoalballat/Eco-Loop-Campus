<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Leaderboard & Directory - GreenAdmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        html, body { max-width: 100%; overflow-x: hidden; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        *::-webkit-scrollbar {
            width: 8px !important;
            height: 8px !important;
        }

        *::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.04) !important;
            border-radius: 9999px !important;
        }

        *::-webkit-scrollbar-thumb {
            background-color: rgba(27, 128, 78, 0.4) !important;
            border-radius: 9999px !important;
        }

        *::-webkit-scrollbar-thumb:hover {
            background-color: rgba(27, 128, 78, 0.8) !important;
        }

        * {
            scrollbar-width: thin !important;
            scrollbar-color: rgba(27, 128, 78, 0.4) rgba(0, 0, 0, 0.04) !important;
        }

        #mobile-menu { max-height: 0; opacity: 0; overflow: hidden; transition: max-height .25s ease, opacity .2s ease; }
        #mobile-menu.open { max-height: 400px; opacity: 1; }
    </style>
</head>
<body class="bg-[#f4f7f5] min-h-screen text-gray-800 antialiased pb-10 sm:pb-12">

    <!-- Floating Top Navigation Bar -->
    <header class="pt-4 sm:pt-6 px-3 sm:px-8 max-w-7xl mx-auto">
        <nav class="bg-white rounded-3xl sm:rounded-full px-4 sm:px-6 py-2.5 sm:py-3 shadow-lg shadow-gray-200/50 border border-gray-100">
            <div class="flex items-center justify-between gap-2">
                <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                    <a href="{{ route('dashboard') }}" class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[#1b804e] flex items-center justify-center text-white shrink-0">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </a>
                    <span class="font-extrabold text-base sm:text-xl tracking-tight text-gray-900 truncate">EcoLoop Campus</span>
                </div>

                <!-- Nav Links (desktop) -->
                <ul class="hidden md:flex items-center gap-8 text-sm font-semibold text-gray-600">
                    <li><a href="{{ route('dashboard') }}" class="hover:text-[#1b804e] transition">Overview</a></li>
                    <li><a href="{{route('containers.index')}}" class="hover:text-[#1b804e] transition">Containers</a></li>
                    <li><a href="{{ route('catalog.index') }}" class="hover:text-[#1b804e] transition">Materials</a></li>
                    <li><a href="{{ route('students_index') }}" class="text-[#1b804e] transition">Students</a></li>
                    <li><a href="{{ route('employee_index') }}" class="hover:text-[#1b804e] transition">Employees</a></li>
                </ul>

                <!-- Profile & Sign Out -->
                <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                    <div class="text-right hidden lg:block">
                        <span class="text-xs font-bold text-gray-900 block leading-none">{{ auth()->user()?->name ?? 'Admin' }}</span>
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
                    <li><a href="{{route('containers.index')}}" class="block py-2.5">Containers</a></li>
                    <li><a href="{{ route('catalog.index') }}" class="block py-2.5">Materials</a></li>
                    <li><a href="{{ route('students_index') }}" class="block py-2.5 text-[#1b804e]">Students</a></li>
                    <li><a href="{{ route('employee_index') }}" class="block py-2.5">Employees</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-3 sm:px-8 mt-6 sm:mt-8 space-y-6 sm:space-y-8">

        <!-- Top Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] sm:text-xs font-bold tracking-wider text-[#1b804e] bg-emerald-100/60 uppercase mb-2">
                    <span class="w-2 h-2 rounded-full bg-[#1b804e]"></span>
                    Campus Student Leaderboard
                </div>
                <h1 class="text-xl sm:text-3xl font-extrabold text-gray-900">Student Rankings & Participation</h1>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="w-full sm:w-auto justify-center bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2.5 rounded-full text-xs font-bold transition shadow-sm inline-flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Dashboard
                </a>
            </div>
        </div>

        <!-- Summary Metric Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">

            <!-- Card 1: Total Registered Students -->
            <div class="bg-white rounded-3xl p-5 sm:p-6 border border-gray-100 shadow-sm flex items-center justify-between gap-3 min-h-[150px] sm:min-h-[160px]">
                <div class="min-w-0">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-emerald-50 text-[#1b804e] mb-2">
                        Total Students
                    </span>
                    <h3 class="text-2xl sm:text-4xl font-extrabold text-gray-900">
                        {{ number_format(isset($students) && method_exists($students, 'total') ? $students->total() : ($totalStudents ?? count($students ?? []))) }}
                    </h3>
                    <p class="text-xs text-gray-500 font-medium mt-1">Active recycling contributors</p>
                </div>
                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-emerald-50 text-[#1b804e] flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
            </div>

            <!-- Card 2: Campus Points Pool -->
            <div class="bg-white rounded-3xl p-5 sm:p-6 border border-gray-100 shadow-sm flex items-center justify-between gap-3 min-h-[150px] sm:min-h-[160px]">
                <div class="min-w-0">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-gray-100 text-gray-700 mb-2">
                        Total Points Earned
                    </span>
                    <h3 class="text-2xl sm:text-4xl font-extrabold text-gray-900">
                        {{ number_format($totalPointsAwarded ?? (collect($students ?? [])->sum('points'))) }}
                    </h3>
                    <p class="text-xs text-gray-500 font-medium mt-1">Distributed across active accounts</p>
                </div>
                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-gray-100 text-gray-700 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
            </div>

            <!-- Card 3: Top Rank Spotlight -->
            <div class="bg-[#1b804e] text-white rounded-3xl p-5 sm:p-6 shadow-lg sm:col-span-2 lg:col-span-1 flex flex-col justify-between min-h-[150px] sm:min-h-[160px]">
                <div class="flex justify-between items-start gap-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-white/15 text-white backdrop-blur-sm">
                        Rank #1 Spotlight
                    </span>
                    <span class="text-emerald-200 font-semibold text-xs shrink-0">Campus Leader</span>
                </div>
                <div class="mt-2 min-w-0">
                    <h4 class="text-lg sm:text-xl font-extrabold truncate">{{ $topStudent?->name ?? 'No Student Yet' }}</h4>
                    <p class="text-xs text-emerald-100/90 font-mono mt-0.5 truncate">
                        {{ number_format($topStudent?->points ?? 0) }} pts &bull; ID: {{ $topStudent?->university_id ?? $topStudent?->id ?? '---' }}
                    </p>
                </div>
            </div>

        </div>

        <!-- Student Leaderboard Table Card -->
        <div class="bg-white rounded-3xl p-4 sm:p-8 border border-gray-100 shadow-sm space-y-5 sm:space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-sm sm:text-base font-extrabold text-gray-900">Campus Leaderboard & Activity Directory</h3>
                    <p class="text-xs text-gray-500 font-medium">Rankings determined dynamically by accumulated recycling points</p>
                </div>
                <!-- Search Filter Form -->
                <form action="{{ url()->current() }}" method="GET" class="flex items-center gap-2 w-full sm:w-auto">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, ID, or email..." class="flex-1 min-w-0 sm:flex-none px-4 py-2 rounded-full bg-gray-50 border border-gray-200 text-base sm:text-xs text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#1b804e] sm:w-64">
                    <button type="submit" class="shrink-0 px-3.5 py-2 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold transition">
                        Filter
                    </button>
                </form>
            </div>

            <!-- Table Container: horizontal scroll on phones is intentional (5 columns of
                 directory data don't fit a narrow screen), vertical scroll kicks in after ~10 rows -->
            <div class="overflow-x-auto overflow-y-auto max-h-[580px] rounded-2xl border border-gray-50 -mx-4 px-4 sm:mx-0 sm:px-0">
                <table class="w-full text-left text-xs min-w-[700px]">
                    <thead class="sticky top-0 bg-white z-10 shadow-sm shadow-gray-100/80">
                        <tr class="border-b border-gray-100 text-gray-400 uppercase tracking-wider font-extrabold">
                            <th class="py-3 px-3 w-20 text-center">Rank</th>
                            <th class="py-3 px-3">Student Info</th>
                            <th class="py-3 px-3">University ID</th>
                            <th class="py-3 px-3">Accumulated Points</th>
                            <th class="py-3 px-3 text-right">Joined</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-gray-700 font-medium">
                        @forelse($students ?? [] as $index => $student)
                        @php
                            $rank = method_exists($students, 'firstItem') 
                                ? ($students->firstItem() + $index) 
                                : ($index + 1);

                            if ($rank === 1) {
                                $rankBadge = 'bg-amber-100 text-amber-900 border-amber-300 font-extrabold';
                            } elseif ($rank === 2) {
                                $rankBadge = 'bg-slate-100 text-slate-700 border-slate-300 font-bold';
                            } elseif ($rank === 3) {
                                $rankBadge = 'bg-orange-100 text-orange-900 border-orange-300 font-bold';
                            } else {
                                $rankBadge = 'bg-gray-50 text-gray-500 border-gray-200 font-semibold';
                            }
                        @endphp
                        <tr class="hover:bg-gray-50/60 transition">
                            <!-- Rank Column with Crisp SVG Badges -->
                            <td class="py-4 px-3 text-center">
                                <span class="inline-flex items-center justify-center gap-1 min-w-[40px] px-2 py-1 rounded-full text-xs border {{ $rankBadge }}">
                                    @if($rank === 1)
                                        <svg class="w-3.5 h-3.5 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        <span>#1</span>
                                    @elseif($rank === 2)
                                        <svg class="w-3.5 h-3.5 text-slate-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>#2</span>
                                    @elseif($rank === 3)
                                        <svg class="w-3.5 h-3.5 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>#3</span>
                                    @else
                                        <span>#{{ $rank }}</span>
                                    @endif
                                </span>
                            </td>

                            <!-- Student Info -->
                            <td class="py-4 px-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-emerald-50 text-[#1b804e] flex items-center justify-center font-bold text-xs uppercase shrink-0">
                                        {{ substr($student->name ?? 'S', 0, 1) }}
                                    </div>
                                    <div class="min-w-0">
                                        <span class="font-bold text-gray-900 block leading-tight truncate">{{ $student->name ?? 'Student' }}</span>
                                        <span class="text-[11px] text-gray-400 block truncate">{{ $student->email }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- University ID -->
                            <td class="py-4 px-3 font-mono font-bold text-gray-700 whitespace-nowrap">
                                {{ $student->university_id ?? $student->id }}
                            </td>

                            <!-- Points -->
                            <td class="py-4 px-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-emerald-50 text-[#1b804e] font-mono whitespace-nowrap">
                                    +{{ number_format($student->points ?? 0) }} pts
                                </span>
                            </td>

                            <!-- Registration Date -->
                            <td class="py-4 px-3 text-right font-mono text-gray-400 whitespace-nowrap">
                                {{ $student->created_at?->format('M d, Y') ?? '---' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-xs text-gray-400">
                                No registered students found matching your criteria.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            @if(isset($students) && method_exists($students, 'links'))
            <div class="pt-4 border-t border-gray-100">
                {{ $students->appends(request()->query())->links() }}
            </div>
            @endif

        </div>

    </main>

</body>
</html>