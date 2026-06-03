<?php

namespace App\Controllers;

use App\Models\VaiTroModel;

class VaiTroController extends BaseController
{
    public function index()
    {
        $model = new VaiTroModel();

        $data['vaitros'] = $model->getAllVaiTro();

        return view('vaitro/index', $data);
    }

    public function create()
    {
        return view('vaitro/create');
    }

    public function store()
    {
        $rules = [
            'ten_vai_tro' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tên vai trò không được để trống'
                ]
            ],
            'cap_bac' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Cấp bậc không được để trống'
                ]
            ],
            'mo_ta' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mô tả không được để trống'
                ]
            ]
        ];

        // Nếu validate thất bại
        if (!$this->validate($rules)) {

            return redirect()->back()
                            ->withInput()
                            ->with('errors', $this->validator->getErrors());
        }

        $model = new VaiTroModel();

        $model->save([
            'ten_vai_tro' => $this->request->getPost('ten_vai_tro'),

            'cap_bac' => $this->request->getPost('cap_bac'),

            'mo_ta' => $this->request->getPost('mo_ta')
        ]);

        return redirect()

            ->to('/vai_tro')

            ->with(
                'success',
                'Thêm vai trò thành công'
            );
    }

    public function edit($id)
    {
        $model = new VaiTroModel();

        $data['vaitro'] = $model->find($id);

        return view(
            'vaitro/edit',
            $data
        );
    }

    public function update($id)
    {
        $model = new VaiTroModel();

        $model->update($id,[
            'ten_vai_tro' => $this->request->getPost('ten_vai_tro'),

            'cap_bac' => $this->request->getPost('cap_bac'),

            'mo_ta' => $this->request->getPost('mo_ta')
        ]);

        return redirect()

            ->to('/vai_tro')

            ->with(
                'success',
                'Cập nhật vai trò thành công'
            );
    }

    public function delete($id)
    {
        $model = new VaiTroModel();

        $model->delete($id);

        return redirect()
            ->to('/vai_tro')

            ->with(
                'success',
                'Xóa vai trò thành công'
            );
    }
}