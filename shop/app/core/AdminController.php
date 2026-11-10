<?php
// app/core/AdminController.php
// Moi controller trong khu vuc /admin ke thua lop nay (tru AdminAuthController)
// de tu dong duoc bao ve boi Auth::requireRole() va dung layout rieng.
abstract class AdminController extends Controller
{
    public function __construct()
    {
        // Chua dang nhap -> ve trang dang nhap QUAN TRI; sai vai tro -> 403
        Auth::requireRole(['admin', 'staff'], 'admin/auth/login');
    }
    protected function view(string $view, array $data = [], string|false
    $layout = 'admin'): void
    {
        parent::view($view, $data, $layout);
    }
}
