<?php 
class Model_hs extends CI_model{

    function penjualan_detail($id){
        return $this->db->query("SELECT * FROM `pemesanan` a JOIN pelanggan b ON a.id_pelanggan=b.id_pelanggan where a.id_pemesanan='$id'");
    }

    function profile_pelanggan($id){
        return $this->db->query("SELECT * FROM `pelanggan` where id_pelanggan='$id'");
    }

    function profile_update($id){
        if (trim($this->input->post('c')) != ''){
            $datadbd = array('nama'=>$this->db->escape_str(strip_tags($this->input->post('a'))),
                            'email'=>$this->db->escape_str(strip_tags($this->input->post('b'))),
                            'password'=>hash("sha512", md5($this->input->post('c'))),
                            'alamat'=>$this->db->escape_str(strip_tags($this->input->post('d'))),
                            'no_telp'=>$this->db->escape_str(strip_tags($this->input->post('e'))),
                            'no_rek'=>$this->db->escape_str($this->input->post('f')),
                            'bank'=>$this->db->escape_str($this->input->post('g')),
                            'atas_nama'=>$this->db->escape_str(strip_tags($this->input->post('h'))));
        }else{
           $datadbd = array('nama'=>$this->db->escape_str(strip_tags($this->input->post('a'))),
                            'email'=>$this->db->escape_str(strip_tags($this->input->post('b'))),
                            'alamat'=>$this->db->escape_str(strip_tags($this->input->post('d'))),
                            'no_telp'=>$this->db->escape_str(strip_tags($this->input->post('e'))),
                            'no_rek'=>$this->db->escape_str($this->input->post('f')),
                            'bank'=>$this->db->escape_str($this->input->post('g')),
                            'atas_nama'=>$this->db->escape_str(strip_tags($this->input->post('h'))));
        }
        $this->db->where('id_pelanggan',$id);
        $this->db->update('pelanggan',$datadbd);
    }

    function kirimPesanWa($phone,$msg)
    {
        // Pull messages (for push messages please go to settings of the number)
        $my_apikey = "DXZMHWKOCDSGQVK1SAP0";
        $number = $phone;
        $type = "TYPE OF MESSAGE: IN or OUT";
        $markaspulled = "1 or 0";
        $getnotpulledonly = "1 or 0";
        $api_url  = "http://panel.rapiwha.com/get_messages.php";
        $api_url .= "?apikey=". urlencode ($my_apikey);
        $api_url .= "&number=". urlencode ($number);
        $api_url .= "&type=". urlencode ($type);
        $api_url .= "&markaspulled=". urlencode ($markaspulled);
        $api_url .= "&getnotpulledonly=". urlencode ($getnotpulledonly);
        $my_json_result = file_get_contents($api_url, false);
        $my_php_arr = json_decode($my_json_result);
        foreach($my_php_arr as $item)
        {
        $from_temp = $item->from;
        $to_temp = $item->to;
        $text_temp = $item->text;
        $type_temp = $item->type;
        echo "<br>". $from_temp ." -> ". $to_temp ." (". $type_temp ."): ". $text_temp;
        // Do something
        }

        // Send Message
        $my_apikey = "DXZMHWKOCDSGQVK1SAP0";
        $destination = $phone;
        $message = $msg;
        $api_url = "http://panel.rapiwha.com/send_message.php";
        $api_url .= "?apikey=". urlencode ($my_apikey);
        $api_url .= "&number=". urlencode ($destination);
        $api_url .= "&text=". urlencode ($message);
        $result = json_decode(file_get_contents($api_url, false));
        return $result;
    }

    function orders_report($id){
        return $this->db->query("SELECT * FROM `pemesanan` where id_pelanggan='$id' ORDER BY id_pemesanan DESC");
    }

}