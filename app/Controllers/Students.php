<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\CourseModel;

class Students extends BaseController
{
    protected $helpers = ['form'];

    private function ensureLoggedIn()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/authorize/login');
        }
    }

    private function ensureRole(array $allowedRoles)
    {
        $role = session()->get('role');
        if (!in_array($role, $allowedRoles)) {
            return redirect()->back()->with('error', 'Access denied.');
        }
    }

    public function index()
    {
        if ($redirect = $this->ensureLoggedIn()) return $redirect;
        if ($redirect = $this->ensureRole(['admin', 'teacher'])) return $redirect;

        $studentModel = new StudentModel();
        $courseModel = new CourseModel();

        $builder = $studentModel->builder();
        $builder->select('students.*, courses.course_name');
        $builder->join('courses', 'students.courses_id = courses.course_id', 'left');
        $students = $builder->get()->getResultArray();

        $data['students'] = $students;

        return view('students/index', $data);
    }

    public function add()
    {
        if ($redirect = $this->ensureLoggedIn()) return $redirect;
        if ($redirect = $this->ensureRole(['admin'])) return $redirect;

        $courseModel = new CourseModel();
        $data['courses'] = $courseModel->findAll();

        return view('students/add', $data);
    }

    public function store()
    {
        if ($redirect = $this->ensureLoggedIn()) return $redirect;
        if ($redirect = $this->ensureRole(['admin', 'teacher'])) return $redirect;

        $validation = \Config\Services::validation();
        $rules = [
            'first_name'    => 'required',
            'last_name'     => 'required',
            'phone_number'  => 'required|regex_match[/^(09\d{9}|\+63\d{10})$/]',
            'email'         => 'required|valid_email',
            'age'           => 'required|numeric',
            'address'       => 'required',
            'courses_id'    => 'required' 
        ];

        if (!$this->validate($rules)) {
            $courseModel = new CourseModel();
            $data['courses'] = $courseModel->findAll();
            $data['validation'] = $validation;
            return view('students/add', $data);
        }

        $model = new StudentModel();
        $imageFile = $this->request->getFile('image');
$imageData = null;

if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
    $imageData = file_get_contents($imageFile->getTempName());
}

$data = [
    'first_name'   => $this->request->getPost('first_name'),
    'last_name'    => $this->request->getPost('last_name'),
    'phone_number' => $this->request->getPost('phone_number'),
    'email'        => $this->request->getPost('email'),
    'age'          => $this->request->getPost('age'),
    'address'      => $this->request->getPost('address'),
    'courses_id'   => $this->request->getPost('courses_id'),
    'image'        => $imageData
];

$model->save($data);


        return redirect()->to('/students')->with('success', 'Student added successfully.');
    }

    public function edit($students_id)
    {
        if ($redirect = $this->ensureLoggedIn()) return $redirect;
        if ($redirect = $this->ensureRole(['admin', 'teacher'])) return $redirect;

        $model = new StudentModel();
        $data['student'] = $model->find($students_id); 

        if (!$data['student']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Student not found');
        }

        $courseModel = new CourseModel();
        $data['courses'] = $courseModel->findAll();

        return view('students/edit', $data);
    }

    public function update($students_id)
    {
        if ($redirect = $this->ensureLoggedIn()) return $redirect;
        if ($redirect = $this->ensureRole(['admin', 'teacher'])) return $redirect;

        $validation = \Config\Services::validation();
        $rules = [
            'first_name'    => 'required',
            'last_name'     => 'required',
            'phone_number'  => 'required|regex_match[/^(09\d{9}|\+63\d{10})$/]',
            'email'         => 'required|valid_email',
            'age'           => 'required|numeric',
            'address'       => 'required',
            'courses_id'    => 'required' 
        ];

        $model = new StudentModel();
        if (!$this->validate($rules)) {
            $data['student'] = $model->find($students_id);
            $courseModel = new CourseModel();
            $data['courses'] = $courseModel->findAll();
            $data['validation'] = $validation;
            return view('students/edit', $data);
        }

        $imageFile = $this->request->getFile('image');
$imageData = null;

if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
    $imageData = file_get_contents($imageFile->getTempName());
}

$data = [
    'first_name'   => $this->request->getPost('first_name'),
    'last_name'    => $this->request->getPost('last_name'),
    'phone_number' => $this->request->getPost('phone_number'),
    'email'        => $this->request->getPost('email'),
    'age'          => $this->request->getPost('age'),
    'address'      => $this->request->getPost('address'),
    'courses_id'   => $this->request->getPost('courses_id'),
];

if ($imageData !== null) {
    $data['image'] = $imageData;
}

$model->update($students_id, $data);


        return redirect()->to('/students')->with('success', 'Student updated successfully.');
    }

    public function delete($students_id)
    {
        if ($redirect = $this->ensureLoggedIn()) return $redirect;
        if ($redirect = $this->ensureRole(['admin'])) return $redirect;

        $model = new StudentModel();
        $model->delete($students_id);

        return redirect()->to('/students')->with('success', 'Student deleted successfully.');
    }
}
