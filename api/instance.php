<?
try {
    $dbh = new PDO('mysql:host=localhost;dbname=practice', 'root', '');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>