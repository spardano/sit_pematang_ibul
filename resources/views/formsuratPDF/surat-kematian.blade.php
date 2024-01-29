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
    <title>Surat Keterangan Kematian</title>
</head>

<body style="margin-left: 40px; margin-right:30px; margin-bottom:0px; margin-top:0px;">
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

    <h3 style="text-decoration:underline" class="text-center">SURAT KETERANGAN KEMATIAN</h3>
    <p style="line-height: 1px " class="text-center">Nomor: {{ $pengajuan->nomor_surat }}</p><br>

    <p style="line-height: 10px; margin-bottom:0px;">Yang bertanda tangan dibawah ini, Saya</p><br>

    <table cellpadding="3">
        <tr>
            <td>Nama Lengkap</td>
            <td style="text-transform: UPPERCASE">: {{ $pengajuan->pejabat_ttd->nama_pejabat }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td style="text-transform: UPPERCASE">: {{ $pengajuan->pejabat_ttd->getJenisKelaminFormattedAttribute() }}</td>
        </tr>
        <tr>
            <td>jabatan</td>
            <td style="text-transform: UPPERCASE">: {{ $pengajuan->pejabat_ttd->jabatan}}</td>
        </tr>
    </table>

    <p style="line-height: 100%" class="text-paragraf">Menerangkan Dengan Sebenarnya Bahwa :</p>
    <table cellpadding="3">
        <tr>
            <td>Nama</td>
            <td style="text-transform:capitalize">: {{ $pengajuan->user->penduduk->nama_lengkap }}</td>
        </tr>

        <tr>
            <td>Tempat/Tgl.Lahir</td>
            <td style="text-transform:capitalize">: {{ $pengajuan->user->penduduk->tempat_lahir  }}, {{ Carbon\Carbon::parse($pengajuan->user->penduduk->tanggal_lahir)->format('d-m-Y') }}</td>
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
            <td>Status Perkawinan</td>
            <td style="text-transform:capitalize">: {{ $pengajuan->user->penduduk->status }}</td>
        </tr>

        <tr>
            <td>Agama</td>
            <td style="text-transform:capitalize">: {{ $agama  }}</td>
        </tr>

        <tr>
            <td>Pekerjaan</td>
            <td style="text-transform:capitalize">: {{ $jenis_pekerjaan  }}n</td>
        </tr>

        <tr>
            <td>Alamat</td>
            <td style="text-transform:capitalize">: {{ $pengajuan->user->penduduk->alamat }}</td>
        </tr>

    </table>


    <p class="text-paragraf">Orang yang namanya tersebut diatas adalah benar warga desa Pematang Ibul dan telah
        meninggal dunia , yaitu :
    </p>

    <table cellpadding="3">

        <tr>
            <td>Hari</td>
            <td style="text-transform: UPPERCASE">: {{ $field_data->hari }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td style="text-transform: UPPERCASE">: {{ $field_data->tanggal_meninggal }}</td>
        </tr>
        <tr>
            <td>Meninggal Karena</td>
            <td style="text-transform: UPPERCASE">: {{ $field_data->meninggal_karena }}</td>
        </tr>
        <tr>
            <td>Di</td>
            <td style="text-transform: UPPERCASE">: {{ $field_data->lokasi }}</td>
        </tr>

    </table>

    <p class="text-paragraf" style="margin-bottom: 0px;">Demikian surat keterangan ini kami buat dengan sebenarnya untuk dapat dipergunakan
        sebagaimana mestinya.
    </p>


    <div class="sign">

        <p style="line-height: 10%; z-index: -1000;">Pematang Ibul, {{ Carbon\Carbon::today()->toDateString() }}
        </p>
        <p style="line-height: 10%; margin-bottom:0px;">{{ $pengajuan->pejabat_ttd->jabatan }}</p>

        <img style="position: absolute; z-index: -1000; width: 190px; margin-left:-50%; margin-top:-30%;" src="{{ asset('images/stempel.png') }}">

        <img width="90%" style="z-index: -1;" src="{{ $pengajuan->pejabat_ttd->getFirstMediaUrl('signature') }}">

        <p style=" text-decoration:underline; margin-top:0px; z-index: -1000;">
            {{ $pengajuan->pejabat_ttd->nama_pejabat }}
        </p>
        <p style="line-height: 10%">NIP: {{ $pengajuan->pejabat_ttd->nip }}</p>
    </div>

</body>

</html>