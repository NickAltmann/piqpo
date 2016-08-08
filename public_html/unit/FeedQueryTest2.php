<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="/3rd_party/jquery/jquery-1.7.1.js"></script>
<script>
    $( function(){
       $("#definition_file").change(function() {
            window.location.href = 'http://' + window.location.hostname +  window.location.pathname + "?d=" + $('select[name=definition_file]').val();
            })
        }
        );
</script>
</head>
<body>
<?php

require_once(getenv("DOCUMENT_ROOT")."/inc_piqpo.php");

$definitionFile = null;

// Get definition file if set via a get
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    $definitionFile = $_GET['d'];
}

// Get POST values
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $definitionFile = $_POST['definition_file'];
}

// Begin form
print "<form action='{$_SERVER["SCRIPT_NAME"]}' method='POST'>";

// Definition file
$feedDefinitionManager = new FeedDefinitionManager();
$files = $feedDefinitionManager->getDefinitionFiles();
print "Definition file:<br/><select style='width:600px;' name='definition_file' id='definition_file' >";
foreach($files as $file)
{
	$selected = (isset($definitionFile) && ($definitionFile == $file)) ? "selected" : ""; 
	print "<option value={$file} {$selected}>{$file}</option>";
}
print '</select><p/>';

// Parameters
$allParamsSet = false;
$parameterValues = array();
if ( isset($definitionFile) )
{
    $feedFilename = $feedDefinitionManager->formFullFilename( $definitionFile );
    $params = $feedDefinitionManager->getParameters( $feedFilename );

    $allParamsSet = true;
    foreach( $params as $param )
    {
        $value = $_POST[$param];

        $valueText = "";
        if ( isset($value) && (strlen($value) > 0) )
        {
            $parameterValues[ $param ] = $value;
            $valueText = " value='{$value}' ";
        }
        else
        {
            $allParamsSet = false;
        }
        print "{$param}:<br/><input type=text style='width:600px;' name='{$param}' {$valueText} /><br/>";
    }
}

print "<p/><input type='submit' value='Sumbit' />";
print '</form>';

print '<hr/>';

if ( $allParamsSet )
{
    $feedFilename = $feedDefinitionManager->formFullFilename( $definitionFile );

    $feedQuery = new FeedQuery('none', $feedFilename, 10, $parameterValues, array());

    $debugOutput = "";
    $result = $feedQuery->performQuery( $debugOutput );

    print "<p/>Generated " . count( $result ) . " slides:";
    foreach($result as $id => $slideInfo)
    {
        print "<p/>Slide: {$id}<br/>";
        print XMLTaggifier::createTable( $slideInfo->tags() );
    }

    print "<hr/>Debug output:<p/>" . $debugOutput;
}

?>
</body>
</html>
