<?php  
class m_beranda extends CI_Model
{
    function hitungSiswa()
    {
        $query = $this->db->query('SELECT * FROM dataSiswa WHERE statusSiswa = 1');
        if($query->num_rows()>0)
        {
            return $query->num_rows();
        }
        else {
            return 0;
        } 
    }

    function hitungGuru()
    {
        $query = $this->db->query("SELECT nomorInduk, namaUser FROM user WHERE userRole NOT LIKE '%Admin%' AND userRole NOT LIKE '%Wali Murid%' AND 
        userRole NOT LIKE '%Siswa%'");
        if($query->num_rows()>0)
        {
            return $query->num_rows();
        }
        else {
            return 0;
        }
    }

    function hitungKls()
    {
        $query = $this->db->query("SELECT * FROM `kelas`");
        if($query->num_rows()>0)
        {
            return $query->num_rows();
        }
        else {
            return 0;
        }
    }

    function getRapor()
    {
        $query = $this->db->query("SELECT * FROM `rapor`");
        if($query->num_rows()>0)
        {
            return $query->num_rows();
        }
        else {
            return 0;
        }
    }

    function ekstrakurikuler()
    {
        return $this->db->query("SELECT DISTINCT namaEkskul FROM `ekskul_siswa`");
    }

    function getJmlhAbsen($kls, $absen)
    {
        return $query = $this->db->query("SELECT absensi.absen FROM jadwal
        JOIN absensi ON absensi.idJadwal = jadwal.idJadwal
        WHERE jadwal.idKelas = '".$kls."' AND absensi.absen = '".$absen."'");
    }

    function getJurusanKuliah()
    {
        return $this->db->query("SELECT DISTINCT namaAlternatif FROM `alternatif`");
    }

    function getNamaGuru()
    {
        return $query = $this->db->query("SELECT DISTINCT user.namaUser, jadwal.nomorInduk FROM jadwal 
        JOIN user ON user.nomorInduk = jadwal.nomorInduk");
    }

    function getKlsGuru()
    {
        return $query = $this->db->query("SELECT jadwal.idKelas, jadwal.nomorInduk FROM jadwal JOIN kelas ON kelas.idKelas = jadwal.idKelas");
    }

    function getNilaiRapor()
    {
        return $query = $this->db->query("SELECT totalNilai FROM `rapor`");
    }

    function getKetKelas()
    {
        return $this->db->query("SELECT DISTINCT ketKelas FROM `kelas` WHERE statuskelas = 1");
    }

    function getJurusan($ket)
    {
        return $this->db->query("SELECT DISTINCT jurusanKelas FROM `kelas` WHERE statuskelas = 1 AND ketKelas = '".$ket."'");
    }

    function getKelas()
    {
        return $this->db->query("SELECT * FROM `kelas`");
    }

    function getNilaiSiswa($jurusan, $ket)
    {
        return $this->db->query("SELECT * FROM `datasiswa` 
        JOIN rapor ON datasiswa.idSiswa = rapor.idSiswa
        JOIN kelas ON datasiswa.idKelas = kelas.idKelas
        JOIN user ON user.nomorInduk = datasiswa.nomorInduk
        WHERE kelas.jurusanKelas = '".$jurusan."' AND kelas.ketKelas = '".$ket."'
        ORDER BY rapor.totalNilai DESC LIMIT 5");
    }

    function getMapel($kls)
    {
        return $this->db->query("SELECT DISTINCT matapelajaran.namaMapel, matapelajaran.idMapel FROM `bukunilai` 
        JOIN matapelajaran ON matapelajaran.idMapel = bukunilai.idMapel
        JOIN kelas ON kelas.idKelas = bukunilai.idKelas
        WHERE kelas.ketKelas = '".$kls."'");
    }

    function getHasilNilai($mapel, $kls)
    {
        return $this->db->query("SELECT * FROM `datasiswa` 
        JOIN kelas ON kelas.idKelas = datasiswa.idKelas
        JOIN bukunilai ON bukunilai.idSiswa = datasiswa.idSiswa
        JOIN user ON user.nomorInduk = datasiswa.nomorInduk
        WHERE kelas.ketKelas = '".$kls."' AND bukunilai.idMapel = '".$mapel."' AND jenisNilai = 'UTS'
        ORDER BY bukunilai.nilai DESC LIMIT 5");
    }

    function getNamaSiswa($kls)
    {
        return $this->db->query("SELECT user.namaUser, rapor.totalNilai FROM `dataSiswa`
        JOIN rapor ON rapor.idSiswa = datasiswa.idSiswa
        JOIN user ON user.nomorInduk = datasiswa.nomorInduk
        JOIN kelas ON kelas.idKelas = datasiswa.idKelas
        WHERE kelas.idKelas = '".$kls."'
        ORDER BY rapor.totalNilai DESC LIMIT 3");
    }

    function getNilaiTerendah($kls)
    {
        return $this->db->query("SELECT user.namaUser, rapor.totalNilai FROM `dataSiswa`
        JOIN rapor ON rapor.idSiswa = datasiswa.idSiswa
        JOIN user ON user.nomorInduk = datasiswa.nomorInduk
        JOIN kelas ON kelas.idKelas = datasiswa.idKelas
        WHERE kelas.idKelas = '".$kls."'
        ORDER BY rapor.totalNilai ASC LIMIT 3");
    }

    function getJenisAbsen($kls)
    {
        return $this->db->query("SELECT DISTINCT absensi.absen FROM jadwal
        JOIN absensi ON absensi.idJadwal = jadwal.idJadwal
        WHERE jadwal.idKelas = '".$kls."'");
    }

    function getSiswa($kls)
    {
        return $this->db->query("SELECT user.namaUser, datasiswa.idSiswa FROM `datasiswa`
        JOIN user ON user.nomorInduk = datasiswa.nomorInduk
        WHERE datasiswa.idKelas = '".$kls."'");
    }

    function getRekomendasi($id)
    {
        return $this->db->query("SELECT * FROM `alternatif`
        JOIN rankingrekomendasi ON rankingrekomendasi.idAlternatif = alternatif.idAlternatif
        WHERE idSiswa = '".$id."'
        ORDER BY rankingrekomendasi.hasilAkhir DESC");
    }
}