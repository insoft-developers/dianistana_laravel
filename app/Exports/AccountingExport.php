<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class AccountingExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $awal;
    protected $akhir;
    protected $payment;
    protected $penyelia;

    function __construct($awal, $akhir, $payment, $penyelia) {
            $this->awal = $awal;
            $this->akhir = $akhir;
            $this->payment = $payment;
            $this->penyelia = $penyelia;
    }

    public function view(): View
    {
       
        $ending = strtotime("+1 day", strtotime($this->akhir));
        $sampai = date('Y-m-d', $ending);
        if(empty($this->awal) && empty($this->akhir)) {
            $bln = date('m');
            $thn = date('Y');
            $start = $thn.'-'.$bln.'-01';
            $end = $thn.'-'.$bln.'-31';
            $query = DB::table('payment_details')
                                ->select('payment_details.*', 'payments.payment_name', 'payments.due_date','payments.periode')
                                ->join('payments', 'payments.id', '=', 'payment_details.payment_id', 'left')
                                ->join('users', 'users.id', '=', 'payment_details.user_id', 'left')
                                ->where('payments.payment_type', 1)
                                ->where('payment_details.payment_status', 'PAID')
                                ->where('payment_details.paid_at', '>=', $start)
                                ->where('payment_details.paid_at', '<=', $end)
                                ->orderBy('payment_details.paid_at', 'asc');
                                
        } else {
            $query = DB::table('payment_details')
                                ->select('payment_details.*', 'payments.payment_name', 'payments.due_date','payments.periode')
                                ->join('payments', 'payments.id', '=', 'payment_details.payment_id', 'left')
                                ->join('users', 'users.id', '=', 'payment_details.user_id', 'left')
                                ->where('payments.payment_type', 1)
                                ->where('payment_details.payment_status', 'PAID')
                                ->where('payment_details.paid_at', '>=', $this->awal)
                                ->where('payment_details.paid_at', '<=', $sampai)
                                ->orderBy('payment_details.paid_at', 'asc');
                                
        }

        if(! empty($this->payment)) {
            $query->where('payment_details.payment_method', $this->payment);
        }
        if(! empty($this->penyelia)) {
            $query->where('users.penyelia', $this->penyelia);
        }
        
        $data = $query->get();
        return view('admins.report.iuran.export_accounting', [
            'data' => $data, 'awal'=> $this->awal, 'akhir' => $this->akhir, 'payment' => $this->payment, 'penyelia'=> $this->penyelia
        ]);
    }
}
