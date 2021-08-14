<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('model_api', 'api');
    }


    public function index()
    {
        $data['kelas'] = $this->db->get('data_kelas')->result();
        $data['tugas'] = $this->db->get('data_tugas')->result();

        $data['api'] = $this->db->get('data_api')->row()->url;
        $data['versi'] = $this->db->get('data_api')->row()->versi;

        //set map api url
        $url = "http://localhost/versi.json";

        //call api
        $json = file_get_contents($url);
        $js = json_decode($json);

        $versi = '';
        foreach ($js as $key) {
            # code...
            $versi .= $key->versi;
        }
        $data['new_versi'] = $versi;

        $this->load->view('layout/meta', $data);
        $this->load->view('layout/navbar');
        $this->load->view('utama');
        $this->load->view('layout/script');
    }

    public function tampil()
    {

        $data['allkelas'] = $this->db->get('data_kelas')->result();
        $data['alltugas'] = $this->db->get('data_tugas')->result();

        $kelas = $this->input->post('kelas', true);

        $this->db->where('id', $this->input->post('tugas'));
        $data['tugas']  = $this->db->get('data_tugas')->row();

        $this->db->where('kelas', $kelas);
        $data['siswa'] = $this->db->get('data_pd')->result();

        $this->load->view('layout/meta', $data);
        $this->load->view('layout/navbar');
        $this->load->view('tampil');
        $this->load->view('layout/script');
    }

    function input()
    {
        $tugas = $this->input->post('tugas');
        $check = $this->input->post('check');

        if ($check) {
            $h = [];
            foreach ($check as $ch) {
                $this->db->where('id', $ch);
                $as = $this->db->get('data_pd')->row();
                array_push($h, $as->hp);
            }

            $this->db->where('tugas', $tugas);
            $qyangada = $this->db->get('data_siswa')->result();

            $d = [];
            foreach ($qyangada as $key) {
                # code...
                array_push($d, $key->hp);
            }

            if (array_intersect($h, $d)) {
                echo 'sudah ada data sebelumnya';
            } else {

                $b = [];
                foreach ($check as $c) {

                    $this->db->where('id', $c);
                    $a = $this->db->get('data_pd')->row();
                    array_push($b, [
                        'nama' => $a->nama,
                        'kelas' => $a->kelas,
                        'hp' => $a->hp,
                        'tugas' => $tugas
                    ]);
                }
                $this->db->insert_batch('data_siswa', $b);

                redirect('admin');
            }
        } else {
            echo 'tidak ada data diinput';
        }
    }

    public function pesan()
    {
        $data['pesan'] = $this->db->get('data_tugas')->result();

        $this->load->view('layout/meta', $data);
        $this->load->view('layout/navbar');
        $this->load->view('pesan');
        $this->load->view('layout/script');
    }

    public function kirim()
    {
        $this->db->select('*, data_siswa.id as id');
        $this->db->join('data_tugas', 'data_tugas.id = data_siswa.tugas', 'left');
        $data['list'] = $this->db->get('data_siswa')->result();

        $this->load->view('layout/meta', $data);
        $this->load->view('layout/navbar');
        $this->load->view('tampilkirim');
        $this->load->view('layout/script');
    }

    public function proseskirim()
    {
        /**
         * Ambil data pesan
         * Tampilkan satu data jika ada nomor hp lebih dari satu
         * Urutkan berdasarkan id nya
         */
        $this->db->order_by('id', 'asc');
        $this->db->group_by('hp');
        $dt = $this->db->get('data_siswa')->result();

        /**
         * Siapkan 2 data untuk di kirim ke API
         * 1 data nomor hp
         * 2 data pesan
         * masukkan 2 data tersebut dalam satu array
         */
        $data = [];
        foreach ($dt as $dt) {

            $this->db->order_by('data_siswa.id', 'asc');
            $this->db->where('hp', $dt->hp);
            $this->db->join('data_tugas', 'data_tugas.id = data_siswa.tugas', 'left');
            $dat = $this->db->get('data_siswa')->result();

            // siapkan data nomor hp
            $hpne = $dt->hp;

            // siapkan data pesan untuk masing-masing nomor hp
            $t = $dt->nama . ' kelas ' . $dt->kelas . '
';
            $t .= 'Mapel : PJOK 

';
            $t .= 'informasi untuk tugas kamu adalah sebagai berikut :
';
            // Ambil semua pesan jika ada lebih dari satu pesan untuk nomor hp yang sama
            foreach ($dat as $value) {

                $t .= '- ' . $value->keterangan . '
';
            }
            array_push($data, ['pesan' => $t, 'hp' => $hpne]);
        }


        $curl = curl_init();

        // siapkan array untuk menampung respon dari API
        $c = [];

        foreach ($data as $key) {
            # code...
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->api->api_url() . 'send-message',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'number=' . $key['hp'] . '&message=' . $key['pesan'],
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded'
                ),
            ));

            // curl_exec($curl);
            $response = json_decode(curl_exec($curl));
            sleep(15);

            if ($response->message) {
                # code...
                array_push($c, $response->message);
            }
        }

        curl_close($curl);

        $this->session->set_flashdata('hasil', $c);
        redirect('admin/kirim');
    }

    function hapus_pesan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('data_tugas');
        redirect('admin/pesan');
    }

    function tambah_pesan()
    {
        $data = [
            'mapel' => $this->input->post('mapel'),
            'keterangan' => $this->input->post('keterangan')
        ];

        $this->db->insert('data_tugas', $data);
        redirect('admin/pesan');
    }

    function hapus_pesan_dikirim($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('data_siswa');
        redirect('admin/kirim');
    }

    function hapuspesandikirim()
    {
        $this->db->truncate('data_siswa');
        redirect('admin/kirim');
    }

    function importkelas()
    {
        $url = $this->input->post('url');

        $config['upload_path'] = './assets/';
        $config['allowed_types'] = 'xlsx';
        $config['max_size']  = '3000';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('data')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', $error);
            redirect('admin/' . $url);
        } else {
            $this->db->truncate('data_kelas');

            $data = array('upload_data' => $this->upload->data());

            include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load($data['upload_data']['file_path'] . $data['upload_data']['file_name']);
            $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
            $object = array();
            $numrow = 1;
            foreach ($sheet as $row) {
                if ($numrow > 1) {
                    array_push($object, array(
                        'nama_kelas' => $row['B'],
                    ));
                }
                $numrow++;
            }
            $this->db->insert_batch('data_kelas', $object);
            unlink($data['upload_data']['file_path'] . $data['upload_data']['file_name']);
            redirect('admin/' . $url);
        }
    }

    function importSiswa()
    {
        $url = $this->input->post('url');

        $config['upload_path'] = './assets/';
        $config['allowed_types'] = 'xlsx';
        $config['max_size']  = '3000';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('data')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', $error);
            redirect('admin/' . $url);
        } else {
            $this->db->truncate('data_pd');

            $data = array('upload_data' => $this->upload->data());

            include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load($data['upload_data']['file_path'] . $data['upload_data']['file_name']);
            $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
            $object = array();
            $numrow = 1;
            foreach ($sheet as $row) {
                if ($numrow > 1) {
                    array_push($object, array(
                        'nama' => $row['B'],
                        'kelas' => $row['C'],
                        'hp' => $row['D'],
                    ));
                }
                $numrow++;
            }
            $this->db->insert_batch('data_pd', $object);
            unlink($data['upload_data']['file_path'] . $data['upload_data']['file_name']);
            redirect('admin/' . $url);
        }
    }

    function unduhformatsiswa()
    {
        $this->load->helper('download');
        $data = file_get_contents('./assets/data_pd.xlsx');
        force_download('data_pd.xlsx', $data);
    }

    function unduhformatkelas()
    {
        $this->load->helper('download');
        $data = file_get_contents('./assets/data_kelas.xlsx');
        force_download('data_kelas.xlsx', $data);
    }

    public function baca_pesan()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->api->api_url() . 'get-activeChat',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));


        $data['res'] = json_decode(curl_exec($curl));

        curl_close($curl);

        $this->load->view('layout/meta', $data);
        $this->load->view('layout/navbar');
        $this->load->view('baca');
        $this->load->view('layout/script');
    }

    function hapus_pesan_wa($number)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->api->api_url() . 'delete-message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'number=' . $number,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = json_decode(curl_exec($curl));

        curl_close($curl);

        if ($response->status == '1') {
            $this->session->set_flashdata('pesan', 'Pesan berhasil dihapus');
            redirect('admin/baca_pesan');
        } else {
            $this->session->set_flashdata('pesan', 'Pesan gagal dihapus');
            redirect('admin/baca_pesan');
        }
    }

    function baca_pesan_wa($number)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->api->api_url() . 'fetch-message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'number=' . $number,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = json_decode(curl_exec($curl));

        curl_close($curl);

        $data['res'] = $response->response;
        // echo '<pre>';
        // print_r($data['res']);
        // die;

        $this->load->view('layout/meta', $data);
        $this->load->view('layout/navbar');
        $this->load->view('baca_pesan_wa');
        $this->load->view('layout/script');
    }

    function balas_pesan()
    {
        $no = $this->input->post('no');
        $text = $this->input->post('text');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->api->api_url() . 'send-message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'number=' . $no . '&message=' . $text,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        redirect('admin/baca_pesan_wa/' . $no);
    }

    function hapus_semua_pesan_wa()
    {
        $nomor = $this->input->post('nomor');

        $curl = curl_init();
        foreach ($nomor as $no) {

            $nom = explode('-', $no);

            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->api->api_url() . 'delete-message',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'number=' . $nom[0],
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded'
                ),
            ));

            curl_exec($curl);
        }
        curl_close($curl);
        redirect('admin/baca_pesan');
    }

    function update_api()
    {
        $api = $this->input->post('api');

        $object = [
            'url' => $api
        ];
        $this->db->where('id', 1);
        $this->db->update('data_api', $object);
        redirect('');
    }
}

/* End of file Admin.php */
