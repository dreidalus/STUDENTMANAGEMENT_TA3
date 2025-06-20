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
        <h1 class="h3 fw-bold">Course List</h1>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item active">Courses</li>
            </ol>
        </nav>
    </div>

    <section class="content">
        <div class="card border-0 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
    <div class="icon-circle me-2">
        <i class="fas fa-book"></i>
    </div>
    <h3 class="card-title m-0">Available Courses</h3>
</div>

                <?php if (in_array(session()->get('role'), ['admin', 'teacher'])): ?>
                    <a href="/courses/add" class="btn btn-primary btn-sm">Add a Course</a>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('message')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('message') ?>
                    </div>
                <?php endif; ?>

                <?php if (empty($courses)): ?>
                    <div class="alert alert-warning">
                        No courses found! Please add some courses.
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Course Name</th>
                                    <th>Course Code</th>
                                    <th>Description</th>
                                    <th style="width: 150px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($courses as $course): ?>
                                <tr>
                                    <td><?= $course['course_id'] ?></td>
                                    <td><?= $course['course_name'] ?></td>
                                    <td><?= $course['course_code'] ?></td>
                                    <td><?= $course['course_description'] ?></td>
                                    <td>
                                        <?php if (in_array(session()->get('role'), ['admin', 'teacher'])): ?>
                                            <a href="/courses/edit/<?= $course['course_id'] ?>" class="btn btn-sm btn-outline-info me-1">Edit</a>
                                        <?php endif; ?>
                                        <?php if (session()->get('role') === 'admin'): ?>
                                            <a href="/courses/delete/<?= $course['course_id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</a>
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
