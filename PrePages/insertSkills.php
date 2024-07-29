<?php 
require('createConn.php');

$sql = "INSERT INTO skill (Title, Description) VALUES
('Carpentry', 'All kinds of carpentry works.'),
('Pest Control', 'All kinds of pest control services.'),
('Cementing', 'All kinds of cementing works.'),
('Masonry', 'All kinds of masonry works.'),
('Dish Network', 'Installation and maintenance of dish networks.'),
('Painting', 'All kinds of painting works.'),
('HVAC', 'Heating, Ventilation, and Air Conditioning services.'),
('Electrical', 'All kinds of electrical works.'),
('Plumbing', 'All kinds of plumbing works.');";

$conn -> query($sql);
$conn -> close();

?>

