<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authorize Staff - GreenAdmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f4f7f5] min-h-screen text-gray-800 antialiased pb-12">

    <main class="max-w-xl mx-auto px-4 sm:px-6 pt-12">
        <a href="{{ route('employee_index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-gray-500 hover:text-[#1b804e] transition mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Users Directory
        </a>

        <div class="bg-white rounded-3xl p-6 sm:p-10 border border-gray-100 shadow-sm space-y-6">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-emerald-50 text-[#1b804e] mb-2">
                    ACCESS DELEGATION
                </span>
                <h1 class="text-2xl font-extrabold text-gray-900">Add Operations Staff</h1>
                <p class="text-xs text-gray-500 mt-1">Assign an employee to oversee collection rounds and container maintenance</p>
            </div>

            <form action="{{ route('employee_store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="name" placeholder="e.g. Mahmoud Hassan" required class="w-full px-4 py-3 rounded-2xl bg-gray-50 border border-gray-200 text-xs focus:ring-2 focus:ring-[#1b804e] outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" placeholder="m.hassan@staff.green.edu" required class="w-full px-4 py-3 rounded-2xl bg-gray-50 border border-gray-200 text-xs focus:ring-2 focus:ring-[#1b804e] outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Zone</label>
                    <input type="text" name="zone" placeholder="Zone A (Engineering & Science)"  class="w-full px-4 py-3 rounded-2xl bg-gray-50 border border-gray-200 text-xs focus:ring-2 focus:ring-[#1b804e] outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-700 mb-1">User Role</label>
                    <select name="role" required class="w-full px-4 py-3 rounded-2xl bg-gray-50 border border-gray-200 text-xs text-gray-800 focus:ring-2 focus:ring-[#1b804e] outline-none">
                        <option value="employee" selected>Employee (Staff)</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <button type="submit" class="w-full mt-2 py-3.5 px-6 rounded-full bg-[#1b804e] hover:bg-[#15673e] text-white font-bold text-xs tracking-wide shadow-md shadow-[#1b804e]/20 transition flex items-center justify-center gap-2">
                    Authorize Employee Account
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </form>
        </div>
    </main>
</body>
</html>