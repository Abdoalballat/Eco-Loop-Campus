<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Operations - Smart Waste Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- مكتبة الخرائط المجانية Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        html, body { max-width: 100%; overflow-x: hidden; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        *::-webkit-scrollbar { width: 8px !important; height: 8px !important; }
        *::-webkit-scrollbar-track { background: rgba(0, 0, 0, 0.04) !important; border-radius: 9999px !important; }
        *::-webkit-scrollbar-thumb { background-color: rgba(27, 128, 78, 0.4) !important; border-radius: 9999px !important; }
        *::-webkit-scrollbar-thumb:hover { background-color: rgba(27, 128, 78, 0.8) !important; }
        * { scrollbar-width: thin !important; scrollbar-color: rgba(27, 128, 78, 0.4) rgba(0, 0, 0, 0.04) !important; }

        /* ضبط ستايل البوب أب للخريطة */
        .leaflet-popup-content-wrapper {
            border-radius: 20px !important;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
            padding: 4px !important;
        }
    </style>
</head>
<body class="bg-[#f4f7f5] min-h-screen text-gray-800 antialiased pb-10 sm:pb-12">

    <!-- Floating Top Navigation Bar (Employee Portal) -->
    <header class="pt-4 sm:pt-6 px-3 sm:px-8 max-w-7xl mx-auto">
        <nav class="bg-white rounded-3xl sm:rounded-full px-4 sm:px-6 py-2.5 sm:py-3 shadow-lg shadow-gray-200/50 flex items-center justify-between gap-2 border border-gray-100">
            <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[#1b804e] flex items-center justify-center text-white font-bold shrink-0">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <span class="font-extrabold text-sm sm:text-lg tracking-tight text-gray-900 block leading-tight truncate">Eco Loop Campus</span>
                    <span class="text-[9px] sm:text-[10px] font-bold text-gray-400 uppercase tracking-widest">Field Personnel</span>
                </div>
            </div>

            <!-- Employee Assigned Zone Tag -->
            <div class="hidden sm:flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-50 border border-emerald-100 text-xs font-bold text-[#1b804e] shrink-0">
                <span class="w-2 h-2 rounded-full bg-[#1b804e] animate-pulse"></span>
                Duty Area: {{ auth()->user()?->zone ?? 'Sector Grid & Hub' }}
            </div>

            <div class="flex items-center gap-3 shrink-0">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-[#1b804e] hover:bg-[#15673e] text-white px-3.5 sm:px-5 py-2 sm:py-2.5 rounded-full text-[11px] sm:text-xs font-bold transition shadow-md shadow-[#1b804e]/20">
                        Sign Out
                    </button>
                </form>
            </div>
        </nav>

        <!-- Duty Zone Tag (mobile) -->
        <div class="sm:hidden mt-3 flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-50 border border-emerald-100 text-xs font-bold text-[#1b804e] w-fit mx-auto">
            <span class="w-2 h-2 rounded-full bg-[#1b804e] animate-pulse shrink-0"></span>
            <span class="truncate">Duty Area: {{ auth()->user()?->zone ?? 'Sector Grid & Hub' }}</span>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-3 sm:px-8 mt-6 sm:mt-8 space-y-6 sm:space-y-8">

        <!-- Flash Success Notification -->
        @if(session('success'))
        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between text-xs font-bold shadow-sm">
            <div class="flex items-center gap-2 min-w-0">
                <svg class="w-4 h-4 text-[#1b804e] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                <span class="break-words">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        <!-- Top Welcome & Duty Banner -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] sm:text-xs font-bold tracking-wider text-[#1b804e] bg-emerald-100/60 uppercase mb-2">
                    <span class="w-2 h-2 rounded-full bg-[#1b804e]"></span>
                    Operations Desk
                </div>
                <h1 class="text-xl sm:text-3xl font-extrabold text-gray-900">Live Telemetry & Field Map</h1>
            </div>

            <button onclick="window.location.reload()" class="w-full sm:w-auto justify-center inline-flex items-center gap-2 px-4 py-2.5 rounded-full border border-gray-200 bg-white hover:bg-gray-50 text-gray-700 text-xs font-bold transition shadow-sm self-start sm:self-auto">
                <svg class="w-4 h-4 text-[#1b804e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Refresh Telemetry
            </button>
        </div>

        @php
            $criticalCount = collect($containers ?? [])->filter(fn($c) => ($c->fill_level ?? 0) >= ($c->threshold ?? 80))->count();
            $normalCount = collect($containers ?? [])->count() - $criticalCount;
        @endphp

        <!-- Shift Overview KPI Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">

            <!-- Card 1: Urgent Pickups -->
            <div class="bg-white rounded-3xl p-5 sm:p-6 border {{ $criticalCount > 0 ? 'border-amber-300' : 'border-gray-100' }} shadow-sm flex items-center justify-between gap-3">
                <div class="min-w-0">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider {{ $criticalCount > 0 ? 'bg-amber-50 text-amber-800' : 'bg-gray-100 text-gray-600' }} mb-3">
                        Action Required
                    </span>
                    <h3 class="text-2xl sm:text-4xl font-extrabold text-gray-900">{{ $criticalCount }} {{ Str::plural('Unit',$criticalCount) }}</h3>
                    <p class="text-xs text-gray-500 font-medium mt-1">Exceeded threshold capacity (&ge; 80%)</p>
                </div>
                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl {{ $criticalCount > 0 ? 'bg-amber-50 text-amber-600' : 'bg-gray-50 text-gray-400' }} flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
            </div>

            <!-- Card 2: Normal Units -->
            <div class="bg-white rounded-3xl p-5 sm:p-6 border border-gray-100 shadow-sm flex items-center justify-between gap-3">
                <div class="min-w-0">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-emerald-50 text-[#1b804e] mb-3">
                        Operational Status
                    </span>
                    <h3 class="text-2xl sm:text-4xl font-extrabold text-gray-900">{{ $normalCount }} Units</h3>
                    <p class="text-xs text-gray-500 font-medium mt-1">Within safe operational limits</p>
                </div>
                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-emerald-50 text-[#1b804e] flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Card 3: Shift Log -->
            <div class="bg-[#1b804e] text-white rounded-3xl p-5 sm:p-6 shadow-lg flex flex-col justify-between">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-white/15 text-white backdrop-blur-sm w-fit">
                    Active Session
                </span>
                <div class="mt-4">
                    <h3 class="text-xl sm:text-2xl font-extrabold">{{ count($containers ?? []) }} Bins Monitored</h3>
                    <p class="text-xs text-emerald-100/80 mt-1 font-medium">Synced in real-time with IoT telemetry</p>
                </div>
            </div>

        </div>

        <!-- OPENSTREETMAP SECTION -->
        <div class="bg-white rounded-3xl p-4 sm:p-8 border border-gray-100 shadow-sm space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <h3 class="text-sm sm:text-base font-extrabold text-gray-900">Campus Sensor Map</h3>
                    <p class="text-xs text-gray-500 font-medium">Live geographic distribution of containers and fill-level pins</p>
                </div>
                <div class="flex items-center gap-3 sm:gap-4 text-xs font-bold">
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded-full bg-emerald-500 shrink-0"></span>
                        <span class="text-gray-600 whitespace-nowrap">Normal (&lt;80%)</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded-full bg-rose-500 shrink-0"></span>
                        <span class="text-gray-600 whitespace-nowrap">Critical (&ge;80%)</span>
                    </div>
                </div>
            </div>

            <!-- Map Container -->
            <div id="mapContainer" class="w-full h-[300px] sm:h-[420px] rounded-2xl border border-gray-100 shadow-inner bg-gray-50 z-0"></div>
        </div>

        <!-- Containers List Table -->
        <div class="bg-white rounded-3xl p-4 sm:p-8 border border-gray-100 shadow-sm space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-2">
                <div>
                    <h3 class="text-sm sm:text-base font-extrabold text-gray-900">Sector Collection Points</h3>
                    <p class="text-xs text-gray-500 font-medium">Verify bin telemetry and trigger reset upon service</p>
                </div>
            </div>

            <!-- Horizontal scroll is intentional on phones: five columns of telemetry data
                 don't fit a narrow screen, so scrolling inside the card beats squeezing them. -->
            <div class="overflow-x-auto overflow-y-auto max-h-[520px] rounded-2xl border border-gray-50 pb-2 -mx-4 px-4 sm:mx-0 sm:px-0">
                <table class="w-full text-left text-xs min-w-[750px]">
                    <thead class="sticky top-0 bg-white z-10 shadow-sm">
                        <tr class="border-b border-gray-100 text-gray-400 uppercase tracking-wider font-extrabold">
                            <th class="py-3 px-3">Unit ID</th>
                            <th class="py-3 px-3">Location</th>
                            <th class="py-3 px-3">Material Stream</th>
                            <th class="py-3 px-3">Current Fill Level</th>
                            <th class="py-3 px-3 text-right">Service Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-gray-700 font-medium">
                        @forelse($containers ?? [] as $container)
                        @php
                            $fill = (float)($container->fill_level ?? 0);
                            $threshold = (float)($container->threshold ?? 80);
                            $isCritical = $fill >=$threshold;
                        @endphp
                        <tr class="hover:bg-gray-50/50 transition">
                            <!-- Unit ID -->
                            <td class="py-4 px-3 font-bold text-gray-900 font-mono whitespace-nowrap">
                                {{ $container->serial_number ?? ('CONT-' . $container->id) }}
                            </td>

                            <!-- Location with Map Pan Action -->
                            <td class="py-4 px-3 font-semibold text-gray-800">
                                <div class="flex items-center gap-1.5">
                                    <span>{{ $container->location_name ?? $container->location ?? 'Campus Spot' }}</span>
                                    @if($container->latitude &&$container->longitude)
                                    <button
                                        type="button"
                                        onclick="focusMarker({{ $container->latitude }}, {{$container->longitude }})"
                                        class="p-1 text-[#1b804e] hover:bg-emerald-50 rounded-lg transition shrink-0"
                                        title="Focus on Map"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </button>
                                    @endif
                                </div>
                            </td>

                            <!-- Material Category -->
                            <td class="py-4 px-3">
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-gray-100 text-gray-800 whitespace-nowrap">
                                    {{ $container->material_type ?? $container->status ?? 'Recyclable' }}
                                </span>
                            </td>

                            <!-- Fill Level Progress -->
                            <td class="py-4 px-3">
                                <div class="w-36 space-y-1">
                                    <div class="flex justify-between text-[11px] font-bold {{ $isCritical ? 'text-rose-600' : 'text-[#1b804e]' }}">
                                        <span>Capacity</span>
                                        <span>{{ $fill }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                                        <div class="{{ $isCritical ? 'bg-rose-500' : 'bg-[#1b804e]' }} h-2 rounded-full transition-all duration-500" style="width: {{ min($fill, 100) }}%"></div>
                                    </div>
                                </div>
                            </td>

                            <!-- Dynamic Service Action: Button enabled when critical, badge when normal -->
                            <td class="py-4 px-3 text-right">
                                @if($isCritical)
                                    <button
                                        type="button"
                                        onclick="openEmptyModal('{{ $container->id }}', '{{$container->serial_number ?? $container->id }}', '{{ addslashes($container->location_name ?? $container->location) }}', {{$fill }})"
                                        class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold transition shadow-sm whitespace-nowrap"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        Mark Emptied
                                    </button>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-gray-100 text-gray-500 border border-gray-200/60 whitespace-nowrap">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Normal
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-xs text-gray-400">
                                No containers assigned or found in this operational zone.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- Modal: Confirmation of Clearing / Emptying -->
    <div id="serviceModal" class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-5 sm:p-8 shadow-2xl space-y-5 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between">
                <h3 class="text-base sm:text-lg font-extrabold text-gray-900">Confirm Container Service</h3>
                <button type="button" onclick="closeEmptyModal()" class="text-gray-400 hover:text-gray-700 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form id="emptyForm" action="#" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100 space-y-2">
                    <div class="flex justify-between gap-2 text-xs">
                        <span class="text-gray-500 font-semibold shrink-0">Container:</span>
                        <span id="modalBinSerial" class="font-extrabold text-gray-900 text-right truncate">---</span>
                    </div>
                    <div class="flex justify-between gap-2 text-xs">
                        <span class="text-gray-500 font-semibold shrink-0">Location:</span>
                        <span id="modalBinLocation" class="font-bold text-gray-700 text-right truncate">---</span>
                    </div>
                    <div class="flex justify-between gap-2 text-xs">
                        <span class="text-gray-500 font-semibold shrink-0">Reported Load:</span>
                        <span id="modalBinLoad" class="font-extrabold text-rose-600">0%</span>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Operational Notes (Optional)</label>
                    <textarea name="notes" rows="2" placeholder="e.g. Cleared completely, bag replaced, sensor clean..." class="w-full px-3.5 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-base sm:text-xs focus:ring-2 focus:ring-[#1b804e] outline-none resize-none"></textarea>
                </div>

                <div class="pt-2 flex gap-3">
                    <button type="button" onclick="closeEmptyModal()" class="w-1/2 py-2.5 rounded-full border border-gray-200 text-xs font-bold text-gray-600 hover:bg-gray-50">Cancel</button>
                    <button type="submit" class="w-1/2 py-2.5 rounded-full bg-[#1b804e] hover:bg-[#15673e] text-white text-xs font-bold shadow-md shadow-[#1b804e]/20">Confirm Reset</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Leaflet & App Scripts -->
    <script>
    // 1. تعريف المتغير أولاً باستخدام var لتجنب أي مشاكل Hoisting
    var containersData = @json($containers ?? []);

    var map = null;
    var markersGroup = [];

    function initLeafletMap() {
        // التأكد من وجود حاوية الخريطة
        var mapElement = document.getElementById('mapContainer');
        if (!mapElement) return;

        // إحداثيات افتراضية
        var defaultCenter = [30.0444, 31.2357];

        map = L.map('mapContainer').setView(defaultCenter, 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        var bounds = [];

        // طباعة البيانات في الكونسول للتأكد منها
        console.log("Loaded Containers:", containersData);

        if (Array.isArray(containersData)) {
            containersData.forEach(function(container) {
                if (container.latitude && container.longitude) {
                    var lat = parseFloat(container.latitude);
                    var lng = parseFloat(container.longitude);
                    var fillLevel = Number(container.fill_level != null ? container.fill_level : 0);
                    var threshold = Number(container.threshold != null ? container.threshold : 80);

                    var isCritical = fillLevel >= threshold;
                    var markerColor = isCritical ? '#e11d48' : '#1b804e';

                    var marker = L.circleMarker([lat, lng], {
                        radius: 9,
                        fillColor: markerColor,
                        color: "#ffffff",
                        weight: 2,
                        opacity: 1,
                        fillOpacity: 0.95
                    }).addTo(map);

                    marker.bindPopup(`
                        <div style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 12px; color: #1f2937; min-width: 170px;">
                            <span style="font-weight: 800; font-size: 13px; color: #111827; display:block;">
                                ${container.serial_number || ('Unit #' + container.id)}
                            </span>
                            <span style="color: #6b7280; font-size: 11px; display:block; margin-bottom: 8px;">
                                ${container.location_name || container.location || 'Assigned Zone'}
                            </span>
                            <div style="display:flex; justify-content:space-between; margin-bottom:4px; font-weight:700;">
                                <span>Fill Level:</span>
                                <span style="color: ${markerColor};">${fillLevel}%</span>
                            </div>
                            <div style="background:#f3f4f6; height:6px; border-radius:9999px; overflow:hidden;">
                                <div style="background:${markerColor}; width:${Math.min(fillLevel, 100)}%; height:100%;"></div>
                            </div>
                        </div>
                    `);

                    markersGroup.push({ id: container.id, lat: lat, lng: lng, marker: marker });
                    bounds.push([lat, lng]);
                }
            });
        }

        if (bounds.length > 0) {
            map.fitBounds(bounds, { padding: [40, 40] });
        }

        // Keep the map tiles correctly sized if the viewport rotates or resizes on mobile
        window.addEventListener('resize', function () {
            if (map) map.invalidateSize();
        });
    }

    // تشغيل الخريطة بعد اكتمال تحميل الصفحة
    window.addEventListener('DOMContentLoaded', initLeafletMap);

    function focusMarker(lat, lng) {
        if (map) {
            map.setView([parseFloat(lat), parseFloat(lng)], 18, { animate: true });
            var mapElem = document.getElementById('mapContainer');
            if (mapElem) {
                window.scrollTo({ top: mapElem.offsetTop - 100, behavior: 'smooth' });
            }
        }
    }

    // التحكم في المودال
    var modal = document.getElementById('serviceModal');
    var modalSerial = document.getElementById('modalBinSerial');
    var modalLocation = document.getElementById('modalBinLocation');
    var modalLoad = document.getElementById('modalBinLoad');
    var emptyForm = document.getElementById('emptyForm');

    function openEmptyModal(id, serial, location, load) {
        if (modalSerial) modalSerial.innerText = serial;
        if (modalLocation) modalLocation.innerText = location;
        if (modalLoad) modalLoad.innerText = load + '%';
        if (emptyForm) emptyForm.action = "{{ url('containers') }}/" + id + "/empty";
        if (modal) modal.classList.remove('hidden');
    }

    function closeEmptyModal() {
        if (modal) modal.classList.add('hidden');
    }
</script>

</body>
</html>