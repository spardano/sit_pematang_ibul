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
            height: 25px;
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
    <title>Surat Keterangan Menikah</title>
</head>

<body style="margin-left: 40px; margin-right:30px; margin-bottom:0px; margin-top:0px;">
    <table class="cup">
        <tr>
            <td><img src="{{ asset('images/LogoDesa.png') }}" style="width: 85px;"></td>
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

    <h3 style="text-decoration:underline" class="text-center">SURAT KETERANGAN MENIKAH</h3>
    <p style="line-height: 1px; margin-bottom:0px;" class="text-center">Nomor: {{ $pengajuan->nomor_surat }}</p><br>

    <p class="text-paragraf" style="margin-top: 0px;">Yang bertanda tangan dibawah ini Kepala Desa Pematang Ibul kecamatan bangko pusako
        kabupaten rokan hilir , Dengan ini menerangkan kepada :</p>

    <span class="text-paragraf">I. Mempelai Laki-laki</span>

    <table class="table-bio" style="margin-bottom: 10px;">
        <tr>
            <td>Nama Lengkap </td>
            <td style="text-transform:uppercase">: {{ $pengajuan->user->penduduk->nama_lengkap }}</td>
        </tr>
        <tr>
            <td>Tempat tanggal lahir</td>
            <td style="text-transform: capitalize">: {{ $pengajuan->user->penduduk->tempat_lahir  }}, {{ Carbon\Carbon::parse($pengajuan->user->penduduk->tanggal_lahir)->format('d-m-Y') }}</td>
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
            <td style="text-transform: capitalize">: {{ $pengajuan->user->penduduk->status }}</td>
        </tr>
        <tr>
            <td>Kewarganegaraan</td>
            <td style="text-transform: capitalize">: Indonesia</td>
        </tr>
        <tr>
            <td>Agama</td>
            <td style="text-transform: capitalize">: {{ $agama }}</td>
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

    <span class="text-paragraf">II. Mempelai Perempuan</span>

    <table class="table-bio">
        <tr>
            <td>Nama Lengkap </td>
            <td style="text-transform:uppercase">: {{ $field_data->nama_pasangan  }}</td>
        </tr>
        <tr>
            <td>Tempat tanggal lahir</td>
            <td style="text-transform: capitalize">: {{ $field_data->tempat_lahir_pasangan  }}, {{ Carbon\Carbon::parse($field_data->tanggal_lahir_pasangan)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td style="text-transform: capitalize">: {{ $field_data->jenis_kelamin_pasangan  }}</td>
        </tr>
        <tr>
            <td>Status Perkawinan</td>
            <td style="text-transform: capitalize">: {{ $field_data->status_perkawinan_pasangan  }}</td>
        </tr>
        <tr>
            <td>Kewarganegaraan</td>
            <td style="text-transform: capitalize">: {{ $field_data->kewarganegaraan  }}</td>
        </tr>
        <tr>
            <td>Agama</td>
            <td style="text-transform: capitalize">: {{ $field_data->agama_pasangan }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td style="text-transform: capitalize">: {{ $field_data->pekerjaan_pasangan }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td style="text-transform: capitalize">: {{ $field_data->nik_pasangan }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td style="text-transform: capitalize">: {{ $field_data->alamat_pasangan }}</td>
        </tr>
    </table>


    <p class="text-paragraf">Bahwa kedua nama tersebut di atas sepanjang pengetahuan, pengecekan, dan
        pemeriksaaan kami, benar - benar suami istri yang sudah menikah Di {{ $field_data->lokasi }}
        Pada {{ $field_data->tanggal_menikah }}p>

    <p class="text-paragraf">Demikian surat keterangan ini dibuat dengan sebenarnya, agar dapat dipergunakan
        sebagaimana mestinya.</p>

    <div class="sign">
        <p style="line-height: 10%">Pematang Ibul, {{ Carbon\Carbon::today()->toDateString()}}</p>
        <p style="line-height: 10%; margin-bottom:0px;">{{ $pengajuan->pejabat_ttd->jabatan}}</p>

        <img width="90%" src="{{$pengajuan->pejabat_ttd->getFirstMediaUrl('signature')}}">

        <p style=" text-decoration:underline; margin-top:0px;"> {{$pengajuan->pejabat_ttd->nama_pejabat}}</p>
        <p style="line-height: 10%">NIP: {{$pengajuan->pejabat_ttd->nip}}</p>
    </div>

</body>

</html>