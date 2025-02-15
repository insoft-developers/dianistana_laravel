@php
function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}    

@endphp

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
     <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />  -->
    <title>Kwitansi {{ $data->invoice }}</title>
    <style>
        .clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 90px;
}

h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background: url({{ asset('template/images/dimension.png') }});
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: right;
  text-align: right;
}

#project div,
#company div {
  white-space: nowrap;        
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table td.grand {
  border-top: 1px solid #5D6975;;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}

@media print {

  #btn-print{
    display: none;
  }

}

</style>

     
  </head>
  <body id="body-data" onload="window.print();">
    <header class="clearfix">
      @php
        $user = \App\Models\User::findorFail($data->user_id);
        if($user->penyelia == "SDP") {
            $com = "PT. SARANA DIAN PROPERTI";
        } else {
            $com = "PT. DIAN MEGA SARANA INDONESIA";
        }

      @endphp


      <div id="logo">
        <img src="{{ asset('template/images/dian.png') }}">
      </div>
      <h1>PAYMENT RECEIPT <br><small>No. {{ $data->invoice }}</small></h1>
      <div id="company" class="clearfix">
        <div>{{ $com }}</div>
        <div>{{ $setting->address }}</div>
        <div>{{ $setting->phone }}</div>
        <div><a href="mailto:company@example.com">{{ $setting->email }}</a></div>
      </div>
      <div id="project">
        
        <div><span>RECEIVED FROM  :</span></div>
        <div><span>NAME</span> {{ $user->name }}</div>
        <div><span>BLOK/NO</span> {{ $user->blok }} / {{ $user->nomor_rumah }}</div>
        <div><span>EMAIL</span> <a href="mailto:john@example.com">{{ $user->email }}</a></div>
        <div><span>DATE</span> {{ date('d F Y', strtotime($data->paid_at)) }}</div>
        
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
           
            <th class="desc">DESCRIPTION</th>
            <th>PRICE</th>
            <th>QTY</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <tr>
           
            <td class="desc"><strong>{{ $payment->payment_name }}</strong> <br> {{ $payment->payment_desc }}</td>
            <td class="unit">{{ number_format($data->amount) }}</td>
            <td class="qty">1</td>
            <td class="total">{{ number_format($data->amount) }}</td>
          </tr>
          
          <tr>
            <td colspan="3">SUBTOTAL</td>
            <td class="total">Rp. {{ number_format($data->amount) }}</td>
          </tr>
          
          <tr>
            <td class="grand total">Terbilang : {{ ucwords(terbilang($data->amount)) }} Rupiah</td>
            <td class="grand total" colspan="2">GRAND TOTAL</td>
            <td class="grand total" style="font-size: 16px;width:120px !important"><strong>Rp. {{ number_format($data->amount) }}</strong></td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">Paid By {{ $data->payment_method }} via {{ $data->payment_channel }}</div>
      </div>
    </main>
    <footer>

      Invoice was created on a computer and is valid without the signature and seal.
      <div class=""><button id="btn-print" style="margin-top: 30px;height: 130px;width:500px;font-size: 60px;background-color:green;color:white;border-radius:30px;" class="button">PRINT</button></div>

    </footer>
   
   <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

   <script>
      $("#body-data").click(function(){
        window.print();
      })

   </script>
  
  </body>
</html>