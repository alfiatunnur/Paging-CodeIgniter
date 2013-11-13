<?php
class Products_model extends CI_Model {

    var $ProductName  = '';
    var $CategoryID = '';
	var $QuantityPerUnit = '';
    

    function __construct()
    {        
        parent::__construct();
    }
    
    function get_products()
    {
        $query = $this->db->get('products');
        return $query->result();
    }

    /*function insert_entry()
    {
        $this->CategoryName  = $this->input->post('nm_cat'); 
        $this->Description   = $this->input->post('deskripsi');         
        $this->db->insert('categories', $this);
    }

    function update_entry()
    {
        $this->CategoryName  = $this->input->post('nm_cat'); 
        $this->Description   = $this->input->post('deskripsi'); 
        
        $this->db->update('categories', $this, array('CategoryID' => $_POST['id']));
    }*/
	 function get_products_by_id($id)
    {
        $this->db->where('ProductID',$id);
        $query = $this->db->get('products');
        return $query->row();
    }
	
	
	function insert_entry()
    {
        $this->ProductName  = $this->input->post('ProductName',true); 
        $this->CategoryID   = $this->input->post('CategoryID',true);
		$this->QuantityPerUnit   = $this->input->post('QuantityPerUnit',true); 		
        return $this->db->insert('products', $this);
    }

    function update_entry()
    {
        $this->ProductName  = $this->input->post('ProductName',true); 
        $this->CategoryID   = $this->input->post('CategoryID',true);
		$this->QuantityPerUnit   = $this->input->post('QuantityPerUnit',true);         
        return $this->db->update('products', $this, array('ProductID' => $this->input->post('id',true)));
    }
	function caridata($id){
		//$match = $this->input->post('carinama',true);
		$this->db->like('ProductName',$id);
		$query = $this->db->get('products');
		return $query->result();
	
	
	}
	
	//menampilkan hasil searching
	function carinama($id){
	
       $data['tampilcarinama']= $this->db->caridata($id);
       //jika data yang dicari tidak ada maka akan keluar informasi 
       //bahwa data yang dicari tidak ada
       if($data['tampilcarinama']==null) {
          print 'maaf data yang anda cari tidak ada atau keywordnya salah';
         
          }
          else {
             $this->load->view('tampilcarinama',$data); 
			}

	}
	
	//searching
	function tampilcarinama()
	{
	$data['query']=$this->db->get('products');
	//$this->load->view('products',$data);
	return $query->result();
	}

    function hapus($id)
    {
        $this->db->where('ProductID',$id);
        return $this->db->delete('products');
    }
	
	function load_table($num, $offset)
	{
		//$this->db->order_by('ProductID', 'ASC');
		$data=$this->db->get('products', $num, $offset);
		return $data->result();
	}
    function cek_dependensi($id)
    {
        $this->db->where('ProductID',$id);
        $query = $this->db->count_all('products');
        return ($query==0) ? true : false;
    }
}