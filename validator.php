<?php
libxml_use_internal_errors(true);

$xml = new DOMDocument();
$xml->load("products.xml");

if ($xml->schemaValidate("products.xsd")) {
    echo "XML validated successfully.";
} else {
    echo "XML validation failed.<br><br>";

    foreach (libxml_get_errors() as $error) {
        echo "Line " . $error->line . ": " . $error->message . "<br>";
    }

    libxml_clear_errors();
}
?>