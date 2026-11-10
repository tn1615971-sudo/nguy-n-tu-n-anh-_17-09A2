<?php
// app/controllers/AccountController.php
// Khu vuc ca nhan cua khach hang: bat buoc dang nhap
class AccountController extends Controller
{
    public function __construct()
    {
        Auth::requireLogin();
    }
    public function profile(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleUpdate();
            return;
        }
        $user = User::find(Auth::id());
        if (!$user) {
            Auth::logout();
            $this->redirect('auth/login');
            return;
        }
        $this->view('account/profile', ['pageTitle' => 'Hồ sơ cá nhân', 'user' => $user]);
    }
    protected function handleUpdate(): void
    {
        verify_csrf($_POST['csrf_token'] ?? '');
        $fullName = trim($_POST['full_name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $errors = [];
        if ($fullName === '' || mb_strlen($fullName) > 150) {
            $errors[] = 'Họ tên không được để trống và tối đa 150 ký tự.';
        }
        if ($phone !== '' && !preg_match('/^[0-9+\s.-]{8,20}$/', $phone)) {
            $errors[] = 'Số điện thoại không hợp lệ.';
        }
        if (mb_strlen($address) > 255) {
            $errors[] = 'Địa chỉ tối đa 255 ký tự.';
        }
        if ($errors) {
            flash('error', implode('<br>', array_map('e', $errors)));
            $this->redirect('account/profile');
            return;
        }
        User::update(Auth::id(), [
            'full_name' => $fullName,
            'phone' => $phone === '' ? null : $phone,
            'address' => $address === '' ? null : $address,
        ]);
        $_SESSION['user']['full_name'] = $fullName;
        flash('success', 'Đã cập nhật hồ sơ cá nhân.');
        $this->redirect('account/profile');
    }
}
