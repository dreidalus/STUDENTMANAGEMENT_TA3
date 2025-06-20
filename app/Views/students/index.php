<?= $this->include('templates/header') ?>

<style>
    body {
        background-color: #f3e8ff;
    }

    .content-wrapper {
        background-color: #ffffff;
        border-radius: 15px;
        padding: 2rem;
        margin-top: 1rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: #a78bfa;
        border-color: #a78bfa;
    }

    .btn-primary:hover {
        background-color: #8b5cf6;
        border-color: #8b5cf6;
    }

    .btn-outline-info {
        color: #8b5cf6;
        border-color: #8b5cf6;
    }

    .btn-outline-info:hover {
        background-color: #8b5cf6;
        color: white;
    }

    .btn-outline-danger {
        color: #ef4444;
        border-color: #ef4444;
    }

    .btn-outline-danger:hover {
        background-color: #ef4444;
        color: white;
    }

    .card-header {
        background-color: #ede9fe;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .card-title {
        color: #6b21a8;
    }

    .breadcrumb-item > a {
        color: #8b5cf6;
    }


    .table thead {
        background-color: white;
    }

    .table thead:hover {
        background-color: #ede9fe;
    }
    .icon-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #ede9fe;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    color: #6b21a8;
}
</style>

<div class="content-wrapper container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold">Student List</h1>
        <nav>
            <ol class="breadcrumb mb-0">

                <li class="breadcrumb-item active">Students</li>
            </ol>
        </nav>
    </div>

    <section class="content">
        <div class="card border-0 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
        <div class="icon-circle me-2">
            <i class="fas fa-user-graduate"></i>
        </div>
        <h3 class="card-title m-0">Students</h3>
    </div>
    <a href="<?= site_url('students/add') ?>" class="btn btn-primary btn-sm">Add Student</a>
</div>

            <div class="card-body">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <?php if (empty($students)): ?>
                    <div class="alert alert-warning">
                        No students found! Please add some students.
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Age</th>
                                    <th>Address</th>
                                    <th>Image</th>
                                    <th>Course</th>
                                    <th style="width: 150px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($students as $student): ?>
                                <tr>
                                    <td><?= $student['students_id'] ?></td>
                                    <td><?= $student['first_name'] ?></td>
                                    <td><?= $student['last_name'] ?></td>
                                    <td><?= $student['phone_number'] ?></td>
                                    <td><?= $student['email'] ?></td>
                                    <td><?= $student['age'] ?></td>
                                    <td><?= $student['address'] ?></td>
                                    <td>
                                    <?php if ($student['image']): ?>
                                    <img src="data:image/jpeg;base64,<?= base64_encode($student['image']) ?>" width="50" height="50" style="object-fit: cover; border-radius: 5px;">
                                    <?php else: ?>
                                    <span class="text-muted">No Profile</span>
                                    <?php endif; ?>
                                    </td>

                                    <td><?= $student['course_name'] ?></td>
                                    <td>
                                        <a href="<?= site_url('students/edit/' . $student['students_id']) ?>" class="btn btn-sm btn-outline-info me-1">Edit</a>
                                        <?php if (session()->get('role') === 'admin'): ?>
                                        <a href="<?= site_url('students/delete/' . $student['students_id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>
