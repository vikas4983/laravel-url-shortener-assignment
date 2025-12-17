<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Admin Invitation</title>
</head>

<body style="margin:0;padding:0;background:#f4f6f8;font-family:Arial,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding:40px 0;">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:8px;
                   box-shadow:0 4px 12px rgba(0,0,0,0.08);overflow:hidden;">

                    <!-- Header -->
                    <tr>
                        <td style="background:#111827;padding:20px;text-align:center;">
                            <h2 style="color:#ffffff;margin:0;">ABC Company</h2>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:30px;color:#333;">
                            <p style="font-size:16px;">
                                Hello <strong>{{ $invite->name ?? '' }}</strong>,
                            </p>

                            <p style="font-size:15px;line-height:1.6;">
                                You have been invited by the <strong>{{ $invite->role->name ?? '' }}</strong> to join
                                <strong>{{ $invite->company->name ?? '' }}</strong> as an
                                <strong>Administrator</strong>.
                            </p>

                            <p style="font-size:15px;">
                                Please choose an option below:
                            </p>

                            <!-- Buttons -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin-top:30px;">
                                <tr>
                                    <td align="center">

                                        <!-- ACCEPT FORM -->
                                        <button type="submit"
                                            style="background:#16a34a;color:#fff;
                                                border:none;padding:12px 26px;
                                                border-radius:6px;font-size:15px;
                                                cursor:pointer;">
                                            ✅ Accept Invitation
                                        </button>
                                        <!-- REJECT FORM -->
                                        
                                    </td>
                                </tr>
                            </table>

                            <p style="margin-top:30px;font-size:13px;color:#6b7280;">
                                If you were not expecting this invitation, you can safely ignore this email.
                            </p>
                        </td>
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td
                            style="background:#f3f4f6;padding:15px;text-align:center;
                               font-size:12px;color:#6b7280;">
                            © {{ date('Y') }} ABC Company
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>

</html>
