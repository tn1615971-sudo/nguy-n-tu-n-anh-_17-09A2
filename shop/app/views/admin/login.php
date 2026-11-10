<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? 'Đăng nhập quản trị') ?> - Shop Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h1 class="h4 mb-4 text-center">Shop<span class="text-primary">Admin</span></h1>
                        <?php if ($f = flash('error')): ?>
                            <div class="alert alert-danger"><?= $f['message'] ?></div>
                        <?php endif; ?>
                        <?php if ($f = flash('success')): ?>
                            <div class="alert alert-success"><?= $f['message'] ?></div>
                        <?php endif; ?>
                        <form method="POST" action="<?= e(base_url('admin/auth/login')) ?>">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mật khẩu</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                        </form>
                        <p class="text-center mt-3 mb-0 small"><a href="<?= e(base_url('')) ?>">&larr; Về trang khách</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
