<?php

/**
 * notes model
 */
class Notes extends Model
{
    private $table = 'notes';

    public function getNotes()
    {
        $notes = $this->getall($this->table);

        return $notes;
    }
    public function createNote($data)
    {
        $note = $this->create($this->table,$data);

        return $note;
    }

    public function note($id)
    {
        $note = $this->single($this->table,$id);

        return $note;
    }

    public function updateNote($data, $id)
    {
        $entry = $this->update($this->table, $data, $id);

        return $entry;
    }

    public function deleteNote($id)
    {
        $this->delete($this->table,$id);

        return true;
    }
}