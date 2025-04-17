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
            padding: 8px;
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
                <h4 class="text-center" style="margin-top: 0rem;margin-bottom:1.5rem;"><strong>Trial Balance</strong>
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
                <th colspan="2" style="text-align: left;">Account</th>
                <th  style="text-align: center;">DR</th>
                <th  style="text-align: center;">CR</th>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2"> Capital</td>
                    <td class="text-right"></td>
                    <td class="text-right">{{ number_format($registeredcapital)}}</td>
                </tr>
                @foreach ($paymentmethods as $accounts)
                <tr>
                    <td colspan="2">{{ $accounts->PaymentMethod }}</td>
                    <td class="text-right">{{ number_format($accounts->total_balance) }}</td>
                    <td class="text-right"></td>
                   
                </tr>
                @endforeach
                <tr>
                    <td colspan="2">Sales Revenue</td>
                    <td class="text-right"></td>
                    <td class="text-right">{{ number_format($registeredfeescollection) }}</td>
                </tr>
                <tr>
                    <td colspan="2">Sales Discounts</td>
                    <td class="text-right"> {{ number_format($registereddiscounts) }}</td>
                    <td class="text-right"></td>     
                </tr>
                <tr>
                    <td colspan="2">Other Incomes</td>
                    <td class="text-right"></td>
                    <td class="text-right"> {{ number_format($registeredotherincomes) }}</td>
                </tr>
                <tr>
                    <td colspan="2">Client Account</td>
                    <td class="text-right"></td>
                    <td class="text-right">  {{ number_format($registeredclientaccounts) }}</td>
                </tr>
                <tr>
                    <td colspan="2">Supplier Account</td>
                    <td class="text-right"> {{ number_format($registeredsupplieraccounts) }}</td>
                    <td class="text-right"></td>     
                </tr>
                <tr>
                    <td colspan="2">Equipment</td>
                    <td class="text-right"> {{ number_format($registeredequipment) }}</td>
                    <td class="text-right"></td>     
                </tr>
                <tr>
                    <td colspan="2">Invetory</td>
                    <td class="text-right"> {{ number_format($invetory) }}</td>
                    <td class="text-right"></td>     
                </tr>
                <tr>
                    <td colspan="2">Salary</td>
                    <td class="text-right"> {{ number_format($registeredsalary) }}</td>
                    <td class="text-right"></td>     
                </tr>
                <tr>
                    <td colspan="2">Expenses</td>
                    <td class="text-right"> {{ number_format($registeredexpenses) }}</td>
                    <td class="text-right"></td>     
                </tr>
                <tr>
                    <td colspan="2"> Devidends</td>
                    <td class="text-right">  {{ number_format($registereddevidends)}}</td>
                    <td class="text-right"></td>     
                </tr>
                <tr>
                    <td colspan="2"> Accounts Payable</td>
                    <td class="text-right"></td>
                    <td class="text-right"> {{ number_format($registeredaccountspayable) }}</td>     
                </tr>
                <tr>
                    <td colspan="2"> Accounts Receivable</td>
                    <td class="text-right"> {{ number_format($accountsreceivable) }}</td>
                    <td class="text-right"></td>     
                </tr>
                <tr>
                    <td colspan="2">Balance B/F</td>
                    <td class="text-right"></td>
                    <td class="text-right"> {{number_format( $carriedforwards )}}</td>     
                </tr>
                
                <tr> <td colspan="4"></td></tr>
                <tr>
                    <td colspan="2"><Strong>TOTAL</Strong></td>
                    <td class="text-right"><Strong>{{number_format($accountsreceivable  + $registereddevidends+$registeredexpenses + $registeredsalary+ $registeredsupplieraccounts + $invetory + $registeredequipment  + $registereddiscounts + $paymentmethods->sum('total_balance')) }}</Strong></td>
                    <td class="text-right"><Strong> {{number_format( $carriedforwards+$registeredaccountspayable +  $registeredotherincomes + $registeredfeescollection + $registeredcapital+ $registeredclientaccounts )}}</Strong></td>     
                </tr>
            </tbody>
        </table>


        <!-- /.content -->
    </div>
</body>

</html>
