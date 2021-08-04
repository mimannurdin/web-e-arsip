<?php

class M_model extends CI_Model
{
    public function addUser($insertData)
    {
        $this->db->insert("user", $insertData);
        return $this->db->affected_rows();
    }

    public function getUser($where = null)
    {
        if ($where === null) {
            return $this->db->get("user");
        } else {
            return $this->db->get_where("user", $where);
        }
        
    }

    public function checkSession()
    {
        return $this->session->userdata("id_user") !== null;
    }

    public function addLampiran($insertData)
    {
        $this->db->insert("lampiran", $insertData);
        return $this->db->affected_rows();
    }

    public function getLampiranData($where = null)
    {
        if ($where === null) {
            return $this->db->get("lampiran");
        } else {
            return $this->db->get_where("lampiran", $where);
        }
        
    }

    public function addArsip($insertData)
    {
        $this->db->insert("arsip", $insertData);
        return $this->db->insert_id();
    }

    public function getArsipData($where = null)
    {
        if ($where === null) {
            return $this->db->get("arsip");
        } else {
            return $this->db->get_where("arsip", $where);
        }
        
    }

    public function updateArsip($updateData, $id)
    {
        $this->db->set($updateData);
        $this->db->where("id_arsip", $id);
        $this->db->update("arsip");
        return $this->db->affected_rows();
    }

    public function deleteLampiran($where)
    {
        $this->db->delete("lampiran", $where);
        return $this->db->affected_rows();
    }

    public function getPinjamData($where = null, $onlyId = false)
    {
        if ($onlyId) {
            $this->db->select("id_pinjam");
        }

        if ($where === null) {
            return $this->db->get("pinjam_arsip");
        } else {
            return $this->db->get_where("pinjam_arsip", $where);
        }
        
    }

    public function getPinjam($where)
    {
        $this->db->order_by('id_pinjam', 'DESC');
        $this->db->limit(1);
        return $this->db->get_where("pinjam_arsip", $where);
    }

    public function getKembaliData($where = null, $notIn = null)
    {
        if ($notIn !== null) {
            if (count($notIn) <= 0) {
                array_push($notIn, 0);
            }
            $this->db->where_in("id_pinjam", $notIn);
        }

        if ($where === null) {
            return $this->db->get("kembali_arsip");
        } else {
            return $this->db->get_where("kembali_arsip", $where);
        }
        
    }

    public function arsipDipinjam($where)
    {
        $pinjam = $this->getPinjamData($where, true)->result_array();
        $pinjam = array_map('current', $pinjam);
        $numKembali = $this->getKembaliData($where = null, $pinjam)->num_rows();

        return count($pinjam) != $numKembali;
    }

    public function addPinjam($insertData)
    {
        $this->db->insert("pinjam_arsip", $insertData);
        return $this->db->affected_rows();
    }

    public function addKembali($insertData)
    {
        $this->db->insert("kembali_arsip", $insertData);
        return $this->db->affected_rows();
    }

    public function getVPinjam()
    {
        return $this->db->get("v_pinjam");
    }
}