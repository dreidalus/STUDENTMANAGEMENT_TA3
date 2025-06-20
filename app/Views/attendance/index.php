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
    .card {
        border: none;
        border-radius: 15px;
    }
    .card-header {
        background-color: #ede9fe;
        color: #6b21a8;
        border-bottom: 1px solid #ddd;
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
        color: #4f46e5;
        border-color: #c4b5fd;
    }
    .btn-outline-info:hover {
        background-color: #c4b5fd;
        color: white;
    }
    .btn-outline-danger {
        color: #dc2626;
        border-color: #fca5a5;
    }
    .btn-outline-danger:hover {
        background-color: #fca5a5;
        color: white;
    }
    .badge-warning {
        background-color: #facc15;
        color: #000;
    }
    .badge-success {
        background-color: #34d399;
        color: #fff;
    }
    .badge-primary {
        background-color: #a78bfa;
        color: #fff;
    }
    .breadcrumb-item > a {
        color: #8b5cf6;
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
    <div class="content-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h3 fw-bold text-purple">Attendance Records</h1>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item active">Attendance</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="content">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
    <div class="icon-circle me-2">
        <i class="fas fa-calendar-check"></i>
    </div>
    <h3 class="card-title m-0 fw-semibold">All Attendance</h3>
</div>

                <?php if (in_array(session()->get('role'), ['admin', 'teacher'])): ?>
                    <a href="/attendance/add" class="btn btn-primary btn-sm">Add a Record</a>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('message')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('message') ?>
                    </div>
                <?php endif; ?>

                <?php if (empty($attendance)): ?>
                    <div class="alert alert-warning">
                        No attendance records found!
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($attendance as $record): ?>
                                    <tr>
                                        <td><?= $record['attendance_id'] ?></td>
                                        <td><?= $record['student_name'] ?></td>
                                        <td><?= $record['date_today'] ?></td>
                                        <td>
                                            <?php if ($record['status_student'] === 'Absent'): ?>
                                                <span class="badge badge-warning">Absent</span>
                                            <?php elseif ($record['status_student'] === 'Late'): ?>
                                                <span class="badge badge-success">Late</span>
                                            <?php elseif ($record['status_student'] === 'Present'): ?>
                                                <span class="badge badge-primary">Present</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $record['remarks'] ?></td>
                                        <td>
                                            <?php if (in_array(session()->get('role'), ['admin', 'teacher'])): ?>
                                                <a href="/attendance/edit/<?= $record['attendance_id'] ?>" class="btn btn-sm btn-outline-info me-1">Edit</a>
                                            <?php endif; ?>
                                            <?php if (session()->get('role') === 'admin'): ?>
                                                <a href="/attendance/delete/<?= $record['attendance_id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</a>
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
