<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
       .text-paragraf{
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

        .kop-header-text{
            font-size: 20px;
            font-weight: bold;
            line-height: 10px;
        }

        .sign{
            width: 200px;
            margin-top:20px; 
            text-align:center;
            position: absolute;
            right: 40px;
        }
    </style>
    <title>Surat Keterangan Usaha</title>
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

    <h3 style="text-decoration:underline" class="text-center">SURAT KETERANGAN USAHA</h3>
    <p style="line-height: 1px " class="text-center">Nomor...............</p><br>

    <p style="line-height: 10px; margin-bottom:0px;">Yang bertanda tangan dibawah ini, Saya</p><br>

    <table cellpadding="3">
        <tr>
            <td>Nama Lengkap</td>
            <td style="text-transform: UPPERCASE">: Sakti Par Dano</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td style="text-transform: UPPERCASE">: Laki-laki</td>
        </tr>
        <tr>
            <td>jabatan</td>
            <td style="text-transform: UPPERCASE">: Penghulu Pematang Ibul</td>
        </tr>
    </table>

    <p style="line-height: 100%" class="text-paragraf">Dengan ini menerangkan bahwa :</p>

    <table class="table-bio" cellpadding="3">
        <tr>
            <td>Nama</td>
            <td style="text-transform: UPPERCASE">: Aldian Willia</td>
        </tr>

        <tr>
            <td>Tempat/Tgl.Lahir</td>
            <td style="text-transform: UPPERCASE">: BUKITTINGGI, 26 Oktober 1997</td>
        </tr>

        <tr>
            <td>Fakultas / Jurusan</td>
            <td style="text-transform: UPPERCASE">: Politeknik Caltex Riau / Teknik Informatika</td>
        </tr>

        <tr>
            <td>Alamat</td>
            <td>: Jl. Maharaja Sri Wangsa</td>
        </tr>

        <tr>
            <td>NIK</td>
            <td>: 1407726109700010</td>
        </tr>

    </table>


    <p class="text-paragraf">Bahwa orang yang namanya tersebut diatas sepanjang pengetahuan dan pengamatan kami
        memang benar mempunyai Usaha ................ Sejak tahun .......... Desa pematang ibul kecamatan
        bangko pusako kabupaten rokan hilir.
    </p>
    <p class="text-paragraf">Demikian surat keterangan ini kami buat dengan sebenarnya untuk dapat dipergunakan
        sebagaimana mestinya.
    </p>


    <div class="sign">
        <p style="line-height: 10%">Pematang Ibul, 17-Nov-2023</p>
        <p style="line-height: 10%">Penghulu Pematang Ibul</p>

        <p style=" text-decoration:underline;  margin-top:50px"> SAMRI,A.Md</p>
        <p style="line-height: 10%">NIP: 0012002</p>
    </div>

</body>

</html>