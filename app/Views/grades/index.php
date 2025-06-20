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
        <h1 class="h3 fw-bold">Grades List</h1>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item active">Grades</li>
            </ol>
        </nav>
    </div>

    <section class="content">
        <div class="card border-0 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
    <div class="icon-circle me-2">
        <i class="fas fa-clipboard-check"></i>
    </div>
    <h3 class="card-title m-0 fw-semibold">Student Grades</h3>
</div>

                <?php if (in_array(session()->get('role'), ['admin', 'teacher'])): ?>
                    <a href="<?= site_url('grades/add') ?>" class="btn btn-primary btn-sm">Add Grade</a>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <?php if (empty($grades)): ?>
                    <div class="alert alert-warning">
                        No grades found! Please add some grades.
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th>
                                    <th>Year Start</th>
                                    <th>Year End</th>
                                    <th>1st Sem Grade</th>
                                    <th>2nd Sem Grade</th>
                                    <th style="width: 150px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($grades as $grade): ?>
                                <tr>
                                    <td><?= $grade['grades_id'] ?></td>
                                    <td><?= $grade['first_name'] . ' ' . $grade['last_name'] ?></td>
                                    <td><?= $grade['year_start'] ?></td>
                                    <td><?= $grade['year_end'] ?></td>
                                    <td><?= $grade['grade_first_sem'] ?></td>
                                    <td><?= $grade['grade_second_sem'] ?></td>
                                    <td>
                                        <?php if (in_array(session()->get('role'), ['admin', 'teacher'])): ?>
                                            <a href="<?= site_url('grades/edit/' . $grade['grades_id']) ?>" class="btn btn-sm btn-outline-info me-1">Edit</a>
                                        <?php endif; ?>
                                        <?php if (session()->get('role') === 'admin'): ?>
                                            <a href="<?= site_url('grades/delete/' . $grade['grades_id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</a>
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
