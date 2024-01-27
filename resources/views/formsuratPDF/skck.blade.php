<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .text-paragraf {
            line-height: 27px;
            text-align: justify;
        }

        .table-bio tr td {
            height: 30px;
        }

        .cup {
            text-align: center;
            width: 100%;
        }


        .table-kel {
            border-collapse: collapse;
            width: 100%;
        }

        .table-kel,
        .table-kel th {
            border: solid 1px black;
        }

        .table-kel,
        .table-kel td {
            border-right: solid 1px black;
        }

        .table-kel td {
            text-transform: capitalize
        }

        .text-center {
            text-align: center
        }

        .kop-header-text {
            font-size: 20px;
            font-weight: bold;
            line-height: 10px;
        }

        .sign {
            width: 200px;
            margin-top: 20px;
            text-align: center;
            position: absolute;
            right: 40px;
        }
    </style>
    <title>SURAT KETERANGAN CATATAN KEPOLISIAN</title>
</head>

<body style="margin-left: 40px; margin-right:30px;">
    <table class="cup">
        <tr>
            <td><img src="{{ asset('images/LogoDesa.png') }}" style="width: 70px;"></td>
            <td class="text-center">
                <p class="kop-header-text">PEMERINTAHAN KABUPATEN ROKAN HILIR</p>
                <p class="kop-header-text">KECAMATAN BANGKO PUSAKO</p>
                <p class="kop-header-text">KEPENGHULUAN PEMATANG IBUL</p>
                <div style="border-top: 1px solid black;">
                    <p style="font-size:14px; margin-bottom:8px; font-weight:bold; line-height:5px;">JL.LINTAS RIAU - SUMUT Kode Pos.28993</p>
                    <hr style="margin:1px;">
                    <hr style="border-top: 3px solid black; margin:0;">
                    <hr style="margin:1px;">
                </div>
            </td>
        </tr>
    </table>

    <h3 style="text-decoration:underline" class="text-center">SURAT KETERANGAN CATATAN KEPOLISIAN</h3>
    <p style="line-height: 1px " class="text-center">Nomor: {{ $pengajuan->nomor_surat }}</p><br>

    <div class="container">

        <p class="text-paragraf">Yang bertanda tangan dibawah ini Kepala Desa Pematang Ibul kecamatan Bangko Pusako
            kabupaten Rokan Hilir , Dengan ini menerangkan bahwa :</p>

        <table class="table-bio" style="margin-left: 40px;">
            <tr>
                <td>Nama Lengkap </td>
                <td style="text-transform:uppercase">: {{ $pengajuan->user->penduduk->nama_lengkap }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                @if($pengajuan->pejabat_ttd->jenis_kelamin = 'L')
                <td style="text-transform: capitalize">: Laki-laki</td>
                @else
                <td style="text-transform: capitalize">: Perempuan</td>
                @endif

            </tr>
            <tr>
                <td>Tempat tanggal lahir</td>
                <td style="text-transform: capitalize">: {{ $pengajuan->user->penduduk->tempat_lahir  }}, {{ Carbon\Carbon::parse($pengajuan->user->penduduk->tanggal_lahir)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td>Status Perkawinan</td>
                <td style="text-transform: capitalize">: {{ $pengajuan->user->penduduk->status }}</td>
            </tr>
            <tr>
                <td>Kewarganegaraan</td>
                <td style="text-transform: capitalize">: Indonesia</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td style="text-transform: capitalize">: {{ $agama  }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td style="text-transform: capitalize">: {{ $jenis_pekerjaan }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td style="text-transform: capitalize">: {{ $pengajuan->user->nik  }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td style="text-transform: capitalize">: {{ $pengajuan->user->penduduk->alamat  }}</td>
            </tr>
        </table>


        <p class="text-paragraf">Orang tersebut diatas adalah benar penduduk desa Pematang Ibul yang berdomisili di
            alamat diatas serta kami menerangkan bahwa orang tersebut benar Berkelakuan Baik dan
            Belum Pernah Tersangkut Perkara Polisi. Surat keterangan ini kami berikan untuk memenuhi
            salah satu persyaratan pengurusan Surat Keterangan Catatan Kepolisian (SKCK)</p>

        <p class="text-paragraf">Demikian surat keterangan ini dibuat dengan sebenarnya, agar dapat dipergunakan
            sebagaimana mestinya.</p>


        <div class="sign">
            <p style="line-height: 10%">Pematang Ibul, {{ Carbon\Carbon::today()->toDateString()}}</p>
            <p style="line-height: 10%; margin-bottom:0px;">{{ $pengajuan->pejabat_ttd->jabatan}}</p>

            <img width="90%" src="{{$pengajuan->pejabat_ttd->getFirstMediaUrl('signature')}}">

            <p style=" text-decoration:underline; margin-top:0px;"> {{$pengajuan->pejabat_ttd->nama_pejabat}}</p>
            <p style="line-height: 10%">NIP: {{$pengajuan->pejabat_ttd->nip}}</p>
        </div>
    </div>

</body>

</html>