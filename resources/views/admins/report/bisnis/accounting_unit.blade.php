<!DOCTYPE html>
<html>
<head>
	<title>Print Laporan Keuangan</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/template/main/img/dianlogo.png') }}">
    <link href="{{ asset('') }}assets/template/src/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <meta
			name="viewport"
			content="width=device-width, initial-scale=1"
		/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
         .img-detail{
            width: 141px;
            height: 176px;
            object-fit: cover;
            border-radius: 5px;
        }
        table td, tfoot th, .table-title th{
            border: 1px solid black;
            border-collapse: collapse;
            padding: 3px;
        }


        @media screen {
            .btn-pdf{
                position: absolute;
                color: white;
                top: 19px;
                background: red;
                font-weight: bold;
                margin-left: 86px;
            }
            .btn-print{
                position: absolute;
                color: white;
                top: 19px;
                background: orange;
                font-weight: bold;
            }
            .btn-excel{
                position: absolute;
                color: white;
                top: 19px;
                background: green;
                font-weight: bold;
                margin-left: 152px;
            }
            body {
                font-family: 'Courier New', Courier, monospace;
            }
            table td{
                font-size: 13px;
            }

            .logo-atas{
                width: 40px;
                height: 40px;
                position: absolute;
                left: 250px;
                top: -15px;
            }
            table.print-friendly tr td, table.print-friendly tr th {
                    page-break-inside: avoid;
                }

        }

            /* print styles */
            @media print {
                .btn-print, .btn-excel, .btn-pdf {
                    display: none;
                }
                body {
                    margin: 0;
                    color: #000;
                    background-color: #fff;
                }
                table td{
                    font-size: 13px;
                }
                
                .logo-atas{
                    width: 40px;
                    height: 40px;
                    position: absolute;
                    left: 250px;
                    top: -15px;
                }
                table.print-friendly tr td, table.print-friendly tr th {
                        page-break-inside: avoid;
                
                }

            }
    </style>
    <script
    src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
    integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
></script>
</head>
<!-- <body onload="window.print();"> -->
<body id="print-area">     
    <div class="row">
    <div class="col-md-12">
    <div class="card">
    <div class="card-body">
    <table class="table table-striped">
        <thead>
           
            <tr>
                <th>NOMER</th>
                <th>TGLBAYAR,D</th>
                <th>NO_BUKTI,C,10</th>
                <th>TERIMA_RP,N,16,2</th>
                <th>BLOK,C,11</th>
                <th>UTK1,C,90</th>
                <th>UTK2,C,90</th>
                <th>NAMA_DARI,C,90</th>

            </tr>
        </thead>
        <tbody>
            @php
            $no= 0;
            $total = 0;
            @endphp
            @foreach($data as $key)
            @php
            $no++;
            $total = $total + $key->total_price;
            $users = \App\Models\User::where('id', $key->user_id);
            if($users->count() > 0) {
                $user = $users->first();
                $user_name = $user->name;
                $penyelia = $user->penyelia;
                $info = $user->blok.'-'.$user->nomor_rumah;
                $info2 = 'Blok='.$user->blok.'-'.$user->nomor_rumah.',luas tanah='.$user->luas_tanah.',daya listrik='.$user->daya_listrik;
                
            } else {
                $user_name = 'no-data';
                $penyelia = '';
                $info = "";
            }
            @endphp
            <tr>
            <td>{{ $no }}</td>
            <td style="white-space:nowrap;">{{ date('d/m/y', strtotime($key->paid_at)) }}</td>
            <td>{{ $key->invoice }}</td>
            <td style="text-align: right;white-space:nowrap;">{{ number_format($key->total_price, 2) }}</td>
            <td>{{ $info }}</td>
            <td>{{ $key->name_unit }}</td>
            <td>{{ $info2 }}</td>
            <td>{{ $user_name }}</td>
            
           
            </tr>
            @endforeach
    </tbody>
    </table>


    </div> 
    </div> 
    </div>
    </div>

</body>
</html>