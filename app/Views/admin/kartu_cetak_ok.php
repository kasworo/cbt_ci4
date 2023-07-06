<?php
$output = '';
foreach ($peserta as $id => $pst) {
    switch ($pst['idruang']) {
        case 1:
            $ruang = 'I (Satu)';
            break;
        case 2:
            $ruang = 'II (Dua)';
            break;
        case 3:
            $ruang = 'III (Tiga)';
            break;
        case 4:
            $ruang = 'IV (Empat)';
            break;
        case 5:
            $ruang = 'V (Lima)';
            break;
        case 6:
            $ruang = 'VI (Enam)';
            break;
        default:
            $ruang = '-';
    }
    $output = '<table width="100%" style="border: 1px solid black;border-collapse: collapse;
        border-style: outset;">
    <tbody>
        <tr>
            <td rowspan="3" align="center" style="border-bottom: 1px solid black" width="10%">
                <img style="padding-left:30px" src="images/tutwuri_bw.png" width="50">
            </td>
            <td align="center" colspan="3" style="font-size:12px;font-weight:bold;padding-left:10px" height="20px"
                width="90%">KARTU LOGIN PESERTA
            </td>
        </tr>
        <tr height="20px">
            <td align="center" colspan="3" style="font-size:12px;font-weight:bold;padding-left:10px">' . strtoupper($uji['nmujian']) . '</td>
        </tr>
        <tr height="20px">
            <td align="center" colspan="3"
                style="font-size:11px;font-weight:bold;padding-left:11px;border-bottom: 1px solid black"> TAHUN PELAJARAN ' . $uji['tahun'] . '
            </td>
        </tr>
        <tr height="20px">
            <td colspan="4"><br></td>
        </tr>
        <tr height="20px">
            <td style="font-size:11px;font-weight:bold;padding-left:10px" colspan="2">Username / Password</td>
            <td>:</td>
            <td style="font-size:11px;font-weight:normal;">' . $pst['nmpeserta'] . ' / ' . $pst['passwd'] .
        '</td>
        </tr>
        <tr height="20px">
            <td style="font-size:11px;font-weight:bold;padding-left:10px" colspan="2">Nama Peserta</td>
            <td width="2.5%">:</td>
            <td width="57.5%" style="font-size:11px;font-weight:normal;">' . strtoupper($pst['nmsiswa']) .
        '</td>
        </tr>
    <tr height="20px">
        <td style="font-size:11px;font-weight:bold;padding-left:10px" colspan="2">Tempat, Tgl. Lahir</td>
        <td>:</td>
        <td style="font-size:11px;font-weight:normal;">' . ucwords(strtolower($pst['tmplahir'])) . ', ' . $pst['tgllahir'] .
        '</td>
        </tr>
        <tr height="20px">
            <td style="font-size:11px;font-weight:bold;padding-left:10px" colspan="2">NIS / NISN</td>
            <td>:</td>
            <td style="font-size:11px;font-weight:normal;">'
        . $pst['nis'] . ' / ' . $pst['nisn'] .
        '</td>
        </tr>
    <tr height="20px">
        <td style="font-size:11px;font-weight:bold;padding-left:10px" colspan="2">Ruang Ujian / Rombel</td>
        <td>:</td>
        <td style="font-size:11px;font-weight:normal;">'
        . $ruang . ' / ' . $pst['nmrombel'] .
        '</td>
    </tr>
    <tr>
        <td colspan="4"><br>
        </td>
    </tr>
    <tr height="20px">
        <td style="font-size:11px;font-weight:bold;padding-left:10px" align="center" colspan="2">
            <img src="images/kotakfoto.png" width="80">
        </td>
        <td style="font-size:11px;font-weight:normal;" colspan="2">Kab. Bungo, 31 Mei 2023<br>Kepala
            Sekolah,<br> <img src="images/ttd.png" width="70"><br>
            Muhamad, S.Pt<br>NIP. 197407302007011003
        </td>
    </tr>
    <tr>
        <td colspan="4"><br></td>
    </tr>
    </tbody>
    </table>
    <br>';
    echo $output;
}
