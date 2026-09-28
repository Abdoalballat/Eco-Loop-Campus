<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materials Catalog - GreenAdmin</title>
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
                <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                    <a href="{{route('dashboard') }}" class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[#1b804e] flex items-center justify-center text-white font-bold shrink-0">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </a>
                    <span class="font-extrabold text-base sm:text-xl tracking-tight text-gray-900 truncate">EcoLoop Campus</span>
                </div>

                <!-- Nav Links (desktop) -->
                <ul class="hidden md:flex items-center gap-8 text-sm font-semibold text-gray-600">
                    <li><a href="{{ route('dashboard') }}" class="hover:text-[#1b804e] transition">Overview</a></li>
                    <li><a href="{{route('containers.index')}}" class="hover:text-[#1b804e] transition">Containers</a></li>
                    <li><a href="{{ route('catalog.index') }}" class="text-[#1b804e] transition">Materials</a></li>
                    <li><a href="{{ route('students_index') }}" class="hover:text-[#1b804e] transition">Students</a></li>
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
                    <li><a href="{{ route('catalog.index') }}" class="block py-2.5 text-[#1b804e]">Materials</a></li>
                    <li><a href="{{ route('students_index') }}" class="block py-2.5">Students</a></li>
                    <li><a href="{{ route('employee_index') }}" class="block py-2.5">Employees</a></li>
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

        @if($errors->any())
        <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-bold space-y-1 shadow-sm">
            @foreach($errors->all() as $error)
                <p class="break-words">&bull; {{ $error }}</p>
            @endforeach
        </div>
        @endif

        <!-- Top Section Heading -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] sm:text-xs font-bold tracking-wider text-[#1b804e] bg-emerald-100/60 uppercase mb-2">
                    <span class="w-2 h-2 rounded-full bg-[#1b804e]"></span>
                    Catalog Management
                </div>
                <h1 class="text-xl sm:text-3xl font-extrabold text-gray-900">Recyclable Categories & Point Rates</h1>
            </div>
        </div>

        <!-- Materials Table Card -->
        <div class="bg-white rounded-3xl p-4 sm:p-8 border border-gray-100 shadow-sm">

            <!-- Card Header: Title with Icon + "Type" Button -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-5 border-b border-gray-100 mb-6">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-[#1b804e] flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <h3 class="text-base sm:text-lg font-extrabold text-gray-900 tracking-tight">Catalog Materials</h3>
                        <p class="text-xs text-gray-500 font-medium">Telemetry exchange values and aggregated collected weight</p>
                    </div>
                </div>

                <!-- Add Button -->
                <button
                    type="button"
                    onclick="openTypeModal('add')"
                    class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-full border border-gray-200 bg-white hover:bg-gray-50 text-gray-800 text-xs font-bold transition shadow-sm self-start sm:self-auto"
                >
                    <svg class="w-4 h-4 text-[#1b804e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Type
                </button>
            </div>

            <!-- Table: horizontal scroll is intentional on phones — six columns of data
                 don't fit a narrow screen, so scrolling inside the card beats squeezing them. -->
            <div class="overflow-x-auto pb-3 -mx-4 px-4 sm:mx-0 sm:px-0">
                <table class="w-full text-left text-xs min-w-[650px]">
                    <thead>
                        <tr class="border-b border-gray-100 text-gray-400 uppercase tracking-wider font-extrabold">
                            <th class="pb-3 px-3">#ID</th>
                            <th class="pb-3 px-3">Material Type</th>
                            <th class="pb-3 px-3">Points Rate</th>
                            <th class="pb-3 px-3">Total Mass Logged</th>
                            <th class="pb-3 px-3">Status</th>
                            <th class="pb-3 px-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-gray-700 font-medium">
                        @forelse($catalogs as $item)
                        @php
                            // قراءة الحقول من الفيلبول: type, points, total_weight
                            $type = $item->type ?? 'General Material';
                            $points = (int) ($item->points ?? 0);
                            $totalWeightKg = ((float) ($item->total_weight ?? 0)) / 1000;
                        @endphp
                        <tr class="hover:bg-gray-50/50 transition">
                            <!-- ID -->
                            <td class="py-4 px-3 font-mono font-bold text-gray-400">
                                #{{ $item->id }}
                            </td>

                            <!-- Material Type -->
                            <td class="py-4 px-3">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-full bg-emerald-50 text-[#1b804e] flex items-center justify-center font-bold text-xs uppercase shrink-0">
                                        {{ substr($type, 0, 1) }}
                                    </div>
                                    <span class="font-bold text-gray-900 leading-tight">{{ $type }}</span>
                                </div>
                            </td>

                            <!-- Points Rate -->
                            <td class="py-4 px-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-[#1b804e] font-mono whitespace-nowrap">
                                    {{ $points }} pts / 1g => {{ $points*100 }} pts / 100g
                                </span>
                            </td>

                            <!-- Total Weight -->
                            <td class="py-4 px-3 font-semibold text-gray-800 font-mono whitespace-nowrap">
                                {{ number_format($item->total_weight, 0) }} g => {{ number_format($item->total_weight, 0)/1000 }} kg
                            </td>

                            <!-- Status -->
                            <td class="py-4 px-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-100/60 text-[#1b804e] whitespace-nowrap">
                                    Accepting
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-3 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <!-- Edit Button -->
                                    <button
                                        type="button"
                                        onclick="openTypeModal('edit', { id: {{ $item->id }}, type: '{{ addslashes($type) }}', points: {{ $points }} })"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-gray-200 bg-white hover:bg-gray-50 text-gray-700 text-xs font-bold transition shadow-sm hover:border-[#1b804e] hover:text-[#1b804e] whitespace-nowrap"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                        Edit
                                    </button>

                                    <!-- Delete Button -->
                                    @php
                                        $deleteRoute = Route::has('catalog.destroy') ? route('catalog.destroy', $item->id) : (Route::has('materials.destroy') ? route('materials.destroy', $item->id) : '#');
                                    @endphp
                                    <form action="{{ $deleteRoute }}" method="POST" onsubmit="return confirm('Are you sure you want to remove {{ addslashes($type) }}?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-full border border-gray-200 bg-white hover:bg-rose-50 text-gray-400 hover:text-rose-600 transition shadow-sm" title="Delete">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                No material types found in the catalog.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(isset($catalog) && method_exists($catalog, 'links'))
            <div class="pt-4 border-t border-gray-100">
                {{ $catalog->links() }}
            </div>
            @endif

        </div>

    </main>

    <!-- Unified Modal: Add / Edit Material Type -->
    <div id="addTypeModal" class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-5 sm:p-8 shadow-2xl space-y-5 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between">
                <h3 id="modalTitle" class="text-base sm:text-lg font-extrabold text-gray-900">Add Material Type</h3>
                <button type="button" onclick="closeTypeModal()" class="text-gray-400 hover:text-gray-700 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            @php
                $formAction = Route::has('catalog.store') ? route('catalog.store') : (Route::has('materials.store') ? route('materials.store') : '#');
            @endphp
            <form id="materialForm" action="{{ $formAction }}" method="POST" class="space-y-4">
                @csrf
                <div id="methodField"></div>
                <input type="hidden" id="catalogId" name="id">

                <!-- Material Type Field (matches 'type' in $fillable) -->
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Material Type</label>
                    <input type="text" id="catalogType" name="type" placeholder="e.g. Plastic, Glass, Metal" required class="w-full px-3.5 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-base sm:text-xs focus:ring-2 focus:ring-[#1b804e] outline-none">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <!-- Points Rate Field (matches 'points' in $fillable) -->
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Points Rate</label>
                        <input type="number" id="catalogPoints" name="points" placeholder="20" required class="w-full px-3.5 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-base sm:text-xs focus:ring-2 focus:ring-[#1b804e] outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Per Mass</label>
                        <input type="text" value="100g" readonly class="w-full px-3.5 py-2.5 rounded-xl bg-gray-100 border border-gray-200 text-base sm:text-xs text-gray-500 outline-none cursor-not-allowed">
                    </div>
                </div>

                <div class="pt-2 flex gap-3">
                    <button type="button" onclick="closeTypeModal()" class="w-1/2 py-2.5 rounded-full border border-gray-200 text-xs font-bold text-gray-600 hover:bg-gray-50">Cancel</button>
                    <button type="submit" id="submitBtn" class="w-1/2 py-2.5 rounded-full bg-[#1b804e] hover:bg-[#15673e] text-white text-xs font-bold shadow-md shadow-[#1b804e]/20">Save Type</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script for Dynamic Modal Handling -->
    <script>
        const modal = document.getElementById('addTypeModal');
        const modalTitle = document.getElementById('modalTitle');
        const submitBtn = document.getElementById('submitBtn');
        const materialForm = document.getElementById('materialForm');
        const methodField = document.getElementById('methodField');
        const catalogId = document.getElementById('catalogId');
        const catalogType = document.getElementById('catalogType');
        const catalogPoints = document.getElementById('catalogPoints');

        // مسارات الإرسال
        const storeRoute = "{{ Route::has('catalog.store') ? route('catalog.store') : (Route::has('materials.store') ? route('materials.store') : '#') }}";
        const updateBaseUrl = "{{ url('catalog_update') }}"; // أو url('materials') حسب تسمية راوت التحديث عندك

        function openTypeModal(mode, data = null) {
            if (mode === 'edit' && data) {
                modalTitle.innerText = 'Edit Material Type';
                submitBtn.innerText = 'Save Changes';

                materialForm.action = updateBaseUrl + '/' + data.id;
                methodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';

                catalogId.value = data.id;
                catalogType.value = data.type;
                catalogPoints.value = data.points;
            } else {
                modalTitle.innerText = 'Add Material Type';
                submitBtn.innerText = 'Save Type';

                materialForm.action = storeRoute;
                methodField.innerHTML = '';

                materialForm.reset();
                catalogId.value = '';
            }
            modal.classList.remove('hidden');
        }

        function closeTypeModal() {
            modal.classList.add('hidden');
        }
    </script>

</body>
</html>