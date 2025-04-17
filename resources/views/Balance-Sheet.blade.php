<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Essential POS</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 20;
            /* Remove default page margins */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        @media print {
            thead {
                display: table-header-group;
            }
        }

        th,
        td {
            border: 1px solid #000;
            padding: 3px;
            font-size: 12px;
            word-wrap: break-word;
            /* Allow long words to break and wrap to the next line */
            max-width: 100%;
            /* Limit maximum width of cells */
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
            /* Light gray background for even rows */
        }

        p {
            font-size: 12px;
        }

        .col-md-auto {
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: auto;
            max-width: 100%;
        }

        /* Add more p-* classes as needed */
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
    </style>

</head>

<body>
    <div class="wrapper"
        style="background: linear-gradient(rgba(255, 255, 255, 1), rgba(255, 255, 255, 1)),url('{{ public_path('dist/img/Asset 4.png') }}'); background-size: 100%; background-repeat: no-repeat; opacity: 0.2; 
    ">
        <!-- Content Wrapper. Contains page content -->
        <!-- title row -->
        <table style="border:none !important; margin:0px;">
            <tr>
                <td style="border:none !important; width:80%;">
                    <img src="{{ public_path('dist/img/logo.jpg') }}" style="width: 100%;height:150px;">
                </td>
            <tr>
                <!-- /.col -->
        </table>

        <table>
            <tr>
                <h4 class="text-center" style="margin-top: 0rem;margin-bottom:1.5rem;"><strong>Balance Sheet</strong>
                </h4>
            </tr>
            <tr>
                <hr style="border: 2px solid #1434A4;margin-top: 0px;margin-bottom: 10px; ">
            </tr>
        </table>

        <table>
            @if($branchlabel == null)
            <tr style="background-color:#fff !important;">
                <td style="border:none !important; margin:0px; padding:5px;">
                    <p style="padding:0px !important;margin:4px !important;text-align:center;"><strong>Date From:
                        </strong> {{ $datefrom }}</p>
                </td>
                <td style="border:none !important; margin:0px; padding:5px;">
                    <p style="padding:0px !important;margin:4px !important;text-align:center;"><strong>Date To:
                        </strong>{{ $dateto }}</p>
                </td>
            </tr>               
            @else
            <tr style="background-color:#fff !important;">
                <td style="border:none !important; margin:0px; padding:5px;">
                    <p style="padding:0px !important;margin:4px !important;text-align:center;"><strong>Date From:
                        </strong> {{ $datefrom }}</p>
                </td>
                <td style="border:none !important; margin:0px; padding:5px;">
                    <p style="padding:0px !important;margin:4px !important;text-align:center;"><strong>Date To:
                        </strong>{{ $dateto }}</p>
                </td>
                <td style="border:none !important; margin:0px; padding:5px;">
                    <p style="padding:0px !important;margin:4px !important;text-align:center;"><strong>Branch:
                        </strong>{{ $branchlabel }}</p>
                </td>
            </tr>         
            @endif
        </table>
        <div class="row">
            <table>
                <tr>
                    <hr class="text-center" style=" border: 1px solid #1434A4;margin-top: 10px;margin-bottom: 20px; ">
                </tr>
            </table>
        </div>


        <table>
            <thead>
                <th colspan="3" style="text-align: left;"><h2>Assets</h2></th>
            </thead>
            <tbody>
                <tr>
                    <td> Equipment</td>
                    <td class="text-right"> {{ $registeredequipment }}</td>
                    <td></td>
                </tr>
                @foreach ($paymentmethods as $accounts)
                <tr>
                    <td>{{ $accounts->PaymentMethod }}</td>
                    <td class="text-right">{{ $accounts->total_balance }}</td>
                    <td></td>
                </tr>
                @endforeach
                <tr>
                    <td> Stock</td>
                    <td class="text-right">{{ $invetory }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Accounts Receivable</td>
                    <td class="text-right"> {{ $accountsreceivable }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>  Supplier Account Balance</td>
                    <td class="text-right">{{ $registeredsupplieraccounts }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h3>Total Assets</h3>
                    </td>
                    <td class="text-right">
                        <h3>{{$registeredsupplieraccounts+$accountsreceivable + $invetory + $registeredequipment + $paymentmethods->sum('total_balance') }}</h3>
                    </td>
                </tr>

                <tr>
                    <td colspan="3">
                        <h2>Total Equity & Liability</h2>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <h3><u>Liability</u></h3>
                    </td>
                </tr>
                <tr>
                    <td>Accounts Payable</td>
                    <td class="text-right">   {{ $registeredaccountspayable }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td> Client Account Balance</td>
                    <td class="text-right">   {{ $registeredclientaccounts }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <h4>Total Liability</h4>
                    </td>
                    <td class="text-right">
                        <h4>{{$registeredclientaccounts +$registeredaccountspayable}}</h4>
                    </td>
                    <td></td>
                </tr>

                <tr>
                    <td colspan="3">
                        <h3><u>Equity</u></h3>
                    </td>
                </tr>
                <tr>
                    <td>Capital</td>
                    <td class="text-right">  {{ $registeredcapital }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>  Retained Earnings</td>
                    <td class="text-right"> {{ $carriedforwards }}</td>
                    <td></td>
                </tr>
                
                <tr>
                    <td> Net Income</td>
                    <td class="text-right"> {{ ($registeredotherincomes + $registeredfeescollection)-($registereddevidends+$registeredexpenses + $registeredsalary+$registereddiscounts) }}</td>
                    <td></td>
                </tr>
                    <td>
                        <h4>Total Equity</h4>
                    </td>
                    <td class="text-right">
                        <h4>{{ ($registeredcapital +$carriedforwards+$registeredotherincomes + $registeredfeescollection)-($registereddevidends+$registeredexpenses + $registeredsalary+$registereddiscounts) }}</h4>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h3>Total Equity & Liability</h3>
                    </td>
                    <td class="text-right">
                        <h3>{{ ($registeredclientaccounts +$registeredaccountspayable+$registeredcapital +$carriedforwards+$registeredotherincomes + $registeredfeescollection)-($registereddevidends+$registeredexpenses + $registeredsalary+$registereddiscounts)}}</h3>
                    </td>
                </tr>
            </tbody>
        </table>


        <!-- /.content -->
    </div>
</body>

</html>
