<?php

class UserController extends Controller
{
    private User $userModel;
    private AuditLog $auditLog;

    public function __construct()
    {
        $this->requireAuth(['admin']);
        $this->userModel = $this->model('User');
        $this->auditLog = $this->model('AuditLog');
    }

    public function index(): void
    {
        $this->view('admin/users', ['users' => $this->userModel->all()]);
    }

    public function delete($id): void
    {
        $user = $this->userModel->find((int) $id);
        if ($user && $this->userModel->delete((int) $id)) {
            $this->auditLog->create(['user_id' => $_SESSION['user']['id'], 'action' => 'Deleted user: ' . $user['email']]);
        }

        $this->redirect('user/index');
    }
}
