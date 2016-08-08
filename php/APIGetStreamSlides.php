<?php

require_once(getenv("DOCUMENT_ROOT")."/inc_piqpo.php");

class APIGetStreamSlides extends APICommand
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public final function run( $inputs )
    {
        $slideManager = new SlideManager();

        $slides = $slideManager->getStreamSlides($inputs['stream']);

        $apiOutput = APIOutput::success(array('slides' => $slides));
        
        return $apiOutput;
    }
    
    public final function description()
    {
        return "Returns slides for a given stream.";
    }
    
    public final function inputs()
    {
        $inputs = array( new APIParameter( 'stream', 'Stream id', true ) );
        return $inputs;
    }    
}

?>
