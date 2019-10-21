<?php
namespace cars\Controllers;
class AdminController
{
    private $staffTable;
    private $manufacturersTable;
    private $get;
    private $post;

    public function __construct($staffTable, $manufacturersTable, array $get, array $post)
    {
        $this->staffTable = $staffTable;
        $this->manufacturersTable = $manufacturersTable;
        $this->get = $get;
        $this->post = $post;
    }

    public function loginForm($error = '')
    {
            return [
                'template' => 'loginForm.html.php',
                'variables' => ['error' => $error],
                'title' => "Claires's Cars - Admin"
            ];
    }

    public function loggedIn() {
        return [
            'template' => 'loggedin.html.php',
            'variables' => ['' => ""],
            'title' => "Claires's Cars - Admin"
        ];
    }

    public function loginSubmit()
    {
        if (!empty($this->post['login']['name']) && !empty($this->post['login']['password'])){
            if($this->staffTable->find('name', $this->post['login']['name'])) {
            $staff = $this->staffTable->find('name', $this->post['login']['name']);
            $hashed = $staff[0]->password;
            if (password_verify($this->post['login']['password'], $hashed)) {
                $_SESSION['loggedin'] = true;
                $_SESSION['staffId'] = $staff[0]->id;
                $_SESSION['usertype'] = $staff[0]->usertype;
                header('location: /admin/home');
            } else {
                $error = 'Invalid password.';
                return $this->loginForm($error);
            }
        } else {
                $error = 'Name or Password was Invalid';
                return $this->loginForm($error);
            }
        } else {
            $error = 'Name or Password was Empty or Invalid';
            return $this->loginForm($error);
        }
    }

    public function logout()
    {
        $_SESSION = array();
        session_destroy();
        header('location: /');
    }

    public function manufacturers()
    {
        $categories = $this->manufacturersTable->findAll('manufacturers');
        return [
            'template' => 'manufacturers.html.php',
            'variables' => ['categories' => $categories],
            'title' => "Claires's Cars - Admin"
        ];
    }

    public function addManufacturersForm($errors = [])
    {
        if  (isset($this->get['id'])) {
            $result = $this->manufacturersTable->find('id', $this->get['id']);
            $currentMan = $result[0];
        }
        else  {
            $currentMan = false;
        }

        return [
            'template' => 'editmanufacturers.html.php',
            'variables' => ['currentMan' => $currentMan,
                            'errors' => $errors],
            'title' => "Claires's Cars - Admin"
        ];
    }

    public function validateManufacturer($manufacturer) {
        $errors = [];
        if ($manufacturer['name'] == '') {
            $errors[] = 'You must enter a Manufactuer name';
        }
        $manufacturers = $this->manufacturersTable->findAll();
        foreach ($manufacturers as $row) {
            if ($manufacturer['name'] == $row->name) {
                $errors[] = 'Manufactuer name already in use';
            }
        }

        return $errors;
    }

    public function submitManufacturers()
    {
        $errors = $this->validateManufacturer($this->post['manufacturer']);
        if (count($errors) == 0) {
            $this->manufacturersTable->save($this->post['manufacturer']);
        } else {
            return $this->addManufacturersForm($errors);
        }
        return $this->manufacturers();
    }

    public function deleteManufacturer()
    {
        $this->manufacturersTable->delete($this->post['id']);
        header('location: /admin/manufacturers');
    }

    public function viewStaff($errors = []) {
        $staff = $this->staffTable->findAll();
        return [
            'template' => 'staff.html.php',
            'variables' => ['staff' => $staff,
                            'errors' => $errors],
            'title' => "Claires's Cars - Admin"
        ];
    }

    public function editStaff($errors = []) {
        if (isset($_GET['id'])){
            $staff = $this->staffTable->find('id', $this->get['id'])[0];
        } else {
            $staff = false;
        }
        return [
            'template' => 'editstaff.html.php',
            'variables' => ['staff' => $staff,
                            'errors' => $errors],
            'title' => "Claires's Cars - Admin"
        ];
    }

    public function validateStaff($staff) {
        $errors = [];
        if ($staff['name'] == '') {
            $errors[] = 'You must enter a staff name';
        }
        if (isset($staff['password']) && $staff['password'] == '') {
            $errors[] = 'You must enter a staff password';
        }
        if ($this->staffTable->find('name', $staff['name']))
        {
            $errors[] = 'Name Already Inuse';
        }
        return $errors;
    }

    public function saveStaff() {
        $errors = $this->validateStaff($this->post{'staff'});
        $staff = $this->post['staff'];
        if (isset($staff['password']))
        $staff['password'] = password_hash($staff['password'], PASSWORD_DEFAULT);
        if (count($errors) == 0) {
            $this->staffTable->save($staff);
            header('location: /admin/staff');
        } else {
            return $this->editStaff($errors);
        }
    }

    public function deleteStaff() {
            $this->staffTable->delete($this->post['id']);
            echo 'Deleted';
            header('location: /admin/staff');
    }

    public function displayPasswordEditForm() {
        if (isset($_POST['id'])){
            $staff = $this->staffTable->find('id', $this->post['id'])[0];
        } else {
            header('location: /admin/staff');
        }
        return [
            'template' => 'editstaffpassword.html.php',
            'variables' => ['staff' => $staff],
            'title' => "Claires's Cars - Admin"
        ];
    }

    public function validateStaffPasswordForm($staff) {
        $errors = [];
        if ($staff['password'] == '') {
            $errors[] = 'The password must not be blank';
        }
        return $errors;
    }

    public function saveStaffPassword() {
        $errors = $this->validateStaffPasswordForm($this->post['staff']);
        if (count($errors) == 0) {
            $staff = $this->post['staff'];
            $staff['password'] = password_hash($staff['password'], PASSWORD_DEFAULT);
            $this->staffTable->save($staff);
            header('location: /admin/staff');
        } else {
            return $this->viewStaff($errors);
        }

    }

}
