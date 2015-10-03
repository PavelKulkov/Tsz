<?php

class Payment {

	private $db_instance;
	public $sql;
	private $lng_prefix;
	
	function __construct($db) 	{
		$this->db_instance = $db;
		$this->lng_prefix = $GLOBALS["lng_prefix"];
	}
	
	function getPayment($payment_id) {
	
		$sql = 'SELECT * FROM regportal_payments.payment WHERE id = ?';
		$user_data = $this->db_instance->select($sql, $payment_id);
		return $user_data;
		
	}	
	
	function getSupplier($supplier_id) {
	
		$sql = 'SELECT * FROM regportal_payments.suppliers WHERE id = ?';
		$user_data = $this->db_instance->select($sql, $supplier_id);
		return $user_data;
		
	}
	
	function getAccount($id) {
	
		$sql = 'SELECT * FROM regportal_payments.accounts WHERE id = ?';
		$user_data = $this->db_instance->select($sql, $id);
		return $user_data;
		
	}
	
	function getBank($id) {
	
		$sql = 'SELECT * FROM regportal_payments.bank WHERE id = ?';
		$user_data = $this->db_instance->select($sql, $id);
		return $user_data;
		
	}
	
	function getAddress($id) {
	
		$sql = 'SELECT * FROM regportal_payments.address WHERE id = ?';
		$user_data = $this->db_instance->select($sql, $id);
		return $user_data;
		
	}
	
	function getAdditionalData($payment_id) {
	
		$sql = 'SELECT * FROM regportal_payments.additional_data WHERE id = ?';
		$user_data = $this->db_instance->select($sql, $payment_id);
		return $user_data;
		
	}
	
	function getBudgetIndex($budget_index_id) {
	
		$sql = 'SELECT * FROM regportal_payments.budget_index WHERE id = ?';
		$user_data = $this->db_instance->select($sql, $budget_index_id);
		return $user_data;
		
	}	

	function getSuppliers() {
	
		$sql = 'SELECT * FROM regportal_payments.suppliers';
		$user_data = $this->db_instance->select($sql);
		return $user_data;
		
	}
	
	function getOrgAccounts($supplier_id) {
	
		$sql = 'SELECT acc.id, acc.kind, acc.account, acc.sub_account, b.name as bank, b.id as bank_id FROM accounts acc LEFT JOIN bank b ON acc.bank_id = b.id WHERE acc.supplier_id = ?';
		$user_data = $this->db_instance->select($sql, $supplier_id);
		return $user_data;
		
	}
	
	function getOrgService($supplier_id) {
	
		$sql = 'SELECT * FROM service WHERE id IN (SELECT service_id FROM org_service WHERE supplier_id = ?)';
		$user_data = $this->db_instance->select($sql, $supplier_id);
		return $user_data;
		
	}
	
	function getOrgAddress($supplier_id) {
	
		$sql = 'SELECT * FROM address WHERE id IN (SELECT address_id FROM org_address WHERE supplier_id = ?)';
		$user_data = $this->db_instance->select($sql, $supplier_id);
		return $user_data;
		
	}
	
	function getOrgContacts($supplier_id) {
	
		$sql = 'SELECT * FROM contact WHERE id IN (SELECT contact_id FROM contacts WHERE item_id = ? AND item_type = "org")';
		$user_data = $this->db_instance->select($sql, $supplier_id);
		return $user_data;
		
	}
	
}