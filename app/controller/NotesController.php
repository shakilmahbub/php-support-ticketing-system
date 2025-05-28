<?php

/**
 * notes controller
 */

require_once '../app/models/Notes.php';
class NotesController extends Controller
{
    public function index()
    {
        $note = new Notes;

        $notes = $note->getnotes();

        return $this->json([
            'status' => 'success',
            'message' => 'Notes list',
            'data' => [
                'notes' => $notes
            ]
        ]);
    }

    public function store($values)
    {
        $errors = false;
        $message = [];
        if (!isset($values['note']))
        {
            $errors = true;
            $message[] = 'Note is required';
        }
        if (!isset($values['ticket_id']))
        {
            $errors = true;
            $message[] = 'Ticket id is required';
        }

        if ($errors)
        {
            return $this->json([
                'status' => 'error',
                'message' => $message,
                'data' => [
                    'note' => []
                ]
            ],422);
        }

        $data = [
            'note' => isset($values['note']) ? $values['note']: null,
            'ticket_id' => isset($values['ticket_id']) ? $values['ticket_id']: null,
            'user_id' => $_SESSION['logged_in_user']->id,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $note = new Notes;

        $details = $note->createnote($data);

        return $this->json([
            'status' => 'success',
            'message' => 'Note created successfully',
            'data' => [
                'note' => $details
            ]
        ]);
    }

    public function show($id)
    {
        $note = new Notes;

        $details = $note->note($id);

        if (!$details)
        {
            return $this->json([
                'status' => 'error',
                'message' => 'Not found',
                'data' => [
                    'note' => []
                ]
            ],404);
        }

        return $this->json([
            'status' => 'success',
            'message' => 'Note details',
            'data' => [
                'note' => $details
            ]
        ]);
    }

    public function update($values,$id)
    {
        $note = new Notes;

        $details = $note->note($id);

        if (!$details)
        {
            return $this->json([
                'status' => 'error',
                'message' => 'Note Not found',
                'data' => [
                    'note' => []
                ]
            ],404);
        }

        $data = [
            'note' => isset($values['note']) ? $values['note']: null,
            'ticket_id' => isset($values['ticket_id']) ? $values['ticket_id']: null
        ];

        $updateDetails = $note->updatenote($data,$id);

        return $this->json([
            'status' => 'success',
            'message' => 'Note updated successfully',
            'data' => [
                'note' => $updateDetails
            ]
        ]);

    }

    public function destroy($id)
    {
        if(!$id)
        {
            return $this->json('Please provide an id',400);
        }

        $note = new Notes;
        $details = $note->note($id);

        if (!$details) {
            return $this->json('No note found!',400);
        }

        $note->deletenote($id);

        return $this->json([
            'status' => 'success',
            'message' => 'Note deleted successfully',
            'data' => []
        ], 200);
    }
}