<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Your Password Has Been Changed</title>
</head>
<body style="margin:0;padding:0;background:#f4f6f8;font-family:Arial,Helvetica,sans-serif;color:#222;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f8;padding:40px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 6px 24px rgba(0,0,0,0.12);">
                    <tr>
                        <td style="padding:28px 36px 8px 36px;text-align:center;">
                            @if(isset($message))
                                <img src="{{ $message->embed(public_path('images/gemarclogo.png')) }}" alt="Gemarc" style="height:64px;display:block;margin:0 auto 12px;" />
                            @else
                                <img src="{{ asset('images/gemarclogo.png') }}" alt="Gemarc" style="height:64px;display:block;margin:0 auto 12px;" />
                            @endif
                            <h2 style="margin:0;font-size:18px;color:#16a34a;">Gemarc Enterprises Inc.</h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:18px 36px 24px 36px;">
                            <h3 style="margin:0 0 12px 0;font-size:20px;color:#111;">Hello {{ $user->name }},</h3>

                            <p style="margin:0 0 12px 0;color:#333;line-height:1.5;">
                                This is a notification that your account password was recently changed.
                            </p>

                            <p style="margin:0 0 12px 0;color:#333;line-height:1.5;">
                                If you did not make this change, please contact support immediately so we can secure your account.
                            </p>

                            <p style="margin:18px 0 0 0;color:#333;line-height:1.5;">Thank you,<br>The Gemarc Team</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="background:#f9fafb;padding:16px 36px 28px 36px;border-top:1px solid #eef2f6;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="vertical-align:top;">
                                        <p style="margin:0;font-size:13px;color:#666;">Gemarc Enterprises Inc.<br>
                                        No. 15 Chile St. Ph1 Greenheights Subdivision,<br>
                                        Concepcion 1, Marikina City, Philippines 1807<br>
                                        Phone: (632) 8-997-7959</p>
                                    </td>
                                    <td align="right" style="vertical-align:top;">
                                        <p style="margin:0;font-size:13px;color:#666;">&copy; {{ date('Y') }} Gemarc Enterprises Inc.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
