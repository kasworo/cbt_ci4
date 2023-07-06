<html>
    <style>
    table {
        width: 100%;
        margin-top: 5px;
        margin-bottom: 5px;
        border-collapse: collapse;
    }

    th {
        border: 0.5px solid black;
        font-family: Verdana, sans-serif;
        font-weight: bold;
        font-size: 10pt;
        text-align: center;
        /* padding: 2px;
        height: 27.5px; */
    }

    td {
        border: 0.5px solid black;
        font-family: Verdana, sans-serif;
        font-size: 10pt;
        /* padding: 2px;
        height: 30px; */
    }
    </style>

    <body
        style="background-image: url('images/brand_w.png'); background-repeat: no-repeat; background-position: center;">
        <?php
    foreach ($ruanguji as $rg => $ruang) :
        echo $rg > 0 ? '<pagebreak>' : '';
        switch ($ruang['idruang']) {
            case 1:
                $nmruang = 'I (Satu)';
                break;
            case 2:
                $nmruang = 'II (Dua)';
                break;
            case 3:
                $nmruang = 'III (Tiga)';
                break;
            case 4:
                $nmruang = 'IV (Empat)';
                break;
            case 5:
                $nmruang = 'V (Lima)';
                break;
            case 6:
                $nmruang = 'VI (Enam)';
                break;
            default:
                $nmruang = '-';
        }
    ?>
        <table width="100%">
            <tr>
                <td rowspan="3" align="center" width="10%" style="border:none;vertical-align:middle">
                    <img src="images/tutwuri_bw.png" width="60px">
                </td>
                <td align="center" style="border:none;font-size:11pt;font-weight:bold">DAFTAR HADIR PESERTA</td>
            </tr>
            <tr>
                <td align="center" style="border:none;font-size:10pt;font-weight:bold">
                    <?php echo strtoupper($ruang['nmujian']); ?></td>
            </tr>
            <tr>
                <td align=" center" style="border:none;font-size:10pt;font-weight:bold">TAHUN PELAJARAN
                    <?php echo $ruang['tahun']; ?>
                </td>
            </tr>
        </table><br>
        <table>
            <tr>
                <td style="border:none;" width="17.5%">Satuan Pendidikan</td>
                <td style="border:none" width="2.5%">:</td>
                <td style="border:none"><?php echo $ruang['nmskul']; ?>
                </td>
                <td style="border:none" width="2.5%"></td>
                <td style="border:none" width="15%">Dimulai</td>
                <td style="border:none" width="2.5%">:</td>
                <td style="border:none">______________________________</td>
            </tr>
            <tr>
                <td style="border:none;height:20px;padding:2px">Mata Pelajaran</td>
                <td style="border:none">:</td>
                <td style="border:none">______________________________</td>
                <td style="border:none"></td>
                <td style="border:none">Alokasi Waktu</td>
                <td style="border:none">:</td>
                <td style="border:none">______________________________</td>
            </tr>
            <tr>
                <td style="border:none;height:20px;padding:2px">Tanggal Ujian</td>
                <td style="border:none">:</td>
                <td style="border:none">______________________________
                </td>
                <td style="border:none"></td>
                <td style="border:none">Ruang Ujian</td>
                <td style="border:none">:</td>
                <td style="border:none"><?php echo $nmruang; ?></td>
            </tr>
        </table>
        <hr />
        <table style="padding:5px">
            <thead>
                <tr>
                    <th width="5%" height="30px">No.</th>
                    <th width="17.5%">Nomor Peserta</th>
                    <th width="35%">Nama Peserta</th>
                    <th>Kelas</th>
                    <th width="32.5%">Tanda Tangan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($peserta[$rg] as $pst) :
                ?>
                <tr>
                    <td align="center" height="27.5px"><?php echo $no . '.'; ?></td>
                    <td align="center">
                        <?php echo substr($pst['nmpeserta'], 3, 2) . '-' . substr($pst['nmpeserta'], 5, 4) . '-' . substr($pst['nmpeserta'], 9, 4) . '-' . substr($pst['nmpeserta'], -1); ?>
                    </td>
                    <td style="padding-left:5px"><?php echo strtoupper($pst['nmsiswa']); ?></td>
                    <td align="center"><?php echo $pst['nmrombel']; ?></td>
                    <td style="padding-left:5px" align="<?php echo $no % 2 == 1 ? 'left' : 'center'; ?>">
                        <?php echo $no . '.'; ?></td>
                </tr>
                <?php
                    $no++;
                endforeach ?>
            </tbody>
        </table>
        <p>Catatan:</p>
        <table width="100%">
            <tr>
                <td width="3.75%" style="border:none;vertical-align:top">1.</td>
                <td style="border:none" colspan="2">Daftar hadir dibuat 2 (dua) rangkap, untuk panitia dan Guru Bidang
                    Studi
                </td>
                <td style="border:none" width="5%"></td>
                <td style="border:none" width="35%"> ..................., .......................... 20....</td>
            </tr>
            <tr>
                <td width="2.75%" style="border:none;vertical-align:top">2.</td>
                <td style="border:none" colspan="2">Pengawas ujian menyilang peserta yang tidak hadir</td>
                <td style="border:none" width="5%"></td>
                <td style="border:none">Pengawas Ujian,</td>
            </tr>
            <tr>
                <td width="2.75%" style="border:none;vertical-align:top">3.</td>
                <td style="border:none" colspan="2">Rekapitulasi Peserta Ujian</td>
                <td style="border:none" width="5%"></td>
                <td style="border:none"></td>
            </tr>
            <tr>
                <td width="2.75%" style="border:none"></td>
                <td style="border:none">Jumlah Peserta Seluruhnya</td>
                <td style="border:none">: ____________ Orang</td>
                <td style="border:none" width="5%"></td>
                <td style="border:none"></td>
            </tr>
            <tr>
                <td width="2.75%" style="border:none"></td>
                <td style="border:none">Jumlah Peserta Hadir</td>
                <td style="border:none">: ____________ Orang</td>
                <td style="border:none" width="5%"></td>
                <td style="border:none">..............................................</td>
            </tr>
            <tr>
                <td width="2.75%" style="border:none"></td>
                <td style="border:none">Jumlah Peserta Tidak Hadir</td>
                <td style="border:none">: ____________ Orang</td>
                <td style="border:none" width="5%"></td>
                <td style="border:none">NIP. .......................................</td>
            </tr>
        </table>
        <?php endforeach ?>
    </body>

</html>