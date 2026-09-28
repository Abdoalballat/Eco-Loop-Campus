<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Account - Eco Loop Campus</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f7f5; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; color: #1f2937;">

    <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #f4f7f5; padding: 45px 15px;">
        <tr>
            <td align="center">
                
                <!-- Pill-Shaped Top Mini Brand Bar -->
                <table role="presentation" border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 24px;">
                    <tr>
                        <td style="background-color: #ffffff; border: 1px solid #e5e7eb; border-radius: 9999px; padding: 8px 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                            <table role="presentation" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="vertical-align: middle;">
                                        <div style="width: 28px; height: 28px; border-radius: 9999px; background-color: #1b804e; text-align: center; line-height: 28px; color: #ffffff; font-weight: 800; font-size: 14px;">
                                            G
                                        </div>
                                    </td>
                                    <td style="vertical-align: middle; padding-left: 10px;">
                                        <span style="font-size: 14px; font-weight: 800; color: #111827; letter-spacing: -0.3px;">EcoLoop Campus</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <!-- Main Card Container -->
                <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width: 520px; background-color: #ffffff; border-radius: 32px; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04); border: 1px solid #edf2ed;">
                    
                    <!-- Top Badge -->
                    <tr>
                        <td align="center" style="padding: 40px 30px 10px 30px;">
                            <div style="display: inline-block; background-color: #d1fae5; border-radius: 9999px; padding: 5px 14px; margin-bottom: 12px;">
                                <span style="font-size: 10px; font-weight: 800; color: #1b804e; text-transform: uppercase; letter-spacing: 1px;">
                                    ● PLATFORM SECURITY
                                </span>
                            </div>
                            <h1 style="margin: 0; font-size: 24px; font-weight: 800; color: #111827; letter-spacing: -0.5px;">Security Verification</h1>
                            <p style="margin: 8px 0 0 0; font-size: 13px; color: #6b7280; font-weight: 500;">One-time authorization passkey for your session</p>
                        </td>
                    </tr>

                    <!-- Body Text -->
                    <tr>
                        <td style="padding: 15px 40px 0 40px; text-align: center;">
                            <p style="margin: 0; font-size: 13px; line-height: 1.6; color: #4b5563;">
                                Hello <strong style="color: #111827;">{{ $user->name ?? 'Campus Member' }}</strong>,<br>
                                Please use the 6-digit confirmation code below to complete your authentication.
                            </p>
                        </td>
                    </tr>

                    <!-- Pill-Styled OTP Box -->
                    <tr>
                        <td align="center" style="padding: 28px 40px;">
                            <table role="presentation" border="0" cellspacing="0" cellpadding="0" style="width: 100%; max-width: 340px;">
                                <tr>
                                    <td align="center" style="background-color: #f0fdf4; border: 1.5px solid #bbf7d0; border-radius: 24px; padding: 20px 15px;">
                                        <span style="font-family: 'Courier New', Courier, monospace; font-size: 38px; font-weight: 800; letter-spacing: 10px; color: #1b804e; display: inline-block; margin-left: 10px;">
                                            {{ $otp ?? '******' }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                            <p style="margin: 12px 0 0 0; font-size: 11px; color: #9ca3af; font-weight: 600;">
                                Valid for <span style="color: #1b804e; font-weight: 700;">10 minutes</span> &bull; Single-use only
                            </p>
                        </td>
                    </tr>

                    <!-- Info Box -->
                    <tr>
                        <td style="padding: 0 35px 35px 35px;">
                            <div style="background-color: #f9fafb; border-radius: 20px; border: 1px solid #f3f4f6; padding: 16px 20px; text-align: left;">
                                <table role="presentation" border="0" cellspacing="0" cellpadding="0" width="100%">
                                    <tr>
                                        <td style="width: 24px; vertical-align: top; font-size: 14px;">🔒</td>
                                        <td style="padding-left: 8px; font-size: 11px; line-height: 1.5; color: #6b7280; font-weight: 500;">
                                            If you didn't initiate this request, someone may be attempting to access your portal. Please discard this message immediately.
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>

                    <!-- Footer Bar -->
                    <tr>
                        <td align="center" style="background-color: #fafbfa; padding: 18px 30px; border-top: 1px solid #f0f4f1;">
                            <p style="margin: 0; font-size: 11px; color: #9ca3af; font-weight: 600;">
                                &copy; {{ date('Y') }} GreenCampus Operations. Automated Security Dispatch.
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>