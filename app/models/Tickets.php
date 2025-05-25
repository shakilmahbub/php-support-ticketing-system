<?php

/**
 * Tickets model
 */
class Tickets extends Model
{
    private $table = 'tickets';

    public function getTickets()
    {
        $tickets = $this->getall($this->table);

        return $tickets;
    }
    public function createTicket($data)
    {
        $ticket = $this->create($this->table,$data);

        return $ticket;
    }

    public function ticket($id)
    {
        $ticket = $this->single($this->table,$id);

        return $ticket;
    }

    public function updateTicket($data, $id)
    {
        $entry = $this->update($this->table, $data, $id);

        return $entry;
    }

    public function deleteTicket($id)
    {
        $this->delete($this->table,$id);

        return true;
    }

}