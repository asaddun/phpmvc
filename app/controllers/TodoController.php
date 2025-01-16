<?php

class TodoController extends Controller
{
    public function index()
    {
        $data['todo'] = $this->model('Todo')->getAllTask();
        $data['judul'] = 'To Do List';
        $this->view('components/header', $data);
        $this->view('todo/index', $data);
        $this->view('components/footer');
    }

    public function detail($id)
    {
        $data['todo'] = $this->model('Todo')->getTaskById($id);
        $data['judul'] = 'To Do List';
        $this->view('components/header', $data);
        $this->view('todo/detail', $data);
        $this->view('components/footer');
    }

    public function tambah()
    {
        if ($this->model('Todo')->addTask($_POST) > 0) {
            Swal::setSwal('Berhasil', 'Berhasil menambahkan data', 'success');
            header('Location: ' . BASEURL . '/todo');
            exit;
        } else {
            Swal::setSwal('Gagal', 'Gagal menambahkan data', 'error');
            header('Location: ' . BASEURL . '/todo');
            exit;
        }
    }

    public function hapus($id)
    {
        if ($this->model('Todo')->deleteTask($id) > 0) {
            Swal::setSwal('Berhasil', 'Berhasil menghapus data', 'success');
            header('Location: ' . BASEURL . '/todo');
            exit;
        } else {
            Swal::setSwal('Gagal', 'Gagal menghapus data', 'error');
            header('Location: ' . BASEURL . '/todo');
            exit;
        }
    }

    public function edit($id)
    {
        if ($this->model('Todo')->getTaskById($id)) {
            if ($this->model('Todo')->updateTask($_POST) > 0) {
                Swal::setSwal('Berhasil', 'Berhasil mengubah data', 'success');
                header('Location: ' . BASEURL . '/todo');
                exit;
            } else {
                Swal::setSwal('Gagal', 'Gagal mengubah data', 'error');
                header('Location: ' . BASEURL . '/todo');
                exit;
            }
        } else {
            Swal::setSwal('Gagal', 'Data tidak ada', 'error');
            header('Location: ' . BASEURL . '/todo');
            exit;
        }
    }

    public function cari()
    {
        $data['todo'] = $this->model('Todo')->searchTask();
        $data['judul'] = 'To Do List';
        $this->view('components/header', $data);
        $this->view('todo/index', $data);
        $this->view('components/footer');
    }
}
