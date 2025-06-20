<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\StudentModel;

class StudentsApi extends ResourceController
{
    protected $modelName = 'App\Models\StudentModel';
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $student = $this->model->find($id);
        return $student ? $this->respond($student) : $this->failNotFound('Student not found.');
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        if (!$this->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'phone_number'  => 'required|regex_match[/^(09\d{9}|\+63\d{10})$/]',
            'email'         => 'required|valid_email',
            'age'           => 'required|numeric',
            'address'       => 'required',
            'courses_id'    => 'required|numeric'
        ])) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $this->model->insert($data);
        return $this->respondCreated(['message' => 'Student created']);
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        if (!$this->model->find($id)) {
            return $this->failNotFound('Student not found');
        }

        if (!$this->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'phone_number'  => 'required|regex_match[/^(09\d{9}|\+63\d{10})$/]',
            'email'         => 'required|valid_email',
            'age'           => 'required|numeric',
            'address'       => 'required',
            'courses_id'    => 'required|numeric'
        ])) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $this->model->update($id, $data);
        return $this->respond(['message' => 'Student updated']);
    }

    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('Student not found');
        }

        $this->model->delete($id);
        return $this->respondDeleted(['message' => 'Student deleted']);
    }
}
