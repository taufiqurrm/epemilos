 <?php
	class Admin extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->helper(array('form', 'url'));
			$this->load->library(array('session', 'pdflibrary', 'pagination'));
			$this->load->model(array('Admin_Model'));
		}
		public function login()
		{
			if ($this->session->userdata('username')) {
				redirect('admin/index');
			}
			$this->load->view('admin/head');
			$this->load->view('admin/login');
		}
		public function gantipassword()
		{
			if (!$this->session->userdata('username')) {
				redirect('admin/login');
			}
			$data['idsekolah']	= $this->Admin_Model->idsekolah();
			$data['dataadmin']	= $this->Admin_Model->dataadmin();
			$this->load->view('admin/head');
			$this->load->view('admin/admin-navbar');
			$this->load->view('admin/gantipassword', $data);
			$this->load->view('admin/footer', $data);
		}
		public function updatepassword()
		{
			$username		= $this->input->post('username');
			$password		= $this->input->post('password');
			$password_hash	= md5($password);
			$update			= $this->Admin_Model->gantipassword($username, $password_hash);
			if ($update = true) {
				$updateuser	= $this->Admin_Model->updateuser($username);
				$this->session->set_flashdata('update', 'Berhasil Memperbarui Password');
				redirect('admin/gantipassword');
			} else {
				$this->session->set_flashdata('updatefailed', 'Gagal Memperbarui Password');
				redirect('admin/gantipassword');
			}
		}
		public function logout()
		{
			$this->session->unset_userdata('username');
			redirect('admin/login');
		}
		public function loginvalidation()
		{
			$username				= $this->input->post('username', TRUE);
			$password				= $this->input->post('password', TRUE);
			$password_hash			= md5($password);
			$result					= $this->Admin_Model->login($username, $password_hash);
			if ($result == true) {
				$this->session->set_userdata(array(
					'username'	=> $username
				));
				redirect('admin/regvalid');
			} else {
				$this->session->set_flashdata('failed', 'Username atau Password Salah');
				redirect('admin/login');
			}
		}
		public function regvalid()
		{
			if (!$this->session->userdata('username')) {
				redirect('admin/login');
			}
			$data = $this->Admin_Model->regvalid();
			foreach ($data as $valid) {
			}
			if ($valid['npsn'] == "") {
				redirect('admin/regsekolah');
			} else {
				redirect('admin/index');
			}
		}
		public function regsekolah()
		{
			$data = $this->Admin_Model->regvalid();
			if ($data == true) {
				redirect('admin/index');
			}
			$this->load->view('admin/head');
			$this->load->view('admin/regsekolah');
		}
		public function simpansekolah()
		{
			$npsn		= $this->input->post('npsn');
			$nm_sekolah	= $this->input->post('nm_sekolah');
			$reg		= $this->Admin_Model->regsekolah($npsn, $nm_sekolah);
			if ($reg = true) {
				redirect('admin/index');
			} else {
				$this->session->set_flashdata('regfailed', 'Registrasi Gagal');
				redirect('admin/index');
			}
		}
		public function index()
		{

			if (!$this->session->userdata('username')) {
				redirect('admin/login');
			}
			$data['valid'] = $this->Admin_Model->regvalid();
			if (!$data['valid'] == true) {
				redirect('admin/regsekolah');
			}
			$data['jmlcalon']	= $this->Admin_Model->countcalon();
			$data['jmlpemilih']	= $this->Admin_Model->countpemilih();
			$data['idsekolah']	= $this->Admin_Model->idsekolah();
			$data['datapilketos'] = $this->Admin_Model->datapilketos();
			$this->load->view('admin/head');
			$this->load->view('admin/admin-navbar');
			$this->load->view('admin/index', $data);
			$this->load->view('admin/footer', $data);
		}
		public function updatedatapilketos()
		{
			$tapel	= $this->input->post("tapel");
			$tgl	= $this->input->post('tgl');
			$update = $this->Admin_Model->updatedatapilketos($tapel, $tgl);
			if ($update = true) {
				// $updateuser	= $this->Admin_Model->updateuser($username);
				$this->session->set_flashdata('update', 'Berhasil Menyimpan Data');
				redirect('admin/index');
			} else {
				$this->session->set_flashdata('updatefailed', 'Gagal Menyimpan User');
				redirect('admin/index');
			}
		}
		public function resetuser()
		{
			$username	= $this->input->post('username');
			$reset		= $this->Admin_Model->resetuser($username);
			if ($reset = true) {
				$updateuser	= $this->Admin_Model->updateuser($username);
				$this->session->set_flashdata('reset_info', 'Berhasil Mereset User');
				redirect('admin/index');
			} else {
				$this->session->set_flashdata('reset_failed', 'Gagal Mereset User');
				redirect('admin/index');
			}
		}
		public function resetdata()
		{
			$reset = $this->Admin_Model->resetdata();
			if ($reset = true) {
				$this->session->set_flashdata('reset', 'Berhasil Mereset Data');
				redirect('admin/index');
			} else {
				$this->session->set_flashdata('resetfailed', 'Gagal Mereset Data');
				redirect('admin/index');
			}
		}
		public function idsekolah()
		{
			if (!$this->session->userdata('username')) {
				redirect('admin/login');
			}
			$data['valid'] = $this->Admin_Model->regvalid();
			if (!$data['valid'] == true) {
				redirect('admin/regsekolah');
			}
			$data['idsekolah']	= $this->Admin_Model->idsekolah();
			$this->load->view('admin/head');
			$this->load->view('admin/admin-navbar');
			$this->load->view('admin/idsekolah', $data);
			$this->load->view('admin/footer', $data);
		}
		public function updateidsekolah()
		{
			$npsn			= $this->input->post('npsn');
			$nm_sekolah		= $this->input->post('nm_sekolah');
			$jln			= $this->input->post('jln');
			$desa			= $this->input->post('desa');
			$kec			= $this->input->post('kec');
			$kab			= $this->input->post('kab');
			$kpl_sekolah	= $this->input->post('kpl_sekolah');
			$nip			= $this->input->post('nip');
			$save			= $this->Admin_Model->updateidsekolah($npsn, $nm_sekolah, $jln, $desa, $kec, $kab, $kpl_sekolah, $nip);
			if ($save = true) {
				$this->session->set_flashdata('info', 'Berhasil Memperbarui Data');
				redirect('admin/index');
			} else {
				$this->session->set_flashdata('failed', 'Gagal Memperbarui Data');
				redirect('admin/index');
			}
		}
		public function datakelas()
		{
			if (!$this->session->userdata('username')) {
				redirect('admin/login');
			}
			$data['idsekolah']	= $this->Admin_Model->idsekolah();
			$data['datakelas']	= $this->Admin_Model->datakelas();
			$this->load->view('admin/head');
			$this->load->view('admin/admin-navbar');
			$this->load->view('admin/datakelas', $data);
			$this->load->view('admin/footer', $data);
		}
		public function simpankelas()
		{
			$nm_kelas	= $this->input->post('nm_kelas');
			$save		= $this->Admin_Model->simpankelas($nm_kelas);
			if ($save = true) {
				$this->session->set_flashdata('info', 'Berhasil Menambahkan Data');
				redirect('admin/datakelas');
			} else {
				$this->session->set_flashdata('failed', 'Gagal Menambahkan Data');
				redirect('admin/datakelas');
			}
		}
		public function hapuskelas($kd_kelas)
		{
			$hapus = $this->Admin_Model->hapuskelas($kd_kelas);
			if ($hapus = true) {
				$this->session->set_flashdata('info', 'Berhasil Menghapus Data');
				redirect('admin/datakelas');
			} else {
				$this->session->set_flashdata('failed', 'Gagal Menghapus Data');
				redirect('admin/datakelas');
			}
		}
		public function tambahcalon()
		{
			if (!$this->session->userdata('username')) {
				redirect('admin/login');
			}
			$data['idsekolah']	= $this->Admin_Model->idsekolah();
			$this->load->view('admin/head');
			$this->load->view('admin/admin-navbar');
			$this->load->view('admin/tambahcalon');
			$this->load->view('admin/footer', $data);
		}
		public function hapuscalon($nisn)
		{
			$sql	= $this->db->get_where('tb_pilihan', "nisn='$nisn'")->row();
			unlink("./asset/img/$sql->photo");
			$hapus 	= $this->Admin_Model->hapuscalon($nisn);
			if ($hapus = true) {
				$this->session->set_flashdata('info', 'Berhasil Menghapus Data');
				redirect('admin/datacalon/');
			} else {
				$this->session->set_flashdata('failed', 'Gagal Menghapus Data');
				redirect('admin/datacalon/');
			}
		}
		public function tambahdpt()
		{
			if (!$this->session->userdata('username')) {
				redirect('admin/login');
			}
			$data['idsekolah']	= $this->Admin_Model->idsekolah();
			$data['datakelas']	= $this->Admin_Model->datakelas();
			$this->load->view('admin/head');
			$this->load->view('admin/admin-navbar');
			$this->load->view('admin/tambahdpt', $data);
			$this->load->view('admin/footer', $data);
		}
		public function simpandpt()
		{
			$username	= $this->input->post('nisn');
			$password	= $this->input->post('nisn');
			$nm_siswa	= $this->input->post('nm_siswa');
			$jk 		= $this->input->post('jk');
			$kd_kelas	= $this->input->post('kd_kelas');
			$save 		= $this->Admin_Model->simpandpt($username, $password, $nm_siswa, $jk, $kd_kelas);
			if ($save = true) {
				$this->session->set_flashdata('info', 'Berhasil Memperbarui Data');
				redirect('admin/datadpt/');
			} else {
				$this->session->set_flashdata('failed', 'Gagal Memperbarui Data');
				redirect('admin/datadpt/');
			}
		}
		public function hapusdpt($username)
		{
			$hapus	= $this->Admin_Model->hapusdpt($username);
			if ($hapus = true) {
				$this->session->set_flashdata('info', 'Berhasil Menghapus Data');
				redirect('admin/datadpt/');
			} else {
				$this->session->set_flashdata('failed', 'Berhasil Menghapus Data');
				redirect('admin/datadpt/');
			}
		}
		public function editdpt($username)
		{
			$data['datakddpt']	= $this->Admin_Model->datakddpt($username);
			$data['datakelas']	= $this->Admin_Model->datakelas();
			$data['idsekolah']	= $this->Admin_Model->idsekolah();
			$this->load->view('admin/head');
			$this->load->view('admin/admin-navbar');
			$this->load->view('admin/editdpt', $data);
			$this->load->view('admin/footer', $data);
		}
		public function updatedpt()
		{
			$username	= $this->input->post('nisn');
			$nm_siswa	= $this->input->post('nm_siswa');
			$jk			= $this->input->post('jk');
			$kd_kelas	= $this->input->post('kd_kelas');
			$update		= $this->Admin_Model->updatedpt($username, $nm_siswa, $jk, $kd_kelas);
			if ($update = true) {
				$this->session->set_flashdata('info', 'Berhasil Mengupdate Data');
				redirect('admin/editdpt/' . $username);
			} else {
				$this->session->set_flashdata('failed', 'Gagal Mengupdate Data');
				redirect('admin/editdpt/' . $username);
			}
		}
		public function importdpt()
		{
			$this->load->view('admin/head');
			$this->load->view('admin/import_siswa');
		}
		public function editcalon($nisn)
		{
			$data['datacalon']	= $this->Admin_Model->datacalonspesifik($nisn);
			$data['idsekolah']	= $this->Admin_Model->idsekolah();
			$this->load->view('admin/head');
			$this->load->view('admin/admin-navbar');
			$this->load->view('admin/editcalon', $data);
			$this->load->view('admin/footer', $data);
		}
		public function simpancalon()
		{
			$nisn			= $this->input->post('nisn');
			$no				= $this->input->post('no');
			$nama			= $this->input->post('nama');
			$visimisi		= $this->input->post('visimisi');
			$sql			= $this->db->get_where('tb_pilihan', "nisn='$nisn'")->row();

			$config['upload_path']	= "./asset/img/";
			$config['allowed_types'] = "gif|jpg|jpeg|png";
			$config['max_size']		= 1024;
			$config['file_name']	= $nisn . sprintf("%06s", time());
			$this->load->library('upload', $config);
			if ($sql->nisn == $nisn) {
				$this->session->set_flashdata('failed', 'Data NISN ada yang sama');
				redirect('admin/datacalon');
			}
			if ($this->upload->do_upload('photo')) {
				$this->session->set_flashdata('info', 'Berhasil Menambahkan Data');
				$data['upload_data'] = $this->upload->data();
				$img 				= $_FILES['photo']['name'];
				$img_ext			= pathinfo($img, PATHINFO_EXTENSION);
				$photo				= $config['file_name'] . "." . $img_ext;
				$this->Admin_Model->tambahcalon($nisn, $no, $nama, $visimisi, $photo);
				redirect('admin/datacalon');
			} else {
				$this->session->set_flashdata('failed', 'Gagal Menambahkan Data');
				redirect('admin/datacalon');
			}
		}
		public function updatecalon()
		{
			$nisn			= $this->input->post('nisn');
			$no				= $this->input->post('no');
			$nama			= $this->input->post('nama');
			$visimisi		= $this->input->post('visimisi');
			$sql			= $this->db->get_where('tb_pilihan', "nisn='$nisn'")->row();
			$config['upload_path']	= "./asset/img/";
			$config['allowed_types'] = "gif|jpg|jpeg|png";
			$config['max_size']		= 1024;
			$config['file_name']	= $nisn . sprintf("%06s", time());
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('photo')) {
				if ($sql->photo != '') {
					unlink("./asset/img/$sql->photo");
				}
				$this->session->set_flashdata('info', 'Berhasil Menambahkan Data');
				$data['upload_data'] = $this->upload->data();
				$img 				= $_FILES['photo']['name'];
				$img_ext			= pathinfo($img, PATHINFO_EXTENSION);
				$photo				= $config['file_name'] . "." . $img_ext;
				$this->Admin_Model->updatecalon($nisn, $no, $nama, $visimisi, $photo);
				redirect('admin/datacalon/');
			} else {
				$this->session->set_flashdata('failed', 'Gagal Memperbarui Data');
				redirect('admin/editcalon/' . $nisn);
			}
		}
		public function datacalon()
		{
			if (!$this->session->userdata('username')) {
				redirect('admin/login');
			}
			$data['datacalon']	= $this->Admin_Model->datacalon();
			$data['idsekolah']	= $this->Admin_Model->idsekolah();
			$this->load->view('admin/head');
			$this->load->view('admin/admin-navbar');
			$this->load->view('admin/datacalon', $data);
			$this->load->view('admin/footer', $data);
		}
		public function hasilvote()
		{
			if (!$this->session->userdata('username')) {
				redirect('admin/login');
			}
			$data['vote']		= $this->Admin_Model->hasilvote();
			$data['jmlpemilih']	= $this->Admin_Model->countpemilih();
			$data['jmlvote']	= $this->Admin_Model->countvote();
			$data['idsekolah']	= $this->Admin_Model->idsekolah();
			$this->load->view('admin/head');
			$this->load->view('admin/admin-navbar');
			$this->load->view('admin/hasilvote', $data);

			$this->load->view('admin/footer', $data);
		}
		public function daftarhadir()
		{
			if (!$this->session->userdata('username')) {
				redirect('admin/login');
			}

			$data['vote']			= $this->Admin_Model->hasilvote();
			$data['jmlpemilih']		= $this->Admin_Model->countpemilih();
			$data['jmlvote']		= $this->Admin_Model->countvote();
			$data['idsekolah']	= $this->Admin_Model->idsekolah();
			$data['datakelas']	= $this->Admin_Model->datakelas();
			$data['daftarhadir'] 	= $this->Admin_Model->daftarhadir();

			$this->load->view('admin/head');
			$this->load->view('admin/admin-navbar');
			$this->load->view('admin/daftarhadir', $data);
			$this->load->view('admin/footer', $data);
		}
		public function tgl_indo($tanggal)
		{
			$bulan = array(
				1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
			$pecahkan = explode('-', $tanggal);

			return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
		}
		public function cetakdaftarhadir()
		{
			$datasekolah	= $this->Admin_Model->idsekolah();
			$data			=	$this->Admin_Model->daftarhadircetak();
			foreach ($datasekolah as $loaddata) {
			}
			ob_start();
			$pdf = new FPDF('p', 'mm', 'legal');
			$pdf->AddPage();
			$pdf->SetFont('Arial', 'B', 16);
			$pdf->Cell(190, 7, 'DAFTAR HADIR KEGIATAN E-PEMILOS', 0, 1, 'C');
			$pdf->Cell(190, 7, $loaddata['nm_sekolah'], 0, 1, 'C');
			$pdf->Cell(10, 7, '', 0, 1);
			$pdf->SetFont('Arial', 'B', 12);
			$pdf->Cell(10, 10, 'No', 1, 0, 'C');
			$pdf->Cell(35, 10, 'Nisn', 1, 0, 'C');
			$pdf->Cell(70, 10, 'Nama', 1, 0, 'C');
			$pdf->Cell(35, 10, 'Kelas', 1, 0, 'C');
			$pdf->Cell(35, 10, 'Keterangan', 1, 1, 'C');
			$no = 1;
			$pdf->SetFont('Arial', '', 12);
			foreach ($data as $load) {
				$pdf->cell(10, 10, $no++, 1, 0, 'C');
				$pdf->cell(35, 10, $load['username'], 1, 0, 'C');
				$pdf->cell(70, 10, $load['nm_siswa'], 1, 0, 'L');
				$pdf->cell(35, 10, $load['nm_kelas'], 1, 0, 'C');
				$pdf->cell(35, 10, $load['hadir'], 1, 1, 'L');
			}
			$pdf->Cell(10, 7, '', 0, 1);
			$pdf->Cell(115, 10, '', 0, 0, 'L');
			$pdf->Cell(70, 10, $loaddata['kab'] . ', ' . $this->tgl_indo(date('Y-m-d')), 0, 1, 'L');
			$pdf->Cell(115, 10, '', 0, 0, 'L');
			$pdf->Cell(70, 10, 'Kepala Madrasah', 0, 1, 'L');
			$pdf->Cell(10, 20, '', 0, 1);
			$pdf->Cell(115, 6, '', 0, 0, 'L');
			$pdf->SetFont('Arial', 'B', 12);
			$pdf->Cell(70, 6, $loaddata['kpl_sekolah'], 0, 1, 'L');
			$pdf->Cell(115, 6, '', 0, 0, 'L');
			$pdf->SetFont('Arial', '', 12);
			$pdf->Cell(70, 6, 'NIP: ' . $loaddata['nip'], 0, 1, 'L');
			$pdf->Output();
			ob_end_flush();
		}
		public function laporan()
		{
			$datasekolah	= $this->Admin_Model->idsekolah();
			$data			= $this->Admin_Model->daftarhadircetak();
			$jmldptL		= $this->Admin_Model->jmldptL();
			$jmldptP		= $this->Admin_Model->jmldptP();
			$jmlvoteL		= $this->Admin_Model->jmlvoteL();
			$jmlvoteP		= $this->Admin_Model->jmlvoteP();
			$datavote		= $this->Admin_Model->hasilvote();
			$datapilketos	= $this->Admin_Model->datapilketos();
			foreach ($datasekolah as $loaddata) {
			}
			foreach ($jmldptL as $dptL) {
			}
			foreach ($jmldptP as $dptP) {
			}
			foreach ($jmlvoteL as $voteL) {
			}
			foreach ($jmlvoteP as $voteP) {
			}
			foreach ($datapilketos as $data) {
			}
			ob_start();
			$pdf = new FPDF('l', 'mm', 'legal');
			$pdf->AddPage();
			$pdf->SetFont('Arial', 'B', 16);
			//HEADER LAPORAN
			$pdf->Cell(290, 7, 'LAPORAN PELAKSANAAN KEGIATAN E-PEMILOS', 0, 1, 'C');
			$pdf->Cell(290, 7, 'TAHUN PELAJARAN ' . $data['tapel'], 0, 1, 'C');
			$pdf->Cell(10, 7, '', 0, 1);
			$pdf->SetFont('Arial', '', 12);
			$pdf->Cell(60, 7, 'Kabupaten', 0, 0);
			$pdf->Cell(5, 7, ':', 0, 0);
			$pdf->Cell(60, 7, $loaddata['kab'], 0, 1);
			$pdf->Cell(60, 7, 'Tanggal Pelaksanaan', 0, 0);
			$pdf->Cell(5, 7, ':', 0, 0);
			$pdf->Cell(60, 7, $data['tgl'], 0, 1);
			$pdf->SetFont('Arial', 'B', 12);
			//TABLE HAEDER
			$pdf->Cell(10, 21, 'No', 1, 0, 'C');
			$pdf->Cell(90, 21, 'Nama Madrasah', 1, 0, 'C');
			$pdf->Cell(60, 7, 'Daftar Pemilih Tetap', 1, 0, 'C');
			$pdf->Cell(60, 7, 'Jumlah Yang Menggunakan', 1, 0, 'C');
			$pdf->Cell(80, 7, 'Jumlah Yang Tidak Menggunakan', 1, 0, 'C');
			$pdf->Cell(1, 7, '', 0, 1);
			$pdf->Cell(10, 7, '', 0, 0);
			$pdf->Cell(90, 7, '', 0, 0);
			$pdf->Cell(60, 7, '(DPT)', 1, 0, 'C');
			$pdf->Cell(60, 7, 'Hak Suara', 1, 0, 'C');
			$pdf->Cell(80, 7, 'Hak Suara', 1, 0, 'C');
			$pdf->Cell(1, 7, '', 0, 1);
			$pdf->Cell(10, 7, '', 0, 0);
			$pdf->Cell(90, 7, '', 0, 0);
			$pdf->Cell(20, 7, 'L', 1, 0, 'C');
			$pdf->Cell(20, 7, 'P', 1, 0, 'C');
			$pdf->Cell(20, 7, 'Jumlah', 1, 0, 'C');
			$pdf->Cell(20, 7, 'L', 1, 0, 'C');
			$pdf->Cell(20, 7, 'P', 1, 0, 'C');
			$pdf->Cell(20, 7, 'Jumlah', 1, 0, 'C');
			$pdf->Cell(20, 7, 'L', 1, 0, 'C');
			$pdf->Cell(20, 7, 'P', 1, 0, 'C');
			$pdf->Cell(40, 7, 'Jumlah', 1, 1, 'C');
			//ISI TABLE
			$dpttidaksahL = $dptL['L'] - $voteL['L'];
			$dpttidaksahP = $dptP['P'] - $voteP['P'];
			$pdf->SetFont('Arial', '', 12);
			$pdf->Cell(10, 10, '1', 1, 0, 'C');
			$pdf->Cell(90, 10, $loaddata['nm_sekolah'], 1, 0, 'C');
			$pdf->Cell(20, 10, $dptL['L'], 1, 0, 'C');
			$pdf->Cell(20, 10, $dptP['P'], 1, 0, 'C');
			$pdf->Cell(20, 10, $dptL['L'] + $dptP['P'], 1, 0, 'C');
			$pdf->Cell(20, 10, $voteL['L'], 1, 0, 'C');
			$pdf->Cell(20, 10, $voteP['P'], 1, 0, 'C');
			$pdf->Cell(20, 10, $voteL['L'] + $voteP['P'], 1, 0, 'C');
			$pdf->Cell(20, 10, $dpttidaksahL, 1, 0, 'C');
			$pdf->Cell(20, 10, $dpttidaksahP, 1, 0, 'C');
			$pdf->Cell(40, 10, $dpttidaksahL + $dpttidaksahP, 1, 1, 'C');
			$pdf->Cell(10, 7, '', 0, 1);
			$pdf->SetFont('Arial', 'B', 12);
			$pdf->Cell(60, 7, 'Hasil Pemilihan', 0, 1);
			$pdf->Cell(30, 12, 'No Urut', 1, 0, 'C');
			$pdf->Cell(60, 12, 'Nama Kandidat', 1, 0, 'C');
			$pdf->Cell(80, 12, 'Jumlah Perolehan Suara', 1, 1, 'C');
			$pdf->SetFont('Arial', '', 12);
			foreach ($datavote as $hasil) {
				$pdf->Cell(30, 7, $hasil['no'], 1, 0, 'C');
				$pdf->Cell(60, 7, $hasil['nama'], 1, 0, 'L');
				$pdf->Cell(80, 7, $hasil['jumlah'], 1, 1, 'C');
			}
			//TANDA TANGAN
			$pdf->Cell(10, 7, '', 0, 1);
			$pdf->Cell(220, 10, '', 0, 0, 'L');
			$pdf->Cell(70, 10, $loaddata['kab'] . ', ' . $this->tgl_indo(date('Y-m-d')), 0, 1, 'L');
			$pdf->Cell(220, 10, '', 0, 0, 'L');
			$pdf->Cell(70, 10, 'Kepala Madrasah', 0, 1, 'L');
			$pdf->Cell(10, 20, '', 0, 1);
			$pdf->Cell(220, 6, '', 0, 0, 'L');
			$pdf->SetFont('Arial', 'B', 12);
			$pdf->Cell(70, 6, $loaddata['kpl_sekolah'], 0, 1, 'L');
			$pdf->Cell(220, 6, '', 0, 0, 'L');
			$pdf->SetFont('Arial', '', 12);
			$pdf->Cell(70, 6, 'NIP: ' . $loaddata['nip'], 0, 1, 'L');
			$pdf->Output();
			ob_end_flush();
		}
		function fetch()
		{
			$output = '';
			$query = '';

			if ($this->input->post('query')) {
				$query = $this->input->post('query');
			}
			$data = $this->Admin_Model->fetch_data($query);

			$output .= '
				<div class="table-responsive">
				<table class="table table-bordered table-striped">
				<tr>
				<th>No</th>
				<th>NISN</th>
				<th>Nama Siswa</th>
				<th>L/P</th>
				<th>Kelas</th>
				<th>Aksi</th>
				</tr>
			';
			if ($data->num_rows() > 0) {
				$no = 1;
				foreach ($data->result() as $row) {
					$output .= '
				<tr>
				<td>' . $no++ . '</td>
				<td>' . $row->username . '</td>
				<td>' . $row->nm_siswa . '</td>
				<td>' . $row->jk . '</td>
				<td>' . $row->nm_kelas . '</td>
				<td>' . '<a href="' . base_url('admin/editdpt/') . $row->username . '"><button type="button" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit</button></a>
				<a href="' . base_url('admin/hapusdpt/') . $row->username . '"><button type="button" class="btn  btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Hapus</button></a>' . '</td>
				</tr>
			';
				}
			} else {
				$output .= '<tr>
				<td colspan="5">Tidak ditemukan data</td>
				</tr>';
			}
			$output .= '</table>';
			echo $output;
		}
		public function datadpt()
		{
			if (!$this->session->userdata('username')) {
				redirect('admin/login');
			}
			$data['idsekolah']	= $this->Admin_Model->idsekolah();
			$data['datakelas']	= $this->Admin_Model->datakelas();
			$data['datadpt'] 	= $this->Admin_Model->datadpt();

			$this->load->view('admin/head');
			$this->load->view('admin/admin-navbar');
			$this->load->view('admin/datadpt', $data);
			$this->load->view('admin/footer', $data);
		}
		function search()
		{
			// get search string
			$search = ($this->input->post("search_text")) ? $this->input->post("search_text") : "KOSONG";

			$search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;

			// pagination settings
			$config = array();
			$config['base_url'] = site_url("admin/search/$search");
			$config['total_rows'] = $this->Admin_Model->hitungdatadpt($search);
			$config['per_page'] = "10";
			$config["uri_segment"] = 4;
			$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] = floor($choice);

			// integrate bootstrap pagination
			$config['first_link']       = 'Pertama';
			$config['last_link']        = 'Terakhir';
			$config['next_link']        = '&raquo;';
			$config['prev_link']        = '&laquo;';
			$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination pagination-sm justify-content-center">';
			$config['full_tag_close']   = '</ul></nav></div>';
			$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close']    = '</span></li>';
			$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close']  = '<span aria-hidden="true">&laquo;</span></span></li>';
			$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close']  = '</span>&laquo;</li>';
			$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close']  = '</span></li>';
			$this->pagination->initialize($config);

			$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			// get datadpt list
			$data['idsekolah']	= $this->Admin_Model->idsekolah();
			$data['datadpt'] = $this->Admin_Model->datadpt($config['per_page'], $data['page'], $search);
			$data['pagination'] = $this->pagination->create_links();

			//load view
			$this->load->view('admin/head');
			$this->load->view('admin/admin-navbar');
			$this->load->view('admin/datadpt', $data);
			$this->load->view('admin/footer', $data);
		}
	}
	?> 