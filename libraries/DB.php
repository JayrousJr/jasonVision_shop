<?php
/**
 * Database Wrapper
 */

class DB
{
    private static $_instance = null;
    private $conn;


    private function __construct()
    {
        $this->conn = new mysqli('localhost', 'jvteppwq_shop', 'Jason2024', 'jvteppwq_shop');
        // $this->conn = new mysqli('localhost', 'root', '', 'jvteppwq_shop');
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public static function get_instance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    #Insert Data into Database
    public function insert($table, $data)
    {
        $sql = "INSERT INTO " . $table;
        $sql .= " (" . implode(",", array_keys($data)) . ") ";
        $sql .= "VALUES ('" . implode("','", array_values($data)) . "')";
        if ($this->conn->query($sql)) {
            return $this->conn->insert_id;
        } else {
            return FALSE;
        }
    }

    public function query($sql)
    {
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $results = [];
            while ($obj = $result->fetch_object()) {
                $results[] = $obj;
            }
            return $results;
            $result->free_result();
        }
    }

    #Get All Data
    public function get_all($table, $where = false)
    {
        $sql = "SELECT * FROM {$table}";

        if ($where !== false) {
            $sql .= " " . $this->_where($where);
        }

        $result = $this->conn->query($sql);
        return $this->_get_all_data($result);
        return false;
    }

    public function get($table, $where)
    {
        return $this->get_all($table, $where)[0];
    }

    public function get_where($table, $where = array(), $type = 'array')
    {
        $sql = "SELECT * FROM {$table}";
        if (count($where)) {
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            $r = strtolower($_SESSION['role']);


            if ($field != 'shop_id' || ($field === 'shop_id' && $r != 'director')) {
                $sql .= " WHERE {$field} {$operator} '{$value}'";
            }

            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {
                if ($type === 'obj') {
                    $results = [];
                    while ($obj = $result->fetch_object()) {
                        $results[] = $obj;
                    }
                    return $results;
                    $result->free_result();
                }

                return mysqli_fetch_all($result, MYSQLI_ASSOC);
                $result->free_result();
            }
        }
        return false;
    }

    public function update($table, $data, $where)
    {
        $sets = array();
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $sets[] = "{$key} = '{$value}'";
            }
        }
        $sql = $this->conn->query("UPDATE {$table} SET " . implode(", ", $sets) . " WHERE {$where}");
        if ($sql) {
            return true;
        }
        echo mysqli_error($this->conn);
        return false;
    }

    public function get_user_shop($id = false)
    {
        if ($id === false) {
            $id = $_SESSION['user_id'];
        }
        $sql = $this->conn->query("SELECT shop_id FROM auth_users WHERE id = '$id'");
        return $sql->fetch_object()->shop_id;
    }

    public function get_shop($id = false)
    {
        if ($id === false) {
            $id = $_SESSION['shop'];
        }

        $sql = $this->conn->query("SELECT address FROM shops WHERE id = '$id'");
        $results = $sql->fetch_object();

        return ucfirst($results->address);
    }

    public function delete($table, $params = false)
    {
        $sql = "DELETE FROM {$table}";
        if ($params !== false) {
            if (is_array($params)) {
                $field = $params[0];
                $operator = $params[1];
                $value = $params[2];

                $where = "{$field} {$operator} '{$value}'";
            } else {
                $where = "id = '{$params}'";
            }

            $sql .= " WHERE {$where}";
        }
        if ($this->conn->query($sql)) {
            return true;
        }

        return false;
    }

    public function count($table, $where = false)
    {
        $sql = "SELECT * FROM {$table}";
        if ($where != false) {
            $sql .= " " . $this->_where($where);
        }

        $sql = $this->conn->query($sql);
        return $sql->num_rows;
    }

    private function _get_all_data($result)
    {
        if ($result->num_rows > 0) {
            $results = [];
            while ($obj = $result->fetch_object()) {
                $results[] = $obj;
            }
            $result->free_result();
            return $results;
        }
    }

    private function _where($where)
    {
        $where_clause = "";

        if (is_numeric($where)) {
            $where_clause = " WHERE id = '" . $where . "'";
        }

        if (is_array($where) && count($where) !== 0) {
            $where_clause .= " WHERE ";
            if (count($where) === 3) {
                $operators = array('=', '>', '<', '>=', '<=', '!=');

                $field = $where[0];
                $operator = $where[1];
                $value = $where[2];

                if (in_array($operator, $operators)) {
                    $where_clause .= "{$field} {$operator} '" . $value . "'";
                }
            } elseif (count($where) === 2) {
                $field = $where[0];
                $value = $where[1];

                $where_clause .= "{$field} = '" . $value . "'";
            }
        }

        if (is_string($where)) {
            $where_clause = "WHERE " . $where;
        }

        return $where_clause;
    }

    function get_data($table, $date, $shop_id = false)
    {
        $shop_id = $shop_id == false ? $this->get_user_shop() : $shop_id;
        $data = $this->get_all($table, array('shop_id', $shop_id));
        if (isset($_POST['searchBtn'])) {
            $end = $_POST['to'] . ' 23:59:59.999';
            $where = "{$date} BETWEEN '" . $_POST['from'] . "' AND '" . $end . "' AND shop_id = " . $shop_id;
            $data = $this->get_all($table, $where);
        }

        return $data;
    }
}