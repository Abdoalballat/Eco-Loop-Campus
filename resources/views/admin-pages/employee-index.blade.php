<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Directory - GreenAdmin</title>
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
                    <span class="font-extrabold text-base sm:text-lg tracking-tight text-gray-900 truncate leading-tight">EcoLoop Campus</span>
                </div>

                <!-- Nav Links (desktop) -->
                <ul class="hidden md:flex items-center gap-8 text-sm font-semibold text-gray-600">
                    <li><a href="{{ route('dashboard') }}" class="hover:text-[#1b804e] transition">Overview</a></li>
                    <li><a href="{{route('containers.index')}}" class="hover:text-[#1b804e] transition">Containers</a></li>
                    <li><a href="{{ route('catalog.index') }}" class="hover:text-[#1b804e] transition">Materials</a></li>
                    <li><a href="{{ route('students_index') }}" class="hover:text-[#1b804e] transition">Students</a></li>
                    <li><a href="{{ route('employee_index') }}" class="text-[#1b804e] transition">Employees</a></li>
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
                    <li><a href="{{ route('students_index') }}" class="block py-2.5">Students</a></li>
                    <li><a href="{{ route('employee_index') }}" class="block py-2.5 text-[#1b804e]">Employees</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-3 sm:px-8 mt-6 sm:mt-8 space-y-6 sm:space-y-8">

        <!-- Flash Messages -->
        @if(session('success'))
        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between text-xs font-bold shadow-sm">
            <div class="flex items-center gap-2 min-w-0">
                <svg class="w-4 h-4 text-[#1b804e] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                <span class="break-words">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        <!-- Top Header & Action -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] sm:text-xs font-bold tracking-wider text-[#1b804e] bg-emerald-100/60 uppercase mb-2">
                    <span class="w-2 h-2 rounded-full bg-[#1b804e]"></span>
                    Operational Personnel
                </div>
                <h1 class="text-xl sm:text-3xl font-extrabold text-gray-900">Staff & Field Operators</h1>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('employee_create') }}" class="w-full sm:w-auto">
                <button class="w-full sm:w-auto justify-center bg-[#1b804e] hover:bg-[#15673e] text-white px-5 py-2.5 rounded-full text-xs font-bold transition shadow-md shadow-[#1b804e]/20 inline-flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    + Add New Staff
                </button>
                </a>
            </div>
        </div>

        <!-- Summary Metric Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
            <!-- Total Employees -->
            <div class="bg-white rounded-3xl p-5 sm:p-6 border border-gray-100 shadow-sm flex items-center justify-between gap-3 min-h-[130px] sm:min-h-[140px]">
                <div class="min-w-0">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-emerald-50 text-[#1b804e] mb-2">
                        Active Crew
                    </span>
                    <h3 class="text-2xl sm:text-4xl font-extrabold text-gray-900">
                        {{ number_format(isset($employees) && method_exists($employees, 'total') ? $employees->total() : count($employees ?? [])) }}
                    </h3>
                    <p class="text-xs text-gray-500 font-medium mt-1">Authorized waste collection supervisors</p>
                </div>
                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-emerald-50 text-[#1b804e] flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>

            <!-- Access Level Notice -->
            <div class="bg-white rounded-3xl p-5 sm:p-6 border border-gray-100 shadow-sm flex items-center justify-between gap-3 min-h-[130px] sm:min-h-[140px]">
                <div class="min-w-0">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-gray-100 text-gray-700 mb-2">
                        Privileges
                    </span>
                    <h3 class="text-lg sm:text-xl font-extrabold text-gray-900">Container Emptiers</h3>
                    <p class="text-xs text-gray-500 font-medium mt-1">Staff accounts can reset full containers to 0%</p>
                </div>
                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-gray-100 text-gray-700 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Staff List Table Card -->
        <div class="bg-white rounded-3xl p-4 sm:p-8 border border-gray-100 shadow-sm space-y-5 sm:space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-sm sm:text-base font-extrabold text-gray-900">Operations Team Directory</h3>
                    <p class="text-xs text-gray-500 font-medium">Manage and review all operational personnel profiles</p>
                </div>

                <!-- Search Filter Form -->
                <form action="{{ url()->current() }}" method="GET" class="flex items-center gap-2 w-full sm:w-auto">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, or zone..." class="flex-1 min-w-0 sm:flex-none px-4 py-2 rounded-full bg-gray-50 border border-gray-200 text-base sm:text-xs text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#1b804e] sm:w-64">
                    <button type="submit" class="shrink-0 px-3.5 py-2 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold transition">
                        Search
                    </button>
                </form>
            </div>

            <!-- Table Container: horizontal scroll on phones is intentional (5 columns of
                 directory data don't fit a narrow screen), vertical scroll kicks in after ~10 rows -->
            <div class="overflow-x-auto overflow-y-auto max-h-[580px] rounded-2xl border border-gray-50 -mx-4 px-4 sm:mx-0 sm:px-0">
                <table class="w-full text-left text-xs min-w-[650px]">
                    <thead class="sticky top-0 bg-white z-10 shadow-sm shadow-gray-100/80">
                        <tr class="border-b border-gray-100 text-gray-400 uppercase tracking-wider font-extrabold">
                            <th class="py-3 px-3">#ID</th>
                            <th class="py-3 px-3">Employee Name</th>
                            <th class="py-3 px-3">Email Address</th>
                            <th class="py-3 px-3">Assigned Zone</th>
                            <th class="py-3 px-3 text-right">Registered</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-gray-700 font-medium">
                        @forelse($employees ?? [] as $employee)
                        <tr class="hover:bg-gray-50/60 transition">
                            <!-- ID -->
                            <td class="py-4 px-3 font-mono font-bold text-gray-400">
                                #{{ $employee->id }}
                            </td>

                            <!-- Employee Name -->
                            <td class="py-4 px-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-emerald-50 text-[#1b804e] flex items-center justify-center font-bold text-xs uppercase shrink-0">
                                        {{ substr($employee->name ?? 'E', 0, 1) }}
                                    </div>
                                    <span class="font-bold text-gray-900 block leading-tight">{{ $employee->name ?? 'Staff Member' }}</span>
                                </div>
                            </td>

                            <!-- Email -->
                            <td class="py-4 px-3 font-mono text-gray-600 whitespace-nowrap">
                                {{ $employee->email }}
                            </td>

                            <!-- Zone / Role Badge -->
                            <td class="py-4 px-3">
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-gray-100 text-gray-700 font-mono whitespace-nowrap">
                                    {{ $employee->zone ?? $employee->role ?? 'Campus Wide' }}
                                </span>
                            </td>

                            <!-- Created Date -->
                            <td class="py-4 px-3 text-right font-mono text-gray-400 whitespace-nowrap">
                                {{ $employee->created_at?->format('M d, Y') ?? '---' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-xs text-gray-400">
                                No staff members found matching your search.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            @if(isset($employees) && method_exists($employees, 'links'))
            <div class="pt-4 border-t border-gray-100">
                {{ $employees->appends(request()->query())->links() }}
            </div>
            @endif

        </div>

    </main>

    <!-- Modal: Add New Staff Member -->
    <div id="addStaffModal" class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-5 sm:p-8 shadow-2xl space-y-5 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between">
                <h3 class="text-base sm:text-lg font-extrabold text-gray-900">Register Staff Member</h3>
                <button onclick="document.getElementById('addStaffModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-700 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form action="#" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="name" placeholder="e.g. Mahmoud Hassan" required class="w-full px-3.5 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-base sm:text-xs focus:ring-2 focus:ring-[#1b804e] outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" placeholder="staff@green.edu" required class="w-full px-3.5 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-base sm:text-xs focus:ring-2 focus:ring-[#1b804e] outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Assigned Zone</label>
                    <input type="text" name="zone" placeholder="e.g. Zone A (Engineering)" class="w-full px-3.5 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-base sm:text-xs focus:ring-2 focus:ring-[#1b804e] outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Account Password</label>
                    <input type="password" name="password" placeholder="••••••••" required class="w-full px-3.5 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-base sm:text-xs focus:ring-2 focus:ring-[#1b804e] outline-none">
                </div>

                <div class="pt-2 flex gap-3">
                    <button type="button" onclick="document.getElementById('addStaffModal').classList.add('hidden')" class="w-1/2 py-2.5 rounded-full border border-gray-200 text-xs font-bold text-gray-600 hover:bg-gray-50">Cancel</button>
                    <button type="submit" class="w-1/2 py-2.5 rounded-full bg-[#1b804e] hover:bg-[#15673e] text-white text-xs font-bold shadow-md shadow-[#1b804e]/20">Save Member</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>