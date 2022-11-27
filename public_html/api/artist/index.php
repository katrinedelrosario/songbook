<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/assets/incl/init.php";

/**
 * Hent liste af sange (GET)
 */
Route::add('/api/artist/', function() {
	$artist = new Artist;
	$result = $artist->list();
	echo Tools::jsonParser($result);
});

/**
 * Hent en sangs detaljer ud fra id (GET)
 */
Route::add('/api/artist/([0-9]*)', function($id) {
	$artist = new Artist;
	$result = $artist->details($id);
	echo Tools::jsonParser($result);
});

/**
 * Opret en ny sang (POST)
 */
Route::add('/api/artist/', function() {
	$artist = new Artist;
	$artist->name = isset($_POST['name']) && !empty($_POST['name']) ? $_POST['name'] : null;

	if($artist->name) {
		echo $artist->create();
	} else {
		echo "Could not create new artist";
	}
}, 'post');

/**
 * Opdater en sang ud fra id (PUT)
 */
Route::add('/api/artist/', function() {
	$data = file_get_contents("php://input");
	parse_str($data, $parsed_data);

	$artist = new Artist;
	$artist->id = isset($parsed_data['id']) && !empty($parsed_data['id']) ? (int)$parsed_data['id'] : null;
	$artist->name = isset($parsed_data['name']) && !empty($parsed_data['name']) ? $parsed_data['name'] : null;

	if($artist->id && $artist->name) {
		echo $artist->update();
	} else {
		echo "Could not update artist";
	}
}, 'put');

/**
 * Slet sang ud fra id (DELETE)
 */
Route::add('/api/artist/([0-9]*)', function($id) {
	$artist = new Artist;
	echo $artist->delete($id);
}, 'delete');

Route::run('/');
?>