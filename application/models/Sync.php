<?php
class Sync extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }

    public function insert_from_cbd($DATE, $INSERT){
        odbc_close_all();
        $this->cbd = $this->load->database('dashboard_cbd', TRUE);
                
        $DATA = array();
        $timestamp = strtotime($DATE);
        $cbd_date = date("Ymd", $timestamp);

        $DATA["S3B"] = $this->cbd->query("SELECT MAX(C_WITEL) as C_WITEL, MAX(C_DATEL_NEW) as C_DATEL, count(C_DATEL_NEW) as JUMLAH FROM TELKOMCBD..demand_indihome_new WHERE etat=5 and to_char(tgl_ps,'yyyymmdd')=$cbd_date and KAWASAN = 'DIVRE 4' AND STATUS_INDIHOME = 'SALES_3P_BUNDLED' GROUP BY C_DATEL_NEW ORDER BY C_DATEL;")->result_array();
        $DATA["S3UB"] = $this->cbd->query("SELECT MAX(C_WITEL) as C_WITEL, MAX(C_DATEL_NEW) as C_DATEL, count(C_DATEL_NEW) as JUMLAH FROM TELKOMCBD..demand_indihome_new WHERE etat=5 and to_char(tgl_ps,'yyyymmdd')=$cbd_date and KAWASAN = 'DIVRE 4' AND STATUS_INDIHOME = 'SALES_3P_UNBUNDLED' GROUP BY C_DATEL_NEW ORDER BY C_DATEL;")->result_array();
        
        $DATA["M13U"] = $this->cbd->query("SELECT MAX(C_WITEL) as C_WITEL, MAX(C_DATEL_NEW) as C_DATEL, count(C_DATEL_NEW) as JUMLAH FROM TELKOMCBD..demand_indihome_new WHERE etat=5 and to_char(tgl_ps,'yyyymmdd')='20201001' and KAWASAN = 'DIVRE 4' AND STATUS_INDIHOME = 'MIGRASI_1P_3P_UNBUNDLED' GROUP BY C_DATEL_NEW ORDER BY C_DATEL;")->result_array();
        $DATA["M23U"] = $this->cbd->query("SELECT MAX(C_WITEL) as C_WITEL, MAX(C_DATEL_NEW) as C_DATEL, count(C_DATEL_NEW) as JUMLAH FROM TELKOMCBD..demand_indihome_new WHERE etat=5 and to_char(tgl_ps,'yyyymmdd')='20201001' and KAWASAN = 'DIVRE 4' AND STATUS_INDIHOME = 'MIGRASI_2P_3P_UNBUNDLED' GROUP BY C_DATEL_NEW ORDER BY C_DATEL;")->result_array();
        $DATA["M13B"] = $this->cbd->query("SELECT MAX(C_WITEL) as C_WITEL, MAX(C_DATEL_NEW) as C_DATEL, count(C_DATEL_NEW) as JUMLAH FROM TELKOMCBD..demand_indihome_new WHERE etat=5 and to_char(tgl_ps,'yyyymmdd')='20201001' and KAWASAN = 'DIVRE 4' AND STATUS_INDIHOME = 'MIGRASI_1P_3P_BUNDLED' GROUP BY C_DATEL_NEW ORDER BY C_DATEL;")->result_array();
        $DATA["M23B"] = $this->cbd->query("SELECT MAX(C_WITEL) as C_WITEL, MAX(C_DATEL_NEW) as C_DATEL, count(C_DATEL_NEW) as JUMLAH FROM TELKOMCBD..demand_indihome_new WHERE etat=5 and to_char(tgl_ps,'yyyymmdd')='20201001' and KAWASAN = 'DIVRE 4' AND STATUS_INDIHOME = 'MIGRASI_2P_3P_BUNDLED' GROUP BY C_DATEL_NEW ORDER BY C_DATEL;")->result_array();

        $DATA["SN"] = $this->cbd->query("SELECT MAX(C_WITEL) as C_WITEL, MAX(C_DATEL_NEW) as C_DATEL, count(C_DATEL_NEW) as JUMLAH FROM TELKOMCBD..DEMAND_INTERNET_NEW WHERE etat=5 and to_char(tgl_ps,'yyyymmdd')='20190701' and KAWASAN = 'DIVRE 4' AND STATUS='IHNETIZEN' AND STATUS_DEMAND = 'SALES NETIZEN' GROUP BY C_DATEL_NEW ORDER BY C_DATEL;")->result_array();
        $DATA["M2T2N"] = $this->cbd->query("SELECT MAX(C_WITEL) as C_WITEL, MAX(C_DATEL_NEW) as C_DATEL, count(C_DATEL_NEW) as JUMLAH FROM TELKOMCBD..DEMAND_INTERNET_NEW WHERE etat=5 and to_char(tgl_ps,'yyyymmdd')='20190701' and KAWASAN = 'DIVRE 4' AND STATUS='IHNETIZEN' AND STATUS_DEMAND = 'MIGRASI 2P TO 2P NETIZEN' GROUP BY C_DATEL_NEW ORDER BY C_DATEL;")->result_array();
        $DATA["MN"] = $this->cbd->query("SELECT MAX(C_WITEL) as C_WITEL, MAX(C_DATEL_NEW) as C_DATEL, count(C_DATEL_NEW) as JUMLAH FROM TELKOMCBD..DEMAND_INTERNET_NEW WHERE etat=5 and to_char(tgl_ps,'yyyymmdd')='20190701' and KAWASAN = 'DIVRE 4' AND STATUS='IHNETIZEN' AND STATUS_DEMAND = 'MIGRASI NETIZEN' GROUP BY C_DATEL_NEW ORDER BY C_DATEL;")->result_array();
        odbc_close_all();

        $this->insert_database($DATE, $INSERT, $DATA);
    }
    
    private function insert_database($DATE, $INSERT, $DATA){
        $IN = array();
        $timestamp = strtotime($DATE);
        $DASHBOARDDATEL = array(
            "reward_best_3p_seles" => "B3S",
            "reward_best_diy_master" => "BDM",
            "reward_best_migration_performance" => "BNP",
            "reward_broadband_champion" => "BC",
            "reward_best_add_on" => "BAO",
            "reward_best_digital_product" => "BDP"
        );

        $DASHBOARDWITEL = array(
            "reward_best_new_sales" => "BNS",
            "reward_best_apc" => "BAPC",
            "reward_best_monetize_migrasi" => "BMM",
        );
        
        foreach($DASHBOARDDATEL as $v) {
            foreach(Mapping::get_mapping("CBD")["DATEL"] as $key => $value){
                $IN[$v][$key]['DATEL'] = $value;
                $IN[$v][$key]['IME'] = date("Ymd", $timestamp).$key;
                $IN[$v][$key]['Tanggal'] = date("d", $timestamp);
                $IN[$v][$key]['Bulan'] = date("m", $timestamp);
                $IN[$v][$key]['Tahun'] = date("Y", $timestamp);
            }
        }

        foreach($DASHBOARDWITEL as $v) {
            foreach(Mapping::get_mapping("CBD")["WITEL"] as $key => $value){
                $IN[$v][$key]['WITEL'] = $value;
                $IN[$v][$key]['IME'] = date("Ymd", $timestamp).$key;
                $IN[$v][$key]['Tanggal'] = date("d", $timestamp);
                $IN[$v][$key]['Bulan'] = date("m", $timestamp);
                $IN[$v][$key]['Tahun'] = date("Y", $timestamp);
            }  
        }

        foreach($DATA as $k => $v){
            switch ($k) {
                case 'S3B':
                    foreach ($v as $value) {
                        if(empty($IN["B3S"][$value["C_DATEL"]]["NSALES"])){
                            $IN["B3S"][$value["C_DATEL"]]["NSALES"] = $value['JUMLAH'];
                        } else {
                            $IN["B3S"][$value["C_DATEL"]]["NSALES"] += $value['JUMLAH'];
                        }
                    }
                    break;
                case 'S3UB':
                    foreach ($v as $value) {
                        if(empty($IN["B3S"][$value["C_DATEL"]]["NSALES"])){
                            $IN["B3S"][$value["C_DATEL"]]["NSALES"] = $value['JUMLAH'];
                        } else {
                            $IN["B3S"][$value["C_DATEL"]]["NSALES"] += $value['JUMLAH'];
                        }
                    }
                    break;
                case 'M13U':
                    break;
                case 'M23U':
                    foreach ($v as $value) {
                        if(empty($IN["B3S"][$value["C_DATEL"]]["MIG_2P-3P"])){
                            $IN["B3S"][$value["C_DATEL"]]["MIG_2P-3P"] = $value['JUMLAH'];
                        } else {
                            $IN["B3S"][$value["C_DATEL"]]["MIG_2P-3P"] += $value['JUMLAH'];
                        }
                    }
                    break;
                case 'M13B':
                    break;
                case 'M23B':
                    foreach ($v as $value) {
                        if(empty($IN["B3S"][$value["C_DATEL"]]["MIG_2P-3P"])){
                            $IN["B3S"][$value["C_DATEL"]]["MIG_2P-3P"] = $value['JUMLAH'];
                        } else {
                            $IN["B3S"][$value["C_DATEL"]]["MIG_2P-3P"] += $value['JUMLAH'];
                        }
                    }
                    break;
                case 'SN':
                    foreach ($v as $value) {
                        if(empty($IN["BNS"][$value["C_WITEL"]]["2P"])){
                            $IN["BNS"][$value["C_WITEL"]]["2P"] = $value['JUMLAH'];
                        } else {
                            $IN["BNS"][$value["C_WITEL"]]["2P"] += $value['JUMLAH'];
                        }
                    }
                    break;
                case 'M2T2N':
                    foreach ($v as $value) {
                        if(empty($IN["B3S"][$value["C_DATEL"]]["MIG_NET"])){
                            $IN["B3S"][$value["C_DATEL"]]["MIG_NET"] = $value['JUMLAH'];
                        } else {
                            $IN["B3S"][$value["C_DATEL"]]["MIG_NET"] += $value['JUMLAH'];
                        }
                    }
                    break;
                case 'MN':
                    foreach ($v as $value) {
                        if(empty($IN["B3S"][$value["C_DATEL"]]["MIG_NET"])){
                            $IN["B3S"][$value["C_DATEL"]]["MIG_NET"] = $value['JUMLAH'];
                        } else {
                            $IN["B3S"][$value["C_DATEL"]]["MIG_NET"] += $value['JUMLAH'];
                        }
                    }
                    break;
                default:
                    break;
            }
        }

        try {
            if($INSERT){
                foreach ($DASHBOARDDATEL as $key => $value){
                    $this->insert_batch($key, $IN[$value]);
                }
                foreach ($DASHBOARDWITEL as $key => $value){
                    $this->insert_batch($key, $IN[$value]);
                }                
                $this->session->set_flashdata('errors', array('errors' => 'Data berhasil diambil'));
                redirect(base_url());
            }else{
                foreach ($DASHBOARDDATEL as $key => $value) {
                    $this->update_batch($key, $IN[$value], "IME");
                }
                foreach ($DASHBOARDWITEL as $key => $value){
                    $this->update_batch($key, $IN[$value], "IME");
                }
                $this->session->set_flashdata('errors', array('errors' => 'Data berhasil diupdate'));
                redirect(base_url());        
            }
        } catch (\Throwable $th) {
            if($INSERT){
                $this->session->set_flashdata('errors', array('errors' => 'Data telah tersedia silahkan lakukan update'));
                redirect(base_url());    
            } else {
                $this->session->set_flashdata('errors', array('errors' => 'Data belum tersedia silahkan lakukan pengambilan data'));
                redirect(base_url());    
            }
        }
    }

    public function update_batch($tabel, $data, $where){
        foreach ($data as $value) {
            $update_query = $this->db->update_string($tabel, $value, $where);
            $update_query = str_replace('UPDATE', 'UPDATE IGNORE', $update_query);
            $this->db->query($update_query);
        }
    }

    public function insert_batch($tabel, $data){
        foreach ($data as $value) {
            $insert_query = $this->db->insert_string($tabel, $value);
            $insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
            $this->db->query($insert_query);
        }
    }
}