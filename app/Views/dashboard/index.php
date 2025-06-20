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

    .card-header {
        background-color: #ede9fe;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .card-title {
        color: #6b21a8;
    }

    .card-widget .card-header {
        background-color: #a78bfa !important;
    }

    .btn-danger {
        background-color: #ef4444;
        border-color: #ef4444;
    }

    .btn-danger:hover {
        background-color: #dc2626;
        border-color: #dc2626;
    }

    .breadcrumb-item > a {
        color: #8b5cf6;
    }

    .widget-user h4 {
        font-weight: bold;
        color: #4b5563;
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


.text-purple {
    color: #6b21a8;
}

</style>

<div class="content-wrapper container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold">Dashboard</h1>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>

    <section class="content">
        <div class="card border-0 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
    <div class="icon-circle me-2">
        <i class="fas fa-chart-pie"></i>
    </div>
    <h3 class="card-title m-0">Dashboard Overview</h3>
</div>

            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>

                <div class="row g-4">
    <div class="col-md-6 col-12">
        <div class="card card-widget widget-user shadow-sm border-0">
            <div class="card-header d-flex align-items-center" style="background-color: #a78bfa;">
                <div class="icon-circle me-3">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h3 class="card-title mb-0 text-white">Total Students</h3>
            </div>
            <div class="card-body text-center">
                <h4><?= $studentCount ?></h4>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-12">
        <div class="card card-widget widget-user shadow-sm border-0">
            <div class="card-header d-flex align-items-center" style="background-color: #a78bfa;">
                <div class="icon-circle me-3">
                    <i class="fas fa-book"></i>
                </div>
                <h3 class="card-title mb-0 text-white">Total Courses</h3>
            </div>
            <div class="card-body text-center">
                <h4><?= $courseCount ?></h4>
            </div>
        </div>
    </div>
</div>





                <div class="text-center mt-4">
                    <a href="<?= site_url('auth/logout') ?>" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </section>
</div>
