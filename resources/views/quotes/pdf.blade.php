<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quotation</title>
    <style>
        /* Base */
        body { font-family: Arial, sans-serif; font-size: 13px; margin: 0; padding: 0; }
        .section { margin-bottom: 18px; }

        /* Header */
        .header { text-align: center; margin-bottom: 20px; }
        .logo-row { text-align: center; margin-bottom: 6px; }
        .logo-box { display: inline-block; vertical-align: bottom; margin: 0 8px; }
        /* same height for both logos; width auto keeps aspect ratio */
        .logo-img { height: 70px; width: auto; }
        .dpwh-caption { font-size: 11px; font-weight: bold; line-height: 1.2; margin-top: 2px; }

        .company-info { font-size: 14px; font-weight: bold; }
        .quote-title { font-size: 22px; font-weight: bold; margin: 20px 0 10px; }

        /* Tables */
        .details-table, .items-table { width: 100%; border-collapse: collapse; margin-bottom: 18px; }
        .details-table td { padding: 3px 6px; }
        .items-table th, .items-table td { border: 1px solid #333; padding: 6px; text-align: left; }
        .items-table th { background: #f2f2f2; }

        /* Totals */
        .totals { float: right; width: 40%; margin-top: 10px; }
        .totals td { padding: 4px 6px; }

        .footer { margin-top: 40px; font-size: 12px; text-align: center; color: #555; }
    </style>
</head>
<body>
    <div class="header">
        <!-- Logos row (centered) -->
        <div class="logo-row">
            <div class="logo-box">
                <img src="{{ public_path('images/gemarclogo.png') }}" class="logo-img" alt="GEMARC Logo">
            </div>
            <div class="logo-box">
                <img src="{{ public_path('images/dpwh.png') }}" class="logo-img" alt="DPWH Logo">
                <div class="dpwh-caption">DPWH - BRS <br>
                Accredited
            </div>
            </div>
        </div>

        <!-- Company block -->
        <div class="company-info" style="margin-top: 12px; margin-bottom: 12px;">
            <div style="margin-bottom: 8px; margin-top: 8px;">GEMARC ENTERPRISES INCORPORATED</div>
            15 Chile St. Phase 1, Greenheights Subd., Concepcion 1<br>
            Marikina City, 1807<br>
            <div style="margin-top: 8px; margin-bottom: 8px;">
                Tel: +63 909 087 9416 | +63 928 395 3532 | +63 918 905 8316
            </div>
            <div style="margin-bottom: 8px;">
                Email: sales@gemarcph.com | technical@gemarcph.com
            </div>
        </div>

        <div class="quote-title">QUOTATION</div>
    </div>

    <table class="details-table">
        <tr>
            <td><strong>Quote No.:</strong> {{ $quote->number ?? $quote->id }}</td>
            <td><strong>Date:</strong> {{ $quote->date ? $quote->date->format('F d, Y') : ($quote->created_at ? $quote->created_at->format('F d, Y') : '') }}</td>
        </tr>
        <tr>
            <td><strong>Name:</strong> {{ $quote->user ? $quote->user->name : '' }}</td>
            <td><strong>Email:</strong> {{ $quote->user ? $quote->user->email : '' }}</td>
        </tr>
        <tr>
            <td><strong>Address:</strong> {{ $quote->user ? $quote->user->address : '' }}</td>
            <td><strong>Contact No.:</strong> {{ $quote->user ? $quote->user->contact_no : '' }}</td>
        </tr>
    </table>

    <div class="section">
        <table class="items-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quote->items as $i => $item)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->unit_price, 2) }}</td>
                    <td>{{ number_format($item->unit_price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <table class="totals">
        <tr>
            <td><strong>Subtotal:</strong></td>
            <td>{{ number_format($quote->subtotal, 2) }}</td>
        </tr>
        <tr>
            <td><strong>VAT (12%):</strong></td>
            <td>{{ number_format($quote->vat, 2) }}</td>
        </tr>
        <tr>
            <td><strong>Total:</strong></td>
            <td><strong>{{ number_format($quote->total, 2) }}</strong></td>
        </tr>
    </table>

    <div style="clear:both;"></div>
    <br>
    @php
        // Always render the two header lines (centered + bold).
        $headerHtml = '';
        $headerHtml .= '<div style="text-align:center; width:100%; display:block; margin-bottom:8px;"><strong style="font-size:13px;">NOTE: FREE CALIBRATION WITH CERTIFICATE FOR OTHER APPARATUS</strong></div>';
        $headerHtml .= '<div style="text-align:center; width:100%; display:block; margin-bottom:12px;"><strong style="font-size:13px;">***NOTHING FOLLOWS***</strong></div>';

        // If quote has custom notes saved, render them (preserve newlines) underneath the header.
        if (!empty($quote->notes)) {
            // If saved notes already include the same header lines, strip them
            // so we don't print the header twice. Remove leading NOTE / NOTHING FOLLOWS lines.
            $notesContent = $quote->notes;
            $notesContent = preg_replace('/^\s*NOTE:.*(\r?\n|$)/i', '', $notesContent);
            $notesContent = preg_replace('/^\s*\*{3}NOTHING FOLLOWS\*{3}(\r?\n|$)/i', '', $notesContent);
            $notesContent = ltrim($notesContent);
            $notesHtml = $headerHtml . '<div style="font-size:12px; margin-top:6px;">' . nl2br(e($notesContent)) . '</div>';
        } else {
            $notesHtml = $headerHtml;
            $notesHtml .= '<div style="font-size:12px; margin-bottom:10px;"><h3>For Newly Purchased Item/Equipment that requires Calibration</h3>';
            $notesHtml .= '<ul>';
            $notesHtml .= '<li>One-time FREE Preventive Maintenance.</li>';
            $notesHtml .= '<li>One-time FREE Calibration after installation. Includes Certificate of Calibration valid for one year only.</li>';
            $notesHtml .= '<li>GEI shall not be liable in any circumstances if the equipment\'s calibration is void and is lost within one year due to tampering in any form, transfer from one place to another and unauthorized use, etc.</li>';
            $notesHtml .= '<li>Re-calibration of the equipment must be charged to the customer.</li>';
            $notesHtml .= '<li>Issued CoC and sticker must be returned to GEI before re-issuance of the new COC and sticker.</li>';
            $notesHtml .= '<li>Any re-issuance of valid and official Certificate of Calibration together with related documents will be charged a minimum fee of Php70.00 per page.</li>';
            $notesHtml .= '</ul></div>';

            $notesHtml .= '<div style="font-weight:bold; margin-top:10px;">NOTE:</div>';
            $notesHtml .= '<ol style="font-size:12px; margin-bottom:10px;">';
            $notesHtml .= '<li><b>AVAILABILITY:</b> On-stock items subject for prior sales.</li>';
            $notesHtml .= '<li><b>PAYMENT:</b> Full payment. Bank transfer for stock items. Bank to bank / CHECK / CASH. BDO - GEMARC ENTERPRISES INC. Account No. 002150093266</li>';
            $notesHtml .= '<li><b>WARRANTY:</b> (1) One Year warranty on parts and services for major equipment.</li>';
            $notesHtml .= '<li><b>VALIDITY:</b> 15 DAYS</li>';
            $notesHtml .= '<li><b>DELIVERY:</b> Free delivery within Metro Manila, all provincial delivery on Customer\'s account.</li>';
            $notesHtml .= '<li><b>QUALITY:</b> All products have passed through our GEI Quality Control and is guaranteed free from defect upon delivery.</li>';
            $notesHtml .= '</ol>';
            $notesHtml .= '<div style="font-size:12px; margin-bottom:10px;">7. Once we have received your Purchase Order and your failure to provide us a signed copy of these documents will be an acceptance on your part and all of the contents of the documents and the Terms and Conditions shall be deemed signed and approved.</div>';
        }
    @endphp

    <div class="section">
        {!! $notesHtml !!}
    </div>
    <br>
    <div class="section" style="margin-top:30px;">
        <div style="font-size:13px;">Very truly yours,</div>
        <div style="font-size:13px; font-weight:bold; margin-bottom:30px;">GEMARC ENTERPRISES INCORPORATED</div>
        <div style="font-size:13px;">Noted by:</div>
        @php $employee = auth()->user(); @endphp
        @if($employee)
            <div style="margin-top:10px; font-size:13px; font-weight:bold;">{{ $employee->name }}</div>
            <div style="font-size:12px;">{{ $employee->email }}</div>
        @endif
        @php
            // Determine a validity end date to display in the PDF (shown as "Valid Until").
            // Priority: explicit `effectivity_date` -> `expires_at`/`valid_until` -> created_at + 15 days (default validity).
            $eff = null;
            if (!empty($quote->effectivity_date)) {
                $eff = \Carbon\Carbon::parse($quote->effectivity_date);
            } elseif (!empty($quote->expires_at)) {
                $eff = \Carbon\Carbon::parse($quote->expires_at);
            } elseif (!empty($quote->valid_until)) {
                $eff = \Carbon\Carbon::parse($quote->valid_until);
            } else {
                $created = $quote->created_at ? \Carbon\Carbon::parse($quote->created_at) : \Carbon\Carbon::now();
                $eff = $created->copy()->addDays(15);
            }
        @endphp

        <div style="margin-top:40px; font-size:11px;">
            Quotation for Goods &nbsp;
            <a href="https://www.gemarcph.com" style="color:#333; text-decoration:none;">www.gemarcph.com</a>
            &nbsp; Valid Until: {{ $eff ? $eff->format('d F Y') : '' }}
        </div>
    </div>
</body>
</html>
