<?php

class EmployeeController extends Controller
{
    public function index()
    {
        $data['emp'] = $this->model('Employee')->getAllEmployee();
        $data['judul'] = 'Employee';
        $this->view('components/header', $data);
        $this->view('employee/index', $data);
        $this->view('components/footer');
    }

    public function all()
    {
        $data = $this->model('Employee')->getAllEmployee();
        echo json_encode($data);
    }

    public function detail($id)
    {
        $data['emp'] = $this->model('Employee')->getEmployeeById($id);
        $data['judul'] = 'Employee';
        $this->view('components/header', $data);
        $this->view('employee/detail', $data);
        $this->view('components/footer');
    }

    public function tambah()
    {
        if ($this->model('Employee')->addEmployee($_POST) > 0) {
            Swal::setSwal('Berhasil', 'Berhasil menambahkan data', 'success');
            header('Location: ' . BASEURL . '/employee');
            exit;
        } else {
            Swal::setSwal('Gagal', 'Gagal menambahkan data', 'error');
            header('Location: ' . BASEURL . '/employee');
            exit;
        }
    }

    public function hapus($id)
    {
        if ($this->model('Employee')->deleteEmployee($id) > 0) {
            Swal::setSwal('Berhasil', 'Berhasil menghapus data', 'success');
            header('Location: ' . BASEURL . '/employee');
            exit;
        } else {
            Swal::setSwal('Gagal', 'Gagal menghapus data', 'error');
            header('Location: ' . BASEURL . '/employee');
            exit;
        }
    }

    public function edit($id)
    {
        if ($this->model('Employee')->getEmployeeById($id)) {
            if ($this->model('Employee')->updateEmployee($_POST) > 0) {
                Swal::setSwal('Berhasil', 'Berhasil mengubah data', 'success');
                header('Location: ' . BASEURL . '/employee');
                exit;
            } else {
                Swal::setSwal('Gagal', 'Gagal mengubah data', 'error');
                header('Location: ' . BASEURL . '/employee');
                exit;
            }
        } else {
            Swal::setSwal('Gagal', 'Data tidak ada', 'error');
            header('Location: ' . BASEURL . '/employee');
            exit;
        }
    }

    public function search()
    {
        $data['emp'] = $this->model('Employee')->searchEmployee();
        $data['judul'] = 'Employee';
        $this->view('components/header', $data);
        $this->view('employee/index', $data);
        $this->view('components/footer');
    }
}
