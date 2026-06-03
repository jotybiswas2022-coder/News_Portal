<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>জরুরি রক্তের প্রয়োজন</title>
</head>
<body style="margin:0;padding:0;background:#f4f4f8;font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f8;padding:30px 10px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 4px 30px rgba(0,0,0,0.08);">

                    {{-- Red Header --}}
                    <tr>
                        <td style="background:linear-gradient(135deg,#dc2626,#ef4444);padding:30px 30px 24px;text-align:center;">
                            <div style="width:64px;height:64px;margin:0 auto 14px;background:rgba(255,255,255,0.15);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                <span style="font-size:32px;">🩸</span>
                            </div>
                            <h1 style="color:#fff;font-size:22px;font-weight:800;margin:0 0 6px;letter-spacing:-0.3px;">🚨 জরুরি রক্তের প্রয়োজন!</h1>
                            <p style="color:rgba(255,255,255,0.8);font-size:14px;margin:0;line-height:1.5;">
                                <strong style="color:#fff;">{{ $bloodRequest->blood_group }}</strong> ব্লাড গ্রুপের একজন রোগীর জরুরি রক্ত প্রয়োজন
                            </p>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding:28px 30px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding-bottom:16px;">
                                        <h2 style="font-size:18px;font-weight:700;color:#1f2937;margin:0 0 4px;">প্রিয় {{ $donorProfile->name }},</h2>
                                        <p style="font-size:14px;color:#6b7280;line-height:1.7;margin:0;">
                                            আপনার ব্লাড গ্রুপের সাথে মিলে যাওয়া একটি জরুরি রক্তের অনুরোধ এসেছে। 
                                            নিচের তথ্য দেখে দ্রুত যোগাযোগ করার জন্য অনুরোধ করা যাচ্ছে।
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            {{-- Info Boxes --}}
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin:18px 0;">
                                <tr>
                                    <td style="padding:14px 18px;background:#fef2f2;border-radius:12px;border-left:4px solid #dc2626;">
                                        <table width="100%" cellpadding="4" cellspacing="0">
                                            <tr>
                                                <td width="120" style="font-size:13px;color:#6b7280;font-weight:600;">রোগীর নাম</td>
                                                <td style="font-size:14px;color:#1f2937;font-weight:700;">{{ $bloodRequest->patient_name }}</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size:13px;color:#6b7280;font-weight:600;">প্রয়োজনীয় রক্ত</td>
                                                <td style="font-size:16px;color:#dc2626;font-weight:800;">{{ $bloodRequest->blood_group }}</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size:13px;color:#6b7280;font-weight:600;">অবস্থান</td>
                                                <td style="font-size:14px;color:#1f2937;font-weight:600;">{{ $bloodRequest->location }}</td>
                                            </tr>
                                            @if($bloodRequest->hospital)
                                            <tr>
                                                <td style="font-size:13px;color:#6b7280;font-weight:600;">হাসপাতাল</td>
                                                <td style="font-size:14px;color:#1f2937;font-weight:600;">{{ $bloodRequest->hospital }}</td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td style="font-size:13px;color:#6b7280;font-weight:600;">যোগাযোগ</td>
                                                <td style="font-size:14px;color:#1f2937;font-weight:600;">
                                                    <a href="tel:{{ $bloodRequest->contact_phone }}" style="color:#22c55e;text-decoration:none;font-weight:700;">
                                                        {{ $bloodRequest->contact_phone }}
                                                    </a>
                                                </td>
                                            </tr>
                                            @if($bloodRequest->message)
                                            <tr>
                                                <td style="font-size:13px;color:#6b7280;font-weight:600;">বার্তা</td>
                                                <td style="font-size:13px;color:#1f2937;line-height:1.5;">{{ $bloodRequest->message }}</td>
                                            </tr>
                                            @endif
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            {{-- Urgency Badge --}}
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:20px;">
                                <tr>
                                    <td align="center">
                                        @php
                                            $urgencyBadge = match($bloodRequest->urgency) {
                                                'critical' => '🔴 ক্রিটিক্যাল - অবিলম্বে প্রয়োজন',
                                                'urgent' => '🟡 জরুরি - দ্রুত প্রয়োজন',
                                                default => '🔵 সাধারণ - প্রয়োজন রয়েছে',
                                            };
                                        @endphp
                                        <span style="display:inline-block;padding:8px 20px;border-radius:50px;font-size:13px;font-weight:700;
                                            {{ $bloodRequest->urgency === 'critical' ? 'background:#fef2f2;color:#dc2626;border:1px solid #fecaca;' : ($bloodRequest->urgency === 'urgent' ? 'background:#fefce8;color:#d97706;border:1px solid #fde68a;' : 'background:#eff6ff;color:#2563eb;border:1px solid #bfdbfe;') }}">
                                            {{ $urgencyBadge }}
                                        </span>
                                    </td>
                                </tr>
                            </table>

                            {{-- CTA Button --}}
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" style="padding:8px 0 16px;">
                                        <a href="tel:{{ $bloodRequest->contact_phone }}"
                                           style="display:inline-block;padding:14px 36px;background:linear-gradient(135deg,#dc2626,#ef4444);color:#fff;font-size:16px;font-weight:700;text-decoration:none;border-radius:12px;box-shadow:0 4px 16px rgba(220,38,38,0.35);">
                                            📞 এখনই কল করুন
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding:16px 0 0;border-top:1px solid #f3f4f6;">
                                        <p style="font-size:12px;color:#9ca3af;line-height:1.6;margin:0;text-align:center;">
                                            একটি জীবন বাঁচান - আপনার এক ফোঁটা রক্ত কারো জন্য হতে পারে নতুন জীবনের আশীর্বাদ।<br>
                                            রক্তদানের পর কমপক্ষে <strong>৯০ দিন</strong> অপেক্ষা করতে হবে।
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background:#f8f9fa;padding:16px 30px;text-align:center;border-top:1px solid #f3f4f6;">
                            <p style="font-size:11px;color:#9ca3af;margin:0;">
                                ব্লাড ব্যাংক &copy; {{ date('Y') }} &middot; রক্তদান · জীবন বাঁচান
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
