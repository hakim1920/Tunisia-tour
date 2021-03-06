<?PHP
include_once "config.php";


class voyagesC
{

	function ajoutervoyages($voyages)
	{
		$sql = "INSERT INTO voyages (destination, prix, depart, retour, image) 
			VALUES (:destination,:prix,:depart,:retour,:image)";
		$db = config::getConnexion();
		try {
			$query = $db->prepare($sql);
			$query->execute([
				'destination' => $voyages->getdestination(),
				'prix' => $voyages->getprix(),
				'depart' => $voyages->getdepart(),
				'retour' => $voyages->getretour(),
				'image' => $voyages->getimage(),
			]);
		} catch (Exception $e) {
			echo 'Erreur: ' . $e->getMessage();
		}
	}

	function affichervoyages()
	{

		$sql = "SELECT * FROM voyages";
		$db = config::getConnexion();
		try {
			$liste = $db->query($sql);
			return $liste;
		} catch (Exception $e) {
			die('Erreur: ' . $e->getMessage());
		}
    }
    public function deletevoyages($id) {
        $sql="delete  from voyages where id= '$id' ";
        $db=config::getConnexion();
        $query=$db->prepare($sql);
        $query->execute([
                'id' => $id]);
        }
	function supprimervoyages($id)
	{
		$sql = "DELETE FROM voyages WHERE id= :id";
		$db = config::getConnexion();
		$req = $db->prepare($sql);
		$req->bindValue(':id', $id);
		try {
			$req->execute();
		} catch (Exception $e) {
			die('Erreur: ' . $e->getMessage());
		}
	}

	public function modifiervoyages($destination,$prix,$depart,$retour,$image,$id) {
		$sql="update voyages SET 
							destination = :destination,
							prix = :prix, 
							depart = :depart,
							retour = :retour,
							image = :image,
	
						WHERE id = :id";
		$db=config::getConnexion(); 
		$query=$db->prepare($sql);
		$query->execute([
						'destination' => $destination,
						'prix' => $prix,
						'depart' => $depart,
						'retour' => $retour,
						'image' => $image,
						'id' => $id,
					]); 
		}
	function recuperervoyages($id)
	{
		$sql = "SELECT * from voyages where id=$id";
		$db = config::getConnexion();
		try {
			$query = $db->prepare($sql);
			$query->execute();

			$user = $query->fetch();
			return $user;
		} catch (Exception $e) {
			die('Erreur: ' . $e->getMessage());
		}
	}

	function recuperervoyages1($id)
	{
		$sql = "SELECT * from voyages where id=$id";
		$db = config::getConnexion();
		try {
			$query = $db->prepare($sql);
			$query->execute();

			$user = $query->fetch(PDO::FETCH_OBJ);
			return $user;
		} catch (Exception $e) {
			die('Erreur: ' . $e->getMessage());
		}
	}
	}
	


	function getdestination($destination) {
		try {
			$db = config::getConnexion();
			$query = $db->prepare(
				'SELECT * FROM voyages WHERE destination = :destination'
			);
			$query->execute([
				'destination' => $destination
			]);
			return $query->fetch();
		} catch (PDOException $e) {
			$e->getMessage();
		}
	}

	 function getvoyages($prix) {
		
		try {
			$db = config::getConnexion();
			$query = $db->prepare(
				'SELECT * FROM voyages WHERE prix = :prix'
			);
			$query->execute([
				'prix' => $prix
			]);
			return $query->fetch();
		} catch (PDOException $e) {
			$e->getMessage();
		}
	}