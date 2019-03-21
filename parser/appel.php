<html>
<body>
<?php
 
include ('XmlParser.php');

$parser = new XmlParser('https://www.lemonde.fr/rss/une.xml');
$parser ->parse();
$result = $parser->getResult();
echo($result);
?>
</body>
</html>
