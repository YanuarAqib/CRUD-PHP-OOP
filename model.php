<?php

class Model
{

	private $server = "localhost";
	private $username = "root";
	private $password;
	private $db = "oop_crud";
	private $conn;

	public function __construct()
	{
		try {

			$this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);
		} catch (Exception $e) {
			echo "connection failed" . $e->getMessage();
		}
	}

	public function insert()
	{

		if (isset($_POST['submit'])) {
			if (isset($_POST['nim']) && isset($_POST['namamhs']) && isset($_POST['jk']) && isset($_POST['alamat']) && isset($_POST['kota']) && isset($_POST['email']) && isset($_POST['foto'])) {
				if (!empty($_POST['nim']) && !empty($_POST['namamhs']) && !empty($_POST['jk']) && !empty($_POST['almaat']) && !empty($_POST['kota']) && !empty($_POST['email']) && !empty($_POST['foto'])) {

					$nim = $_POST['nim'];
					$namamhs = $_POST['namamhs'];
					$jk = $_POST['jk'];
					$alamat = $_POST['alamat'];
					$kota = $_POST['kota'];
					$email = $_POST['email'];
					$foto = $_POST['foto'];

					$query = "INSERT INTO tbl_mhs (nim,namamhs,jk,alamat,kota,email,foto) VALUES ('$nim','$namamhs','$jk','$alamat','$kota','$email','$foto')";
					if ($sql = $this->conn->query($query)) {
						echo "<script>alert('records added successfully');</script>";
						echo "<script>window.location.href = 'index.php';</script>";
					} else {
						echo "<script>alert('failed');</script>";
						echo "<script>window.location.href = 'index.php';</script>";
					}
				} else {
					echo "<script>alert('empty');</script>";
					echo "<script>window.location.href = 'index.php';</script>";
				}
			}
		}
	}

	public function fetch()
	{
		$data = null;

		$query = "SELECT * FROM tbl_mhs";
		if ($sql = $this->conn->query($query)) {
			while ($row = mysqli_fetch_assoc($sql)) {
				$data[] = $row;
			}
		}
		return $data;
	}

	public function delete($id)
	{

		$query = "DELETE FROM tbl_mhs where id = '$id'";
		if ($sql = $this->conn->query($query)) {
			return true;
		} else {
			return false;
		}
	}

	public function fetch_single($id)
	{

		$data = null;

		$query = "SELECT * FROM tbl_mhs WHERE id = '$id'";
		if ($sql = $this->conn->query($query)) {
			while ($row = $sql->fetch_assoc()) {
				$data = $row;
			}
		}
		return $data;
	}

	public function edit($id)
	{

		$data = null;

		$query = "SELECT * FROM tbl_mhs WHERE id = '$id'";
		if ($sql = $this->conn->query($query)) {
			while ($row = $sql->fetch_assoc()) {
				$data = $row;
			}
		}
		return $data;
	}

	public function update($data)
	{

		$query = "UPDATE tbl_mhs SET name='$data[name]', email='$data[email]', mobile='$data[mobile]', address='$data[address]' WHERE id='$data[id] '";

		if ($sql = $this->conn->query($query)) {
			return true;
		} else {
			return false;
		}
	}
}
