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
    <title>Surat Permohonan Izin Keramaian</title>
</head>

<body style="margin-left: 40px; margin-right:30px; ">
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

    <h3 style="text-decoration:underline" class="text-center">SURAT PERMOHONAN IZIN KERAMAIAN</h3><br>

    <table style="width: 100%; margin-top:0px;">
        <tr>
            <td style="width: 80%;">
                <table class="table-bio">
                    <tr>
                        <td>Nomor</td>
                        <td style="text-transform:uppercase">: {{ $pengajuan->nomor_surat }}</td>
                    </tr>
                    <tr>
                        <td>Lamp</td>
                        <td style="text-transform: capitalize">: 1</td>
                    </tr>
                    <tr>
                        <td>Perihal</td>
                        <td style="text-transform: capitalize">: Pembritahuan izin keramaian</td>
                    </tr>
                </table>
            </td>
            <td style="padding-top: 60px">
                <table style="margin-right:130px; margin-left:auto;">
                    <tr>
                        <td>Kepada yth,</td>
                    </tr>
                    <tr>
                        <td style="text-transform: capitalize">Kapolsek bangko pusako</td>
                    </tr>
                    <tr>
                        <td>Di</td>
                    </tr>
                    <tr>
                        <td style="text-transform: capitalize">Polsek bangko pusako</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>


    <p class="text-paragraf">Bersama ini kamisampaikan surat pembritahuan izin keramaian dan mengumpul orang
        banyak dalam acara {{ $field_data->acara  }} yang dilaksanakan pada :</p>

    <table class="table-bio" cellpadding="3">
        <tr>
            <td>{{ $field_data->hari  }}</td>
            <td style="text-transform: capitalize">: Senin</td>
        </tr>

        <tr>
            <td>Tanggal</td>
            <td style="text-transform: capitalize">: {{ $field_data->acara  }}</td>
        </tr>

        <tr>
            <td>Acara</td>
            <td style="text-transform: capitalize">: {{ $field_data->acara  }}</td>
        </tr>

        <tr>
            <td>Tempat</td>
            <td style="text-transform: capitalize">: {{ $field_data->lokasi  }}</td>
        </tr>

    </table>


    <p class="text-paragraf">Demikian surat Pembritahuan ini kami sampaikan agar Bapak mengetahui dan dapat
        memberikan surat izin kepada kami
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