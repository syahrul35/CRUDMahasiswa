<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\MahasiswaModel;

class Mahasiswa extends BaseController
{
    public function index()
    {
        $model = new MahasiswaModel();
        if (!$this->validate([])) {
            $data['validation'] = $this->validator;
            $data['mahasiswa'] = $model->getMahasiswa();
            return view('list_mahasiswa', $data);
        }
    }

    public function Add()
    {
        helper('form');
        return view('form_mahasiswa');
    }

    public function view($id)
    {
        $model = new MahasiswaModel();
        $data['mahasiswa'] = $model->PilihMahasiswa($id)->getRow();
        return view('view', $data);
    }

    public function simpan()
    {
        $model = new MahasiswaModel();
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('Mahasiswa');
        }
        $validation = $this->validate([
            'diri' => 'uploaded[diri]|mime_in[diri,image/jpg,image/jpeg,image/gif,image/png]|max_size[diri,4096]',
            'ktp' => 'uploaded[ktp]|mime_in[ktp,image/jpg,image/jpeg,image/gif,image/png]|max_size[ktp,4096]'
        ]);

        if ($validation == FALSE) {
            $data = [
                'NIM'  => $this->request->getPost('NIM'),
                'nama_mahasiswa' => $this->request->getPost('nama_mahasiswa'),
            ];
        } else {
            $diri = $this->request->getFile('diri');
            $diri->move('assets/images/');

            $ktp = $this->request->getFile('ktp');
            $ktp->move('assets/images/');

            $data = [
                'NIM'  => $this->request->getPost('NIM'),
                'nama_mahasiswa' => $this->request->getPost('nama_mahasiswa'),
                'foto_diri' => $diri->getName(),
                'foto_ktp' => $ktp->getName()
            ];
        }
        $model->SimpanMahasiswa($data);
        return redirect()->to('./mahasiswa')->with('berhasil', 'Data Berhasil di Simpan');
    }

    public function form_edit($id)
    {
        $model = new MahasiswaModel();
        helper('form');
        $data['mahasiswa'] = $model->PilihMahasiswa($id)->getRow();
        return view('edit_mahasiswa', $data);
    }

    public function edit()
    {
        $model = new MahasiswaModel();
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('Mahasiswa');
        }
        $id = $this->request->getPost('id');

        $validationdiri = $this->validate([
            'diri' => 'uploaded[diri]|mime_in[diri,image/jpg,image/jpeg,image/gif,image/png]|max_size[diri,4096]',
        ]);
        $validationktp = $this->validate([
            'ktp' => 'uploaded[ktp]|mime_in[ktp,image/jpg,image/jpeg,image/gif,image/png]|max_size[ktp,4096]'
        ]);


        if ($validationdiri == FALSE && $validationktp == TRUE) {
            $dt = $model->PilihMahasiswa($id)->getRow();

            $foto_ktp = $dt->foto_ktp;
            $path = 'assets/images/';
            @unlink($path . $foto_ktp);
            $ktp = $this->request->getFile('ktp');
            $ktp->move('assets/images/');

            $data = [
                'NIM'  => $this->request->getPost('nim'),
                'nama_mahasiswa' => $this->request->getPost('nama_mahasiswa'),
                'foto_diri' => $this->request->getPost('txtdiri'),
                'foto_ktp' => $ktp->getName()
            ];
        }
        if ($validationdiri == TRUE && $validationktp == FALSE) {
            $dt = $model->PilihMahasiswa($id)->getRow();

            $foto_diri = $dt->foto_diri;
            $path = 'assets/images/';
            @unlink($path . $foto_diri);
            $diri = $this->request->getFile('diri');
            $diri->move('assets/images/');

            $data = [
                'NIM'  => $this->request->getPost('nim'),
                'nama_mahasiswa' => $this->request->getPost('nama_mahasiswa'),
                'foto_diri' => $diri->getName(),
                'foto_ktp' => $this->request->getPost('txtktp')
            ];
        } else {
            $dt = $model->PilihMahasiswa($id)->getRow();

            $foto_diri = $dt->foto_diri;
            $path = 'assets/images/';
            @unlink($path . $foto_diri);
            $diri = $this->request->getFile('diri');
            $diri->move('assets/images/');

            $foto_ktp = $dt->foto_ktp;
            $path = 'assets/images/';
            @unlink($path . $foto_ktp);
            $ktp = $this->request->getFile('ktp');
            $ktp->move('assets/images/');

            $data = [
                'NIM'  => $this->request->getPost('nim'),
                'nama_mahasiswa' => $this->request->getPost('nama_mahasiswa'),
                'foto_diri' => $diri->getName(),
                'foto_ktp' => $ktp->getName()
            ];
        }
        $model->editData($id, $data);
        return redirect()->to('./mahasiswa')->with('berhasil', 'Data Berhasil di Ubah');
    }

    public function hapus($id)
    {
        $model = new MahasiswaModel();
        $dt = $model->PilihMahasiswa($id)->getRow();
        $model->HapusMahasiswa($id);
        return redirect()->to('./mahasiswa')->with('berhasil', 'Data Berhasil di Hapus');
    }
}
