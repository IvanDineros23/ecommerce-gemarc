<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quotation</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 13px; margin: 0; padding: 0; }
        .header { text-align: center; margin-bottom: 20px; }
        .company-logo { width: 120px; margin-bottom: 10px; }
        .company-info { font-size: 14px; font-weight: bold; }
        .quote-title { font-size: 22px; font-weight: bold; margin: 20px 0 10px; }
        .section { margin-bottom: 18px; }
        .details-table, .items-table { width: 100%; border-collapse: collapse; margin-bottom: 18px; }
        .details-table td { padding: 3px 6px; }
        .items-table th, .items-table td { border: 1px solid #333; padding: 6px; text-align: left; }
        .items-table th { background: #f2f2f2; }
        .totals { float: right; width: 40%; margin-top: 10px; }
        .totals td { padding: 4px 6px; }
        .footer { margin-top: 40px; font-size: 12px; text-align: center; color: #555; }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/gemarclogo.png') }}" class="company-logo" alt="Company Logo">
        <div class="company-info">
            GEMARC ENTERPRISES INCORPORATED<br>
            1234 Sample Address, City, Country<br>
            Tel: (02) 123-4567 | Email: info@gemarc.com
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

    <div class="section" style="margin-top:40px;">
        <div style="font-weight:bold; text-align:center; margin-bottom:8px;">ALL ITEM SERVED WITH CALIBRATION CERTIFICATE</div>
        <div style="text-align:center; font-style:italic; font-size:13px; margin-bottom:8px;">***NOTHING FOLLOWS***</div>
        <ul style="font-size:12px; margin-bottom:10px;">
            <li>One-time FREE Preventive Maintenance.</li>
            <li>One-time FREE Calibration after installation. Includes Certificate of Calibration valid for one year only.</li>
            <li>GEI shall not be liable in any circumstances if the equipment's calibration is void and is lost within one year due to tampering in any form, transfer from one place to another and unauthorized use, etc.</li>
            <li>Re-calibration of the equipment must be charge to the customer.</li>
            <li>For Newly Purchased Item/Equipment that requires Calibration</li>
            <li>Issued CoC and sticker must be returned to GEI before re-issuance of the new COC and sticker.</li>
            <li>Any re-issuance of valid and official Certificate of Calibration together with related documents will be charged a minimum fee of Php70.00 per page.</li>
        </ul>
    </div>

    <div class="section" style="margin-top:20px;">
        <div style="font-weight:bold;">NOTE:</div>
        <ol style="font-size:12px; margin-bottom:10px;">
            <li><b>AVAILABILITY:</b> On-stock items subject for prior sales.</li>
            <li><b>PAYMENT:</b> Full payment. Bank transfer for stock items.</li>
            <li><b>WARRANTY:</b> (1) One Year warranty on parts and services for major equipment.</li>
            <li><b>VALIDITY:</b> 15 DAYS</li>
            <li><b>DELIVERY:</b> Free delivery within Metro Manila, all provincial delivery on Customer's account.</li>
            <li><b>QUALITY:</b> All products have passed through our GEI Quality Control and is guaranteed free from defect upon delivery.</li>
        </ol>
        <div style="font-size:12px; margin-bottom:10px;">
            7. Once we have received your Purchase Order and your failure to provide us a signed copy of these documents will be an acceptance on your part and all of the contents of the documents and the Terms and Conditions shall be deemed signed and approved.
        </div>
    </div>

    <div class="section" style="margin-top:30px;">
        <div style="font-size:13px;">Very truly yours,</div>
        <div style="font-size:13px; font-weight:bold; margin-bottom:30px;">GEMARC ENTERPRISES INCORPORATED</div>
        <div style="font-size:13px;">Noted by:</div>
        @php
            $employee = auth()->user();
        @endphp
        @if($employee)
            <div style="margin-top:10px; font-size:13px; font-weight:bold;">{{ $employee->name }}</div>
            <div style="font-size:12px;">{{ $employee->email }}</div>
        @endif
        <div style="margin-top:40px; font-size:11px;">Quotation for Goods &nbsp; <a href="https://www.gemarcph.com" style="color:#333; text-decoration:none;">www.gemarcph.com</a> &nbsp; Effectivity Date: {{ optional($quote->date)->format('d F Y') }}</div>
    </div>
</body>
</html>
