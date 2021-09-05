<?php

class Model 
{
    protected $pdo;

    protected $table;
    protected $fields;

    public function __construct(Pdo $pdo)
    {
        $this->pdo = $pdo;

        if(!$this->table || !$this->fields) throw new Exception(sprintf("You must configure table and field properties of class %s", get_class($this)));
    
    }

    public function createTable()
    {
        $fields = "";
        foreach ($this->fields as $field => $settings) {
            $fields .= "{$field} {$settings}, ";
        }

        $query = "CREATE TABLE IF NOT EXISTS {$this->table} (id INTEGER NOT NULL, {$fields} PRIMARY KEY(id AUTOINCREMENT))";

        $this->pdo->exec($query);
    }

    public function create(array $data)
    {
        $fields = "";
        $values = "";
        $i = 1;

        foreach ($data as $field => $value) {
            $comma = $i === count($data) ? "" : ", ";
            $fields .= "{$field}{$comma}";
            $values .= ":{$field}{$comma}";
            $i++;
        }

        $query = "INSERT INTO {$this->table} ({$fields}) VALUES ({$values})";

        return $this->query($query, $data);
    }

    public function query(string $query, array $data)
    {

        $stmt = $this->pdo->prepare($query);

        foreach ($data as $field => &$value) {
            
            $stmt->bindParam(':' . $field, $value, PDO::PARAM_STR);

        }

        return $stmt->execute();
    }

}