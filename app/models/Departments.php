<?php

/**
 * Departments model
 */
class Departments extends Model
{
    private $table = 'departments';

    public function getDepartments()
    {
        $departments = $this->getall($this->table);

        return $departments;
    }
    public function createDepartment($data)
    {
        $department = $this->create($this->table,$data);

        return $department;
    }

    public function department($id)
    {
        $department = $this->single($this->table,$id);

        return $department;
    }

    public function updateDepartment($data, $id)
    {
        $entry = $this->update($this->table, $data, $id);

        return $entry;
    }

    public function deleteDepartment($id)
    {
        $this->delete($this->table,$id);

        return true;
    }
}