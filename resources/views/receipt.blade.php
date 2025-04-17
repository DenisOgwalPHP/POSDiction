<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Receipt</title>
    <style>
        @page { margin: 2px; }
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            width: 100%;
            margin: 0 !important; /* Removed default margin */
            padding: 0 !important; /* Removed default padding */
        }

        .receipt {
            width: 100%;
            margin: 0 !important; /* Center the receipt horizontally */
            padding: 0 !important;
        }

        .header,
        .footer {
            text-align: center;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 2px;
            font-size: 12px;
            word-wrap: break-word;
            max-width: 100%;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }

        .center-container {
            width: 100%;
            text-align: center;
        }

        .center-container hr {
            border: 2px solid #1434A4;
            margin: 0px 0px 10px 0px;
            width: 100%;
        }
        .center-container img {
            width: 100%;
            height: auto; /* This ensures the aspect ratio is maintained */
        }
        .table-container {
            width: 100%;
            display: flex;
            justify-content: center; /* Center the table horizontally */
        }
    </style>
</head>

<body style="margin: 0 !important;padding: 0 !important;">
    <div class="receipt">
        <div class="center-container">
            <img src="{{ public_path('dist/img/logo.jpg') }}">
        </div>

        <div class="center-container">
            <h4 class="text-center" style="margin-top: 0rem; margin-bottom: 1rem;"><strong>Receipt</strong></h4>
            <hr>
        </div>

        <div class="table-container">
                <table style="width: 100%">
                    <thead>
                        <th>Item Name</th>
                        <th>Model</th>
                        <th>Qty</th>
                        <th>Price</th>
                    </thead>
                    <tbody>
                        @if ($salesitems->count() > 0)
                            @foreach ($salesitems as $item)
                                <tr>
                                    <td>{{ $item['soldproduct']['ProductName'] }}</td>
                                    <td>{{ $item['soldproduct']['Weight'] }}</td>
                                    <td>{{ $item['Quantity'] }}</td>
                                    <td>{{ $item['Price'] * $item['Quantity'] }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="table-container" style="margin-top: 10px;">
        <table style="width: 100%;padding:10px;">
            <tr style="width: 100%">
                <td style=" margin:0px !important;padding:5px !important;width:30%"><strong>Total</strong></td>
                <td
                    style="text-align:right;margin:0px !important;padding:5px !important; width: 70%">
                    {{ $salesfinal->TotalAmount }}
                </td>
            </tr>

            <tr style="background-color:#fff !important;">
                <td style="margin:0px !important;padding:5px !important;width:30%"><strong>Discount</strong></td>
                <td style="text-align:right;margin:0px !important;padding:5px !important;width:30%">
                    {{ $salesfinal->Discount }}
                </td>
            </tr>

            <tr style="width: 100%">
                <td style="margin:0px !important;padding:5px !important;width:30%"><strong>Cash</strong></td>
                <td
                    style="text-align:right;margin:0px !important;padding:5px !important;width:70%">
                    {{ $salesfinal->Cash }}
                </td>
            </tr>

            <tr style="background-color:#fff !important;">
                <td style="margin:0px !important;padding:5px !important;width:30%"><strong>Balance</strong></td>
                <td
                    style="text-align:right;margin:0px !important;padding:5px !important;width:70%">
                    {{ $salesfinal->Duepayment }}
                </td>
            </tr>
        </table>
        </div>

        <p class="text-center">Thankyou, Please Come Again</p>
    </div>
</body>
  
</html>
