<?php

namespace App\Http\Livewire;

use Dompdf\Options;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\BranchBalanceModel;
use Illuminate\Support\Facades\Auth;
use App\Models\ClientAccountModel;
use App\Models\Notifications;
use App\Models\PaymentMethodModel;
use App\Models\ProductModel;
use App\Models\PurchaseModel;
use App\Models\SalesFinalModel;
use App\Models\SalesModel;
use Illuminate\Support\Facades\Storage;
use Cart;
use App\Models\User;

use Livewire\Component;
use PhpOffice\PhpSpreadsheet\Worksheet\AutoFit;
use PhpParser\Node\Stmt\Foreach_;

class DashboardComponent extends Component
{
    public $message;
    public $currentuser;
    public $messageduser;
    public $user_id;
    public $selldicount;
    public $sellcash;
    public $barcode;
    public $sellbalance;
    public $SerialNo;
    public $sellduepayment;
    public $selltotalamount;
    public $selldiscounttotal;
    public $sellpaymentmethod;
    public $sellaccount;
    public $sellaccounts;
    public $sellpaymentmethods;
    public $sellpaymentmethodselected;

    protected $listeners = ['refreshComponent' => '$refresh'];
    
    public function getSellcashDisabledProperty()
    {
        return $this->sellpaymentmethodselected && $this->sellpaymentmethodselected->PaymentMethod == "Client Account";
    }
    public function getSelldicountDisabledProperty()
    {
        return $this->sellpaymentmethodselected && $this->sellpaymentmethodselected->PaymentMethod == "Client Account";
    }
    public function updatedsellpaymentmethod($value)
    {
        $this->sellpaymentmethodselected = PaymentMethodModel::find($value);
        if ($this->sellpaymentmethodselected->PaymentMethod == "Client Account") {
            $this->sellcash = 0;
            if (Cart::instance('cart')->count() > 0) {
                $carttotaladdition = 0;
                foreach (Cart::instance('cart')->content() as $item) {

                    $carttotaladdition += $item->qty * $item->price;
                }
                if ($this->selldicount == '') {
                    $this->selldicount = 0;
                }
                $this->selltotalamount = $carttotaladdition;
                $this->sellduepayment = $carttotaladdition - $this->sellcash;
                $this->selldiscounttotal = $carttotaladdition - ($this->selldicount);
                if ($this->sellcash != '') {
                    $this->sellbalance = $this->sellcash - $this->selldiscounttotal;
                }
            }
        }
    }
    public function updatedsellcash()
    {
        if (!empty($this->sellcash)) {
            if (Cart::instance('cart')->count() > 0) {
                $carttotaladdition = 0;
                foreach (Cart::instance('cart')->content() as $item) {

                    $carttotaladdition += $item->qty * $item->price;
                }
              
                $this->selltotalamount = $carttotaladdition;
                if ($this->sellcash != '') {
                    $this->sellbalance = $this->sellcash - $this->selltotalamount;
                }
            }
        }
    }
    public function updatedbarcode()
    {
        /*if ($this->barcode == "n/a" || $this->barcode == "N/a" || $this->barcode == "N/A") {
        } else {*/
            $productdetails = ProductModel::where('Barcode', $this->barcode)->first();
            if ($productdetails) {
                $itemBalances = BranchBalanceModel::where('ProductRefer', $productdetails->id)->where('Branch', Auth::user()->Branch)->first();
                if ($itemBalances->ItemBalance > 0) {
                    Cart::instance('cart')->add([
                        'id' => $productdetails->id,
                        'name' => $productdetails->ProductName,
                        'qty' => 1,
                        'price' => $productdetails->SellingPrice,
                        'options' => [
                            'cost' => $productdetails->PurchaseCost,
                            'stockid' => $itemBalances->id,
                        ]
                    ])->associate('App\Models\BranchBalanceModel');
                    $this->emitTo('Dashboard', 'refreshComponent');
                    $carttotaladdition = 0;
                    if (Cart::instance('cart')->count() > 0) {
                        foreach (Cart::instance('cart')->content() as $item) {
    
                            $carttotaladdition += $item->qty * $item->price;
                        }
                        $this->selltotalamount = $carttotaladdition;
                        $this->sellduepayment = $carttotaladdition;
                        $this->selldiscounttotal = $carttotaladdition;
                        $this->selldicount = 0;
                    }
                } else {
                    session()->flash('itemlessmessage', 'There is No Stock to Complete The Sale of ' . $productdetails->ProductName);
                }
            }
        //}
    }
    public function handleButtonClick($product_id, $product_name, $product_price, $product_cost, $stock_id)
    {
        try {
            if (Cart::instance('cart')->count() > 0) {
                return;
            }
            $itemBalances = BranchBalanceModel::where('ProductRefer', $product_id)->where('Branch', Auth::user()->Branch)->first();
            if ($itemBalances->ItemBalance > 0) {
                Cart::instance('cart')->add([
                    'id' => $product_id,
                    'name' => $product_name,
                    'qty' => 1,
                    'price' => $product_price,
                    'options' => [
                        'cost' => $product_cost,
                        'stockid' => $stock_id,
                        'stockmodel' => $itemBalances->Weight,
                    ]
                ])->associate('App\Models\BranchBalanceModel');
                $this->emitTo('Dashboard', 'refreshComponent');
                $carttotaladdition = 0;
                if (Cart::instance('cart')->count() > 0) {
                    foreach (Cart::instance('cart')->content() as $item) {

                        $carttotaladdition += $item->qty * $item->price;
                    }
                    $this->selltotalamount = $carttotaladdition;
                    $this->sellduepayment = $carttotaladdition;
                }
            } else {
                session()->flash('itemlessmessage', 'There is No Stock to Complete The Sale of ' . $product_name);
            }
            //return redirect()->route('Dashboard');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function handleButtonClick2($client_id, $client_name, $client_nin, $client_phone)
    {
        try {
            if (Cart::instance('clientcart')->count() > 0) {
                return;
            }
                Cart::instance('clientcart')->add([
                    'id' => $client_id,
                    'name' => $client_name,
                    'qty' => 1,
                    'price' => 1,
                    'options' => [
                        'nin' => $client_nin,
                        'phone' => $client_phone,
                    ]
                ])->associate('App\Models\ClientAccountModel');
                $this->emitTo('Dashboard', 'refreshComponent');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function updateQuantity($rowId, $newQty)
    {
        try {

            $newQty = (int)$newQty;
            if ($newQty > 0) {
                Cart::instance('cart')->update($rowId, $newQty);
                $this->emitTo('Dashboard', 'refreshComponent');
                $carttotaladdition = 0;
                if (Cart::instance('cart')->count() > 0) {
                    foreach (Cart::instance('cart')->content() as $item) {

                        $carttotaladdition += $item->qty * $item->price;
                    }
                    $this->selltotalamount = $carttotaladdition;
                    $this->sellduepayment = $carttotaladdition;
                    $this->selldiscounttotal = $carttotaladdition;
                    $this->selldicount = 0;
                    if ($this->sellcash != '') {
                        $this->sellbalance = $this->sellcash - $this->selldiscounttotal;
                    }
                }
            } else {
                return redirect()->back()->with('error', 'Quantity must be greater than zero.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroyitem($rowId)
    {
        try {
            Cart::instance('cart')->remove($rowId);
            $this->emitTo('Dashboard', 'refreshComponent');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroyitems()
    {
        try {
            Cart::instance('cart')->destroy();
            $this->emitTo('Dashboard', 'refreshComponent');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function destroyitem2()
    {
        try {
            Cart::instance('clientcart')->destroy();
            $this->emitTo('Dashboard', 'refreshComponent');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function mount()
    {
        $this->sellaccounts = ClientAccountModel::where('Branch', Auth::user()->Branch)->orderBy('id', 'ASC')->get();
        $this->sellpaymentmethods = PaymentMethodModel::where('Branch', Auth::user()->Branch)->orderBy('id', 'ASC')->get();
    }
    public function AddSale()
    {
        $this->validate([
            'sellcash' => 'required',
            'sellbalance' => 'required',
            'selltotalamount' => 'required',
            'sellpaymentmethod' => 'required',
        ]);
        try {
                if (Cart::instance('clientcart')->count() > 0) {
                    foreach (Cart::instance('clientcart')->content() as $item) {
                    $finalsale = new SalesFinalModel();
                    $finalsale->Discount = 0;
                    $finalsale->Cash = $this->sellcash;
                    $finalsale->Balance  = $this->sellbalance;
                    $finalsale->Duepayment  =0;
                    $finalsale->TotalAmount  = $this->selltotalamount;
                    $finalsale->DiscountedTotal  =$this->selltotalamount;
                    $finalsale->PaymentMethod  = $this->sellpaymentmethod;
                    $finalsale->ClientAccount = $item->id;
                    $finalsale->User_id  = Auth::user()->id;
                    $finalsale->Branch = Auth::user()->Branch;
                    $finalsale->save();
                    $savedpaymentid = $finalsale->id;

                    
                    
                    foreach (Cart::instance('cart')->content() as $item2) {
                        $sale = new SalesModel();
                        $sale->ProductRefer = $item2->id;
                        $sale->Quantity = $item2->qty;
                        $sale->Price  = $item2->price;
                        $sale->Cost  = $item2->options->cost;
                        $sale->Payment_id  = $savedpaymentid;
                        $sale->Account_id  = $item->id;
                        $sale->Cleared  = 'Cleared';
                        $sale->User_id  = Auth::user()->id;
                        $sale->Branch = Auth::user()->Branch;
                        $sale->save();

                        $clientreceived=ClientAccountModel::find($item->id);
                        $clientreceived->Received="Yes";
                        $clientreceived->Model=$item2->options->stockmodel;
                        $clientreceived->SerialNo=$this->SerialNo;
                        $clientreceived->save();

                        $itemBalances = BranchBalanceModel::where('ProductRefer', $item2->id)->where('Branch', Auth::user()->Branch)->first();
                        if ($itemBalances) {
                            $branchbalance = BranchBalanceModel::find($item2->options->stockid);
                            $branchbalance->ItemBalance = $itemBalances->ItemBalance - $item2->qty;
                            $branchbalance->save();
                        }
                        $purchaselot=PurchaseModel::where('ProductName', $item2->id)->where('QuantityLeft','>',0)->orderBy('id','DESC')->first();
                        if($purchaselot){
                            $updatepurchase=PurchaseModel::find($purchaselot->id);
                            $updatepurchase->QuantityLeft=$purchaselot->QuantityLeft-$item2->qty;
                            $updatepurchase->save();
                        }

                        $accountbal = PaymentMethodModel::find( $this->sellpaymentmethod);
                        $accountbal->Balance = $accountbal->Balance +($item2->price * $item2->qty);
                        $accountbal->save();
                    }

                  
                }
                   
                    $salesfinal = SalesFinalModel::find($savedpaymentid);
                    $salesitems = SalesModel::where('Payment_id', $savedpaymentid)->with('soldproduct')->get();
                    $data = [
                        'salesfinal' => $salesfinal,
                        'salesitems' =>  $salesitems,
                    ];

                   /* $pdf = Pdf::loadView('receipt', $data);
                    $pdf->setPaper([0, 0, 226, 400], 'portrait');
                    $options = [
                        'isHtml5ParserEnabled' => true,
                        'isRemoteEnabled' => true,
                    ];

                    foreach ($options as $key => $value) {
                        $pdf->set_option($key, $value);
                    }

                    $pdfName = $savedpaymentid . '.pdf';
                    $filePath = 'documents/posreceipts/' . $pdfName;
                    Storage::disk('local')->put($filePath, $pdf->output());
                    Cart::instance('cart')->destroy();
                    Cart::instance('clientcart')->destroy();
                    $this->emit('receiptgenerated');
                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->output();
                    }, $pdfName);*/
                    Cart::instance('cart')->destroy();
                    Cart::instance('clientcart')->destroy();
                }
                session()->flash('sellitems', 'Sale has been Added Successfully');
                return redirect()->route('Dashboard');

        } catch (\Exception $e) {
            \Log::error("Sale Error: " . $e->getMessage());
            $this->dispatchBrowserEvent('sale-error', [
                'message' => 'You have already sold this item to this person. You cannot sell it again.'
            ]);
            return redirect()->back();
        }
    }
    public function render()
    {
        try {
            if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                $users = User::all();
                $currentcustomers = ClientAccountModel::where('Received','No')->get();
            } else {
                $users = User::where('Branch', Auth::user()->Branch)->get();
                $currentcustomers = ClientAccountModel::where('Branch', Auth::user()->Branch)->where('Received','No')->get();
            }
            if (auth()->check()) {
                $registeredNotifications = Notifications::whereNotIn('id', function ($query) {
                    $query->select('NotificationID')->from('notificationread');
                })->where(function ($query) {
                    $query->where('PostedUser', Auth::user()->id)->orWhere('PostedFor', 'Staff')->orWhere('PostedFor', 'All');
                })
                    ->orderby('id', 'DESC')->get();
                if ($registeredNotifications->count() > 0) {
                    session()->flash('notification', 'Thanks, Your message has been sent successfully ');
                }
            } else {
                $registeredNotifications = Notifications::whereNotIn('id', function ($query) {
                    $query->select('NotificationID')->from('notificationread');
                })->where(function ($query) {
                    $query->Where('PostedFor', 'Staff')->orWhere('PostedFor', 'All');
                })
                    ->orderby('id', 'DESC')->get();
                if ($registeredNotifications->count() > 0) {
                    session()->flash('notification', 'Thanks, Your message has been sent successfully ');
                }
            }

            $stocksforsale = BranchBalanceModel::where('Branch', Auth::user()->Branch)->get();
            $expiringproduct=PurchaseModel::whereDate('ExpiryDate','<=', now()->toDateString())->get();
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.dashboard-component', ['currentcustomers'=> $currentcustomers,'expiringproduct'=>$expiringproduct,'stocksforsale' => $stocksforsale, 'registeredNotifications' => $registeredNotifications, 'users' => $users])->layout('layouts.base');
    }
}
