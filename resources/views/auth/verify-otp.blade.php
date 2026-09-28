<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP - Green University</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .dot-pattern {
            background-image: radial-gradient(rgba(255, 255, 255, 0.22) 1.5px, transparent 1.5px);
            background-size: 20px 20px;
        }
    </style>
</head>
<body class="min-h-screen bg-[#1b804e] flex flex-col justify-center items-center px-4 py-8 relative overflow-hidden">
                    @if ($errors->any())
                <div class="bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl p-3 sm:p-4 shadow-sm flex items-start gap-3">
                    <div class="w-8 h-8 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="text-xs font-extrabold uppercase tracking-wider text-rose-900 mb-1">Action Required</h4>
                        <ul class="list-disc list-inside text-xs font-medium space-y-0.5 text-rose-700 break-words">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <!-- 2. Flash Session Error -->
                @if (session('error'))
                <div class="bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl p-3 sm:p-4 shadow-sm flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-8 h-8 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-rose-900 break-words">{{ session('error') }}</p>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-rose-400 hover:text-rose-600 shrink-0" aria-label="Dismiss">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                @endif

                <!-- 3. Flash Session Success -->
                @if (session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-900 rounded-2xl p-3 sm:p-4 shadow-sm flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-8 h-8 rounded-xl bg-emerald-100 text-[#1b804e] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-emerald-900 break-words">{{ session('success') }}</p>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-600 shrink-0" aria-label="Dismiss">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                @endif
    <div class="absolute top-12 left-12 w-48 h-48 dot-pattern pointer-events-none opacity-70 hidden md:block"></div>
    <div class="absolute -bottom-10 -right-10 w-64 h-64 dot-pattern pointer-events-none opacity-50 hidden md:block"></div>

    <div class="w-full max-w-md my-auto relative z-10">
        <div class="flex justify-center mb-6">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold tracking-wider text-white uppercase bg-white/10 backdrop-blur-md border border-white/20 shadow-sm">
                SECURITY CODE
            </span>
        </div>

        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Enter OTP Code</h1>
            <p class="text-white/80 text-sm mt-2 font-medium">Enter the 6-digit code sent to your email</p>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-2xl shadow-emerald-950/20">
            <form action="{{ route('verify_otp') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="email" value="{{ request('email') ?? session('email') }}">

                <div>
                    <label class="block text-xs font-bold tracking-wide uppercase text-gray-700 text-center mb-4">6-Digit Verification Code</label>
                    <div class="flex justify-between gap-2 max-w-xs mx-auto">
                        @for ($i = 0; $i < 6; $i++)
                            <input 
                                type="text" 
                                id="otp_input"
                                maxlength="1" 
                                class="otp-box w-11 h-13 text-center text-xl font-bold bg-green-100 border border-gray-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#1b804e] transition"
                                required
                            >
                        @endfor
                    </div>
                    <input type="hidden" name="otp" id="full-otp">
                    @error('otp') <span class="text-xs text-red-600 text-center mt-2 block font-medium">{{ $message }}</span> @enderror
                </div>

                <button type="submit" id="submit_btn" class="w-full py-4 px-6 rounded-full bg-[#1b804e] hover:bg-[#15673e] text-white font-bold text-sm tracking-wide shadow-lg shadow-[#1b804e]/25 transition duration-200">
                    Verify Code
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-100 text-center space-y-2">
                <p class="text-xs text-gray-600 font-medium">Didn't receive the code?</p>
                <form action="#" method="POST">
                    @csrf
                    <input type="hidden"  name="email" value="{{ request('email') ?? session('email') }}">
                    <a class="text-xs font-bold text-[#1b804e] hover:underline" href="{{ route('forget_page') }}">Back To Forget Password Form</a>
                </form>
            </div>
        </div>
    </div>

    <script>
    @if(session('retry_after'))
    document.addEventListener("DOMContentLoaded", function () {
        let timeLeft = {{ session('retry_after') }};
        const submitBtn = document.getElementById('submit_btn');
        const otpInput = document.getElementById('otp_input');
        const originalBtnText = submitBtn.innerText;

        submitBtn.disabled = true;
        if (otpInput) {
            otpInput.disabled = true;
        }

        const timer = setInterval(function () {
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            let formattedSeconds = seconds < 10 ? '0' + seconds : seconds;

            submitBtn.innerText = `Try again after ${minutes}:${formattedSeconds}`;
            timeLeft--;

            if (timeLeft < 0) {
                clearInterval(timer);
                submitBtn.disabled = false;
                if (otpInput) {
                    otpInput.disabled = false;
                }
                submitBtn.innerText = originalBtnText;
            }
        }, 1000);
    });
@endif
        const inputs = document.querySelectorAll('.otp-box');
        const hiddenOtp = document.getElementById('full-otp');
        inputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                if (e.target.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
                syncOtp();
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });

        function syncOtp() {
            let fullVal = '';
            inputs.forEach(input => fullVal += input.value);
            hiddenOtp.value = fullVal;
        }
    </script>
</body>
</html>