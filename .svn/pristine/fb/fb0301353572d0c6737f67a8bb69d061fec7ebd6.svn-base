<?php

class FeedDefinitionManager
{
	function __construct()
	{
		$this->_fileRoot = $GLOBALS['LOCAL_ROOT']."/definition_files/";
	}
	    
	// Returns an array of transform file names, only the leaf name, not directory
	function getDefinitionFiles( )
	{
        $directory = $this->_fileRoot;
		$files = array();
				
		foreach(new DirectoryIterator( $directory ) as $file)
		{
			if (!$file->isDot() && $file->isFile())
			{
				$files[] = $file->getFilename();
			}
		}
		
		return $files;
	}
	
	function formFullFilename( $filename )
	{
		return $this->_fileRoot . $filename;
	}
    
    function getParameters($filename)
    {
        $parameters = array();
        
        if (!file_exists ( $filename ) )
        {
            return $parameters;
        }
        
   		$fileString = file_get_contents( $filename );

        $definitionDOM = new DOMDocument;
		$definitionDOM->loadXML($fileString);
		$definitionXPath = new DOMXPath($definitionDOM);
		
		// Query for params
		$parameterNodes = $definitionXPath->query("/Feed/Parameters/*");
		foreach ($parameterNodes as $parameterNode)
		{
            $attr = $parameterNode->attributes->getNamedItem("name");
            if (isset($attr))
			{
    			$parameters[] = $attr->value;
            }
            else
            {
    			throw new Exception("Parameter attribute missing name on {$fileString} feed definition");            
            }            
        }
        
        return $parameters;
    }

	private $_fileRoot;
}

?>