<?php
/**
 * Class Song med CRUD metoder
 */ 
class Artist {
	/**
	 * Class properties
	 */
	public $id;
	public $name;
	public $created_at;
	public $updated_at;
	private $db;

	/**
	 * Class Constructor
	 * Metode som kaldes automatisk når der kaldes en instans af klassen
	 * Constructoren globaliserer $db objektet og gør det tilgængeligt i sit scope.
	 * Derefter tildeles det til klassens egen db property
	 */
	public function __construct()
	{	
		global $db;
		$this->db = $db;
	}

	/**
	 * Metode til at hente alle sange
	 */
	public function list() {
		// Sætter sorteringsnøgle via GET vars - default nøgle er id
		$sortkey = isset($_GET['sortkey']) && !empty($_GET['sortkey']) ? $_GET['sortkey'] : 'id';
		// Sætter sorteringsretning via GET vars - default er ASC
		$dir = isset($_GET['dir']) && !empty($_GET['dir']) ? $_GET['dir'] : 'ASC';
		// Sætter begrænsning via GET vars - default alle
		$limit = isset($_GET['limit']) && !empty($_GET['limit']) ? (int)$_GET['limit'] : false;
		// Sætter felter via GET vars - default er id og title
		$attributes = isset($_GET['attributes']) && !empty($_GET['attributes']) ? $_GET['attributes'] : 'id, name';

		$sql = "SELECT $attributes  
				FROM artist 
				ORDER BY $sortkey $dir";
		$sql .= ($limit) ? " LIMIT " . $limit : "";
		return $this->db->query($sql);
	}

	/**
	 * Metode til at hente sang detaljer
	 */
	public function details($id) {
		$params = array(
			'id' => array($id, PDO::PARAM_INT)
		);

		$sql = "SELECT name 
				FROM artist 
				WHERE id = :id";
		return $this->db->query($sql, $params, Db::RESULT_SINGLE);
	}

	/**
	 * Metode til at oprette sang med
	 */
	public function create() {
		$params = array(
			'name' => array($this->name, PDO::PARAM_STR),
		);

		$sql = "INSERT INTO artist(name) 
				VALUES(:name)";
		$this->db->query($sql, $params);
		return $this->db->lastInsertId();
	}

	/**
	 * Metode til at opdatere en sang med
	 * Skal have sangens id med i form body
	 */
	public function update() {
		$params = array(
			'id' => array($this->id, PDO::PARAM_INT),
			'name' => array($this->name, PDO::PARAM_STR),
		);

		$sql = "UPDATE artist SET 
				name = :name,
				WHERE id = :id";

		return $this->db->query($sql, $params);
	}

	/**
	 * Metode til at slette en sang med
	 */
	public function delete($id) {
		$params = array(
			'id' => array($id, PDO::PARAM_INT)
		);
		
		$sql = "DELETE FROM artist 
				WHERE id = :id";
		return $this->db->query($sql, $params);
	}
}