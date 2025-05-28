<?php

/**
 * Departments controller
 */

require_once '../app/models/Departments.php';
class DepartmentsController extends Controller
{
    public function index()
    {
        $department = new Departments;

        $departments = $department->getDepartments();

        return $this->json([
            'status' => 'success',
            'message' => 'Departments list',
            'data' => [
                'departments' => $departments
            ]
        ]);
    }

    public function store($values)
    {
        if ($_SESSION['logged_in_user']->role != 'admin')
        {
            return $this->json([
                'status' => 'error',
                'message' => 'Unauthorized request',
                'data' => []
            ],401);
        }
        if (!isset($values['name']))
        {
            return $this->json([
                'status' => 'error',
                'message' => ['Name is required'],
                'data' => [
                    'department' => []
                ]
            ],422);
        }
        $data = [
            'name' => $values['name']
        ];

        $department = new Departments;

        $details = $department->createDepartment($data);

        return $this->json([
            'status' => 'success',
            'message' => 'Department created successfully',
            'data' => [
                'department' => $details
            ]
        ]);
    }

    public function show($id)
    {
        $department = new Departments;

        $details = $department->department($id);

        if ($details)
        {
            return $this->json([
                'status' => 'success',
                'message' => 'Department details',
                'data' => [
                    'department' => $details
                ]
            ]);
        }
        else{
            return $this->json([
                'status' => 'error',
                'message' => 'Not found',
                'data' => [
                    'department' => []
                ]
            ],404);
        }

    }

    public function update($post,$id)
    {
        if ($_SESSION['logged_in_user']->role != 'admin')
        {
            return $this->json([
                'status' => 'error',
                'message' => 'Unauthorized request',
                'data' => []
            ],401);
        }
        if (!isset($post['name']))
        {
            return $this->json([
                'status' => 'error',
                'message' => 'Name is required',
                'data' => [
                    'department' => []
                ]
            ],422);
        }
        $department = new Departments;

        $details = $department->department($id);

        if (!$details)
        {
            return $this->json([
                'status' => 'error',
                'message' => 'Not found',
                'data' => [
                    'department' => []
                ]
            ],404);
        }


        $data = [
            'name' => isset($post['name']) ? $post['name']: null
        ];

        $updateDetails = $department->updateDepartment($data,$id);

        return $this->json([
            'status' => 'success',
            'message' => 'Department updated successfully',
            'data' => [
                'department' => $updateDetails
            ]
        ]);

    }

    public function destroy($id)
    {
        if ($_SESSION['logged_in_user']->role != 'admin')
        {
            return $this->json([
                'status' => 'error',
                'message' => 'Unauthorized request',
                'data' => []
            ],401);
        }

        if (!$id) {
            return $this->json('Please provide an id',400);
        }

        $department = new Departments;
        $details = $department->department($id);

        if (!$details) {
            return $this->json('No department found!',400);
        }

        $department->deleteDepartment($id);

        return $this->json([
            'status' => 'success',
            'message' => 'Department deleted successfully',
            'data' => []
        ], 200);
    }
}