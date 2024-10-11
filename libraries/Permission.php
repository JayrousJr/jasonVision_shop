<?php 
// session_start();
class Permission {
	public $role;

    public function __construct() {
        $this->role = strtolower($_SESSION['role']);
    }

    public function is_admin() {
        return ($this->role == 'director' || $this->role == 'asst_director');
    }

    public function is_director() {
        return ($this->role == 'director');
    }

    public function is_employee() {
        return $this->role == 'employee';
    }

    public function is_admin_or_employee() {
        return ($this->role == 'director' || $this->role == 'employee');
    }

    public function is_admin_or_manager() {
        return ($this->role == 'director' || $this->role == 'asst_director' || $this->role == 'manager');
    }

    public function is_admin_or_accountant() {
        return ($this->role == 'director' || $this->role == 'accountant');
    }

    public function is_admin_or_manager_or_accountant() {
        return ($this->role == 'director' || $this->role == 'manager' || $this->role == 'accountant');
    }
}