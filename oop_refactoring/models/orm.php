<?php
class orm
{
    // create connection
    protected $db_config = [];
    protected $connection = null;
    protected $result = '';
    public function __construct(array $config)
    {
        if (@empty($config) || count($config) != 4) {
            throw new Exception("enter config");
        }
        $this->db_config = $config;
    }
    public function create_connection()
    {
        if ($this->connection !== null) {
            return $this->connection;
        }
        list($db_host, $db_user, $db_password, $db_name) = $this->db_config;
        $this->connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
        if (!$this->connection) {
            die("" . mysqli_connect_error());
        } else
            return $this->connection;
    }
    //select * return  array
    public function query($query)
    {
        $this->create_connection();
        $result = mysqli_query($this->connection, $query);
        // print_r($result[0]);
        if ($result) {
            return $result;
        } else
            return throw new Exception("Error Processing Request", 1);
        ;
    }
    public function selectall($table = '', $where = '', $limit = '', $offist = '')
    {
        $query = "SELECT * from `{$table}`";
        $result = $this->query($query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    //return array of result
    public function select($table = '', $fields = '*', $where = '', $limit = '', $offset = '')
    {
        // Sanitize table and fields to prevent SQL injection (basic level)
        $table = mysqli_real_escape_string($this->connection, $table);
        $fields = mysqli_real_escape_string($this->connection, $fields);

        // Build the query dynamically
        $query = "SELECT {$fields} FROM $table ";

        if (!empty($where)) {
            $query .= " WHERE {$where}";
        }

        if (!empty($limit)) {
            $query .= " LIMIT {$limit}";
            if (!empty($offset)) {
                $query .= " OFFSET {$offset}";
            }
        }
        echo $query;
        // Execute the query
        $result = $this->query($query);


        if (!$result) {
            // Handle query errors
            return ['error' => mysqli_error($this->connection)];
        }

        // Fetch and return the result
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    public function update($table = '', $data, $where = '')
    {

        $query = "UPDATE $table Set  $data where $where";
        // Execute the query
        $result = $this->query($query);
        if (!$result) {
            // Handle query errors
            return ['error' => mysqli_error($this->connection)];
        }
        // Fetch and return the result
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    public function delete($table = '', $where = '')
    {
        // Sanitize table and fields to prevent SQL injection (basic level)
        $table = mysqli_real_escape_string($this->connection, $table);
        // $fields = mysqli_real_escape_string($this->connection, $fields);

        // Build the query dynamically
        $query = "DELETE FROM $table";

        if (!empty($where)) {
            $query .= " WHERE {$where}";
        }



        // Execute the query
        $result = $this->query($query);
        // print_r(mysqli_fetch_array($result, MYSQLI_ASSOC));

        if (!$result) {
            // Handle query errors
            return ['error' => mysqli_error($this->connection)];
        }

        // Fetch and return the result
        return $result;
    }
    public function insert($table = '', array $data)
    {
        $fields = implode(',', array_keys($data));
        $value = implode(',', array_map(array($this, 'check'), array_values($data)));
        // print_r($fields);
        // print_r($value);
        $query = 'INSERT into ' . $table . '(' . $fields . ')' . 'VALUES (' . $value . ') ';
        $result = $this->query($query);
        print_r($result);
        return $result;
    }
    public function check($_arr)
    {
        $_arr = '"' . mysqli_real_escape_string($this->connection, $_arr) . '"';
        return $_arr;
    }

    public function __destruct()
    {
        if (is_null($this->connection)) {
        } else {
            die("" . mysqli_close($this->connection));
        }
    }



}



?>