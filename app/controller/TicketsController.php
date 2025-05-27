<?php

/**
 * Tickets controller
 */

require_once '../app/models/Tickets.php';
class TicketsController extends Controller
{
    public function index()
    {
        $ticket = new Tickets;

        $tickets = $ticket->getTickets();

        return $this->json([
            'status' => 'success',
            'message' => 'Tickets list',
            'data' => [
                'tickets' => $tickets
            ]
        ]);
    }

    public function store($values)
    {
        $errors = false;
        $message = [];
        if (!isset($values['title']))
        {
            $errors = true;
            $message[] = 'Title is required';
        }
        if (!isset($values['user_id']))
        {
            $errors = true;
            $message[] = 'User id is required';
        }
        if (!isset($values['department_id']))
        {
            $errors = true;
            $message[] = 'Department id is required';
        }

        if ($errors)
        {
            return $this->json([
                'status' => 'error',
                'message' => $message,
                'data' => [
                    'ticket' => []
                ]
            ],422);
        }

        $data = [
            'title' => isset($values['title']) ? $values['title']: null,
            'description' => isset($values['description']) ? $values['description']: null,
            'status' => isset($values['status']) ? $values['status']: null,
            'user_id' => isset($values['user_id']) ? $values['user_id']: null,
            'department_id' => isset($values['department_id']) ? $values['department_id']: null,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $ticket = new Tickets;

        $details = $ticket->createTicket($data);

        return $this->json([
            'status' => 'success',
            'message' => 'Ticket created successfully',
            'data' => [
                'ticket' => $details
            ]
        ]);
    }

    public function show($id)
    {
        $ticket = new Tickets;

        $details = $ticket->ticket($id);

        if (!$details)
        {
            return $this->json([
                'status' => 'error',
                'message' => 'Not found',
                'data' => [
                    'ticket' => []
                ]
            ],404);
        }

        $query = Db::connection()->query("SELECT * FROM notes where ticket_id = '$id'");
        $details->notes = $query->fetchAll(PDO::FETCH_OBJ);

        return $this->json([
            'status' => 'success',
            'message' => 'Ticket details',
            'data' => [
                'ticket' => $details
            ]
        ]);
    }

    public function update($post,$id)
    {
        $ticket = new Tickets;

        $details = $ticket->ticket($id);

        if (!$details)
        {
            return $this->json([
                'status' => 'error',
                'message' => 'Not found',
                'data' => [
                    'ticket' => []
                ]
            ],404);
        }

        $data = [
            'title' => isset($post['title']) ? $post['title']: null,
            'description' => isset($post['description']) ? $post['description']: null,
            'status' => isset($post['status']) ? $post['status']: null,
            'user_id' => isset($post['user_id']) ? $post['user_id']: null,
            'department_id' => isset($post['department_id']) ? $post['department_id']: null,
        ];

        $updateDetails = $ticket->updateTicket($data,$id);

        return $this->json([
            'status' => 'success',
            'message' => 'Ticket updated successfully',
            'data' => [
                'ticket' => $updateDetails
            ]
        ]);

    }

    public function destroy($id)
    {
        if(!$id)
        {
            return $this->json('Please provide an id',400);
        }

        $ticket = new Tickets;
        $details = $ticket->ticket($id);

        if (!$details) {
            return $this->json('No ticket found!',400);
        }

        $ticket->deleteTicket($id);

        return $this->json([
            'status' => 'success',
            'message' => 'Ticket deleted successfully',
            'data' => []
        ], 200);
    }


    public function assign($post,$id)
    {
        $ticket = new Tickets;
        $details = $ticket->ticket($id);

        if (!$details)
        {
            return $this->json([
                'status' => 'error',
                'message' => 'Not found',
                'data' => [
                    'ticket' => []
                ]
            ],404);
        }
        $data = [
            'user_id' => $_SESSION['logged_in_user']->id
        ];

        $updateDetails = $ticket->updateTicket($data,$id);

        return $this->json([
            'status' => 'success',
            'message' => 'Ticket assigned successfully',
            'data' => [
                'ticket' => $updateDetails
            ]
        ]);
    }

    public function changeStatus($post,$id)
    {
        $ticket = new Tickets;

        $details = $ticket->ticket($id);

        if (!$details)
        {
            return $this->json([
                'status' => 'error',
                'message' => 'Not found',
                'data' => [
                    'ticket' => []
                ]
            ],404);
        }
        $data = [
            'status' => isset($post['status']) ? $post['status']: null,
        ];

        $updateDetails = $ticket->updateTicket($data,$id);

        return $this->json([
            'status' => 'success',
            'message' => 'Ticket status changed successfully',
            'data' => [
                'ticket' => $updateDetails
            ]
        ]);
    }
}