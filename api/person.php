<?php
class Person
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function createPerson(array $data)
    {
        
        $sql = "INSERT INTO persons (name, phone, email) VALUES (:name, :phone, :email)";
        $this->db->query($sql);

        $this->db->bind(':name', $data['name'], PDO::PARAM_STR);
        $this->db->bind(':phone', $data['phone'], PDO::PARAM_STR);
        $this->db->bind(':email', $data['email'], PDO::PARAM_STR);

        try {
            $exec = $this->db->execute();
            if ($exec) {
                return true;
            } else {
                return $exec;
            }
        } catch (\PDOException $e) {
            return $e;
        }
    }

    public function getPerson($id)
    {
        $sql = "SELECT * FROM persons WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id);

        $result = $this->db->single();

        if (!$result) {
            $sql = "SELECT * FROM persons WHERE name LIKE :name";
            $this->db->query($sql);
            $this->db->bind(':name', '%' . urldecode($id) . '%', PDO::PARAM_STR);

            try {
                $result = $this->db->single();
                $this->db = null;
                return $result;
            } catch (\PDOException $e) {
                return $e->errorInfo[2];
            }
        }

        return $result;
    }

    public function updatePerson($id, $data)
    {
        $upStrings = [];
        if ($data['name'] !== null) {
            $upStrings[] = 'name = :name';
        }

        if ($data['phone'] !== null) {
            $upStrings[] = 'phone = :phone';
        }

        if ($data['email'] !== null) {
            $upStrings[] = 'email = :email';
        }
        if (empty($upStrings)) {
            return false;
        }
        $sql = "UPDATE persons SET " . implode(', ', $upStrings) . " WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id);

        if ($data['name'] !== null) {
            $this->db->bind(':name', $data['name'], PDO::PARAM_STR);
        }

        if ($data['phone'] !== null) {
            $this->db->bind(':phone', $data['phone'], PDO::PARAM_STR);
        }

        if ($data['email'] !== null) {
            $this->db->bind(':email', $data['email'], PDO::PARAM_STR);
        }
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePerson($id)
    {
        $sql = "DELETE FROM persons WHERE id = :id";
        $this->db->query($sql);

        $this->db->bind(':id', $id);
        
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
