<?php

namespace App\Controllers;
use App\Models\ModelMahasiswa;
use App\Models\ModelProperty;

class Property extends BaseController
{
    // public function test(){
    //     echo password_hash('admin', PASSWORD_BCRYPT);
    // }
    public function index(){
       return view('property/viewtampildata');
    }
 
    public function ambildata(){
        if($this->request->isAJAX()){
            $property = new ModelProperty;
            
            $data = [
                'tampildata' => $property->findAll()
            ];
            $msg = [
                'data' => view('property/dataproperty', $data)
            ];
            echo json_encode($msg);

        }else{
            exit('maaf tidak dapat diproses');
        }
    } 

    public function formtambah(){
        if($this->request->isAJAX()){
            $msg = [
                'data' => view('property/modaltambah')
            ];
            echo json_encode($msg);
        } else {
            exit('maaf tidak dapat diproses');
        }
    }

    public function simpandata(){
        if($this->request->isAJAX()){
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'id' => [
                    'label' => 'Nomer ID',
                    'rules' => 'required|is_unique[property.id]',
                    'errors'=> [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh ada yang sama, silahkan coba yang lain'
                    ]
                    ],
                'namaproperty' => [
                    'label' => 'nama property',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                    ],
            ]);

            if(!$valid){ 
                $msg = [
                    'error' =>[
                      'id' =>  $validation->getError('id'),
                        'namaproperty' =>  $validation->getError('namaproperty')
                    ]
                ];

                }else{
                    $simpandata = [
                    'id' => $this->request->getVar('id'),
                    'namaproperty' => $this->request->getVar('namaproperty'),
                    'kota' => $this->request->getVar('kota'),
                    'luas' => $this->request->getVar('luas'),
                    'foto' => $this->request->getVar('foto'),
                    ];
                    
                    $this->property->insert($simpandata);

                    $msg = [
                        "sukses" => "Data property berhasil tersimpan"
                    ];
                }
                echo json_encode($msg);  
        }else{
            exit('tidak dapat diprosess');
        }
    }

    public function formedit(){
        if($this->request->isAJAX()){
            $id = $this->request->getVar('id');

            $row = $this->property->find($id);

            $data = [
                'id' => $row['id'],
                'namaproperty' => $row['namaproperty'],
                'kota'=>$row['kota'],
                'luas' => $row['luas'],
                'foto' => $row['foto']
            ];
            $msg = [
                'sukses' => view("property/modaledit", $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatedata(){
        if ($this->request->isAJAX()) {
                $simpandata = [
                    'namaproperty' => $this->request->getVar('namaproperty'),
                    'kota' => $this->request->getVar('kota'),
                    'luas' => $this->request->getVar('luas'),
                    'foto' => $this->request->getVar('foto'),
                ];

                // $mhs = new ModelMahasiswa;

                $id = $this-> request-> getVar('id');
                
                $this->property->update($id, $simpandata);

                $msg = [
                    "sukses" => "Data property berhasil diupdate"
                ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diprosess');
        }
    } 

    public function hapus(){
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $this->property->delete($id);
            $msg = [
                "sukses" => "Data Property dihapus"
            ];
            echo json_encode($msg);
        }
    }
}
