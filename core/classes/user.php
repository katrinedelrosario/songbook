<?php
/**
 * Class Song med CRUD metoder
 */ 
class User {
	/**
	 * Class properties
	 */
	public $id;
	public $username;
	public $firstname;
	public $lastname;
    public $password;
    public $adress;
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
        $sql = "SELECT id, firstname, lastname, username, adress, password
        FROM user
        ORDER BY id";
    return $this->db->query($sql);

    }

	/**
	 * Metode til at hente sang detaljer
	 */
	public function details($id) {
        $params = array(
            'id' => array($id,PDO::PARAM_INT)
        );

        $sql = "SELECT username, firstname, lastname, adress
                FROM user
                WHERE id = :id";
        return $this->db->query($sql, $params, Db::RESULT_SINGLE);
    }

	/**
	 * Metode til at oprette sang med
	 */
    public function create() {
        $params = array(
            'username' => array($this->username, PDO::PARAM_STR),
            'firstname' => array($this->firstname, PDO::PARAM_STR),
            'lastname' => array($this->lastname, PDO::PARAM_STR),
            'password' => array($this->password, PDO::PARAM_STR),
            'adress' => array($this->adress, PDO::PARAM_STR),

        );
        $sql = "INSERT INTO user(username, firstname, lastname, password, adress)
                VALUES(:username, :firstname, :lastname, :password, :adress)";
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
            'username' => array($this->username, PDO::PARAM_STR),
            'firstname' => array($this->firstname, PDO::PARAM_STR),
            'lastname' => array($this->lastname, PDO::PARAM_STR),
            'password' => array($this->password, PDO::PARAM_STR),
            'adress' => array($this->adress, PDO::PARAM_STR),

        );
        $sql = "UPDATE user SET
                username = :username,
                firstname = :firstname,
                lastname = :lastname,
                password = :password,
                adress = :adress,
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