<?php 
class Shop {
	private $db;
	private $table = 'shops';

	public function __construct() {
		$this->db = DB::get_instance();
	}

	public function get_name($id = false) {
		return $this->get($this->_shop_id($id))->address;
	}

	public function get_all() {
		$result = $this->db->get_all($this->table);
		return $result;
	}

	public function get_id() {
		return Session::get('shop');
	}

	public function get($id = false) {
		$result = $this->db->get_where($this->table, array('id','=',$this->_shop_id($id)), 'obj');
		return $result[0];
	}

	private function _shop_id($id) {
		return ($id === false) ? $this->get_id() : $id;
	}
}