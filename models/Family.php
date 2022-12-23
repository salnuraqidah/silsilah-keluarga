<?php
class Family
{
    private $koneksi;
    public function __construct()
    {
        global $connect;
        $this->koneksi = $connect;
    }

    public function dataRoot()
    {
        $sql = "SELECT * from family where family != 0  and posisi='root'";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute();
        $rs = $ps->fetchAll();
        return $rs;
    }
    public function simpanRoot($data)
    {
        $sql = "INSERT INTO family(nama,jenis_kelamin,posisi,family)
                    VALUES (?,?,?,?)";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute($data);
    }

    public function getLastIdRoot()
    {
        $sql = "SELECT max(family) as idLast from family where family != 0  and posisi='root'";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute();
        $rs = $ps->fetch();
        return $rs;
    }

    public function detailRoot($id)
    {
        $sql = "SELECT * from family 
                    WHERE id = ?";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute($id);
        $rs = $ps->fetch();
        return $rs;
    }
    public function ubahRoot($data)
    {
        $sql = "UPDATE family SET 
                    nama=?,jenis_kelamin=?
                    WHERE id=?";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute($data);
    }
    public function hapusRoot($id)
    {
        $sql = "DELETE FROM family WHERE id=?";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute($id);
    }

    public function cekFamily($id)
    {
        $sql = "SELECT count(id) as jml
        FROM family
        WHERE family_id = $id";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute();
        $rs = $ps->fetch();
        return $rs;
    }

    public function data()
    {
        $sql = "SELECT a.*, b.nama as namaKeluarga from family a 
        inner join family b on a.family_id=b.family
        where a.family = 0 order by a.posisi asc, a.nama asc";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute();
        $rs = $ps->fetchAll();
        return $rs;
    }

    public function getOrangTua($id)
    {
        $sql = "SELECT a.* from family a 
        where a.parent != 0 and family_id=$id order by a.parent asc";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute();
        $rs = $ps->fetchAll();
        return $rs;
    }

    public function getLastIdParent($family_id)
    {
        $sql = "SELECT max(parent) as idLast from family where parent != 0  and family_id=$family_id and posisi='Anak' ";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute();
        $rs = $ps->fetch();
        return $rs;
    }

    public function simpan($data)
    {
        $sql = "INSERT INTO family(nama,jenis_kelamin,posisi,family_id,parent,parent_id)
                    VALUES (?,?,?,?,?,?)";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute($data);
    }

    public function detail($id)
    {
        $sql = "SELECT * from family 
                    WHERE id = ?";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute($id);
        $rs = $ps->fetch();
        return $rs;
    }

    public function ubah($data)
    {
        $sql = "UPDATE family SET 
                    nama=?,jenis_kelamin=?,posisi=?,family_id=?,parent=?,parent_id=?
                    WHERE id=?";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute($data);
    }

    public function cekFamilyParent($id)
    {
        $sql = "SELECT count(id) as jml  FROM family
        WHERE parent_id = $id and parent_id != 0";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute();
        $rs = $ps->fetch();
        return $rs;
    }

    public function getAnak($id, $family)
    {
        $sql = "SELECT *  FROM family
        WHERE parent_id = $id and parent_id != 0 and family_id=$family";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute();
        $rs = $ps->fetchAll();
        return $rs;
    }
};
