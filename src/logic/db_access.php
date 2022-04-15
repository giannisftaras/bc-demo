<?php

class DB_CONNECTOR {
	private $database;
	private $conn;

    function __construct($db) {
        $this->database = $db;
        $this->conn = $this->connectDB();
	}

	private function connectDB() {
        global $auth_ini;
        $conn = mysqli_init();
        $conn->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5);
        $conn->real_connect($auth_ini['db_host'], $auth_ini['db_user'], $auth_ini['db_pass'], $this->database, 3306, NULL);
        return $conn;
	}

    function runBaseQuery($query) {
        $result = mysqli_query($this->conn,$query);
        try {
            while($row=mysqli_fetch_assoc($result)) {
                $resultset[] = $row;
            }
            if(!empty($resultset))
            return $resultset;
        } catch (\Throwable $th) {
        }
    }

    function runQuery($query, $param_type, $param_value_array) {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        $sql->execute();
        $result = $sql->get_result();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }
        if(!empty($resultset)) {
            return $resultset;
        }
    }

    function bindQueryParams($sql, $param_type, $param_value_array) {
        $param_value_reference[] = & $param_type;
        for($i=0; $i<count($param_value_array); $i++) {
            $param_value_reference[] = & $param_value_array[$i];
        }
        call_user_func_array(array(
            $sql,
            'bind_param'
        ), $param_value_reference);
    }

    function insert($query, $param_type, $param_value_array) {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        $sql_resp = $sql->execute();
        if ($sql_resp === false) {
            return $sql->error;
        } else {
            return NULL;
        }
    }

    function update($query, $param_type, $param_value_array) {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        $sql_resp = $sql->execute();
        if ($sql_resp === false) {
            return $sql->error;
        } else {
            return NULL;
        }
    }

}

class localQueries {

    private $db_handle;
    private function get_database_connector() {
        global $auth_ini;
        if (empty($this->db_handle)) {
            $this->db_handle = new DB_CONNECTOR($auth_ini['db_name']);
        }
        return $this->db_handle;
    }

    private function sanitize_string(string $str, int $sanitize_quality = 3) : string {
        if (!empty($str)) {
            $str = strip_tags($str);
            if ($sanitize_quality == 3) {
                $str = htmlspecialchars($str);
            }
        }
        return $str;
    }

    private function sanitize_array(array $arr, int $sanitize_quality = 3) : array {
        foreach ($arr as $i => $itm) {
            if (is_string($itm)) {
                $arr[$i] = $this->sanitize_string($itm, $sanitize_quality);
            } elseif (is_array($itm)) {
                foreach ($itm as $x => $sbi) {
                    if (is_string($sbi)) {
                        $arr[$i][$x] = $this->sanitize_string($sbi, $sanitize_quality);
                    }
                }
            }
        }
        return $arr;
    }

    /**
     * Return the header menu
     * @return array
     */
    public function get_header_menu() : array {
        $query = "SELECT * FROM header_menu ORDER BY menu_order ASC";
        $results = $this->get_database_connector()->runBaseQuery($query);
        $menus = [];
        if (!empty($results)) {
            foreach ($results as $menu) {
                $menus[$menu['id']] = $menu;
            }
            foreach ($menus as $index => $result) {
                if (!is_null($result['menu_parent'])) {
                    $menus[intval($result['menu_parent'])]['child'][$menus[$index]['menu_order']] = $menus[$index];
                    unset($menus[$index]);
                }
            }
        }
        return $menus;
    }

    /**
     * Return the casino data for the homepage
     * @return array
     */
    public function get_casino_cards() : array {
        $query = "SELECT * FROM casino_cards ORDER BY card_order ASC";
        $results = $this->get_database_connector()->runBaseQuery($query);
        return $results;
    }

    /**
     * Update the header menu entries
     * @param array $menus The menus array structured in process/update-fields@12
     * @return array Errors from the query response @173 are added to the array
     */
    public function update_header_menu(array $menus) : array {
        $menus = $this->sanitize_array($menus);
        $this->clear_header_table();
        $ci = -1;
        $oi = -1;
        $rets = [];
        foreach ($menus as $mi => $menu) {
            $parent = $menu['parent_id'] ?? NULL;
            if (!is_null($parent)) {
                $order = $ci++;
            } else {
                $ci = 0;
                $order = $oi + 1;
                $oi++;
            }
            $query = "INSERT INTO header_menu (id, menu_text, menu_url, menu_parent, menu_order) VALUES (?,?,?,?,?)";
            $ret[] = $this->get_database_connector()->insert($query, 'issii', array($mi, $menu['name'], $menu['url'], $parent, $order));
        }
        return $rets;
    }

    /**
     * Truncate / clear the `header_menu` table from the database
     * to prepare for new entries
     */
    public function clear_header_table() {
        $query = "TRUNCATE TABLE header_menu";
        $this->get_database_connector()->runBaseQuery($query);
    }

    /**
     * Update the casino card entries
     * @param array $post The $_POST request
     * @param array Errors from the queries responses are added to the array
     */
    public function update_casino_cards(array $post) : array {
        $q_res = [];
        $cards = [ 0 => 'c', 1 => 'l', 2 => 'r' ];
        foreach ($cards as $i => $c) {
            $query = "UPDATE casino_cards SET casino_name = ?, plan_id = ?, plan_rating = ?, plan_price = ?, plan_currency = ?, terms_text = ?, plan_description = ?, cta_text = ?, cta_url = ?, review_btn_text = ?, review_btn_url = ? WHERE card_order = ?";
            $q_res[] = $this->get_database_connector()->update($query, 'sssiissssssi', array($post[$c . '-casino-name'], $post[$c . '-casino-id'], $post[$c . '-casino-rating'], $post[$c . '-casino-price'], $post[$c . '-casino-currency'], $post[$c . '-casino-tc'], $post[$c . '-casino-desc'], $post[$c . '-casino-cta-text'], $post[$c . '-casino-cta-url'], $post[$c . '-casino-review-text'], $post[$c . '-casino-review-url'], $i));
        }
        
        return $q_res;
    }
    
}

?>
