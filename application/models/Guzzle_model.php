<?php 
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class Guzzle_model extends CI_model {
    private $_client;

    public function __construct()
    {
        $userID = $this->session->userdata('id_user');
        $token = $this->session->userdata('token');

        $this->_client = new Client([
            'base_uri' => 'http://localhost/api/index.php/',
            'headers' => [
                'Client-Service' => 'frontend-client',
                'Auth-Key' => 'simplerestapi',
                'Content-Type' => 'application/json',
                'User-ID' => $userID,
                'Authorization' => $token
               ]
        ]);
    }

    // Model Folder Data Dukung
    public function getAllFolderDataDukung()
    {
        $response = $this->_client->request('GET', 'FolderDataDukung');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getFolderDataDukungById($id)
    {
        $response = $this->_client->request('GET', 'FolderDataDukung/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getFolderDataDukungByDipaId($id)
    {
        $response = $this->_client->request('GET', 'FolderDataDukung/detailByDipa/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function createFolderDataDukung($data)
    {
        $response = $this->_client->request('POST', 'FolderDataDukung/create', [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function updateFolderDataDukung($id, $data)
    {
        // var_dump($data); exit;
        $response = $this->_client->request('PUT', 'FolderDataDukung/update/' . $id, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deleteFolderDataDukung($id)
    {
        $response = $this->_client->request('DELETE', 'FolderDataDukung/delete/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function countDataDukung($id)
    {
        $response = $this->_client->request('GET', 'DataDukung/getdetailbyfolder/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        $count = count($result);
        return $count;
    }

    // Model Data Dukung
    public function getDataDukungByFolderId($id)
    {
        $response = $this->_client->request('GET', 'DataDukung/getdetailbyfolder/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getDataDukungById($id)
    {
        $response = $this->_client->request('GET', 'DataDukung/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function createDataDukung($data)
    {
        $response = $this->_client->request('POST', 'DataDukung/create', [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deleteDataDukung($id)
    {
        $response = $this->_client->request('DELETE', 'DataDukung/delete/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function updateDataDukung($id, $data)
    {
        // var_dump($data); exit;
        $response = $this->_client->request('PUT', 'DataDukung/update/' . $id, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    // Model list DIPA 
    public function getDipaList()
    {
        $response = $this->_client->request('GET', 'Dipa');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
    public function getDetailDipa($id)
    {
        $response = $this->_client->request('GET', 'Dipa/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    // Model Dokumen DIPA 
    public function getAllDokumenDipa()
    {
        $response = $this->_client->request('GET', 'DokumenDipa');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getDokumenDipaByDipaId($id)
    {
        $response = $this->_client->request('GET', 'DokumenDipa/GetDetailByDipa/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getDokumenDipaById($id)
    {
        $response = $this->_client->request('GET', 'DokumenDipa/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function createDokumenDipa($data)
    {
        $response = $this->_client->request('POST', 'DokumenDipa/create', [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deleteDokumenDipa($id)
    {
        $response = $this->_client->request('DELETE', 'DokumenDipa/delete/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function updateDokumenDipa($id, $data)
    {
        // var_dump($data); exit;
        $response = $this->_client->request('PUT', 'DokumenDipa/update/' . $id, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    // Model Pagu dan Realisasi 
    public function getTotalPagu()
    {
        $response = $this->_client->request('GET', 'ApiDipaPusdatin/TotalPagu');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
    public function getTotalPagubyKodeSatker($id)
    {
        $response = $this->_client->request('GET', 'ApiDipaPusdatin/TotalPaguByKodeSatker/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
    public function getTotalRealisasi()
    {
        $response = $this->_client->request('GET', 'ApiRealisasiMonsakti/TotalRealisasi');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
    public function getTotalRealisasibyKodeSatker($id)
    {
        $response = $this->_client->request('GET', 'ApiRealisasiMonsakti/TotalRealisasiByKodeSatker/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
    public function getTotalRealisasiJenisBelanja()
    {
        $response = $this->_client->request('GET', 'ApiRealisasiMonsakti/TotalRealisasiJenisBelanja');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
    public function getTotalRealisasiJenisBelanjabyKodeSatker($id)
    {
        $response = $this->_client->request('GET', 'ApiRealisasiMonsakti/TotalRealisasiJenisBelanjaByKodeSatker/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    // Model Pelaksanaan Anggaran
    public function getAllPelaksanaanAnggaran()
    {
        $response = $this->_client->request('GET', 'PelaksanaanAnggaran');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getPelaksanaanAnggaranById($id)
    {
        $response = $this->_client->request('GET', 'PelaksanaanAnggaran/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getPelaksanaanAnggaranByDipaId($id)
    {
        $response = $this->_client->request('GET', 'PelaksanaanAnggaran/getDetailByDipa/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function createPelaksanaanAnggaran($data)
    {
        $response = $this->_client->request('POST', 'PelaksanaanAnggaran/create', [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function updatePelaksanaanAnggaran($id, $data)
    {
        // var_dump($data); exit;
        $response = $this->_client->request('PUT', 'PelaksanaanAnggaran/update/' . $id, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deletePelaksanaanAnggaran($id)
    {
        $response = $this->_client->request('DELETE', 'PelaksanaanAnggaran/delete/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    // Model Pelaksanaan Anggaran Akun Detil
    public function getAllPelaksanaanAnggaranAkunDetil()
    {
        $response = $this->_client->request('GET', 'PelaksanaanAnggaranAkunDetil');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getTotalPelaksanaanAnggaran()
    {
        $response = $this->_client->request('GET', 'PelaksanaanAnggaranAkunDetil/totalPelaksanaanAnggaranByDipaAkunDetil');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getPelaksanaanAnggaranAkunDetilById($id)
    {
        $response = $this->_client->request('GET', 'PelaksanaanAnggaranAkunDetil/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getPelaksanaanAnggaranAkunDetilByPelaksanaanAnggaran($id)
    {
        $response = $this->_client->request('GET', 'PelaksanaanAnggaranAkunDetil/getDetailByPelaksanaanAnggaran/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function createPelaksanaanAnggaranAkunDetil($data)
    {
        $response = $this->_client->request('POST', 'PelaksanaanAnggaranAkunDetil/create', [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function updatePelaksanaanAnggaranAkunDetil($id, $data)
    {
        // var_dump($data); exit;
        $response = $this->_client->request('PUT', 'PelaksanaanAnggaranAkunDetil/update/' . $id, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deletePelaksanaanAnggaranAkunDetil($id)
    {
        $response = $this->_client->request('DELETE', 'PelaksanaanAnggaranAkunDetil/delete/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

}