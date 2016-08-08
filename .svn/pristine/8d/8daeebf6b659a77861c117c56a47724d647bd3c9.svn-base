<?php

require_once(getenv("DOCUMENT_ROOT")."/inc_piqpo.php");

class APIGetProfileSlides extends APICommand
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public final function run( $inputs )
    {        
        $slideManager = new SlideManager();

        $slides = $slideManager->getProfileSlides($inputs['profile']);

        $apiOutput = APIOutput::success(array('slides' => $slides));
        
        return $apiOutput;
    }
    
    public final function inputs()
    {
        return array( new APIParameter( 'profile', 'Profile id', true ) );
    }    
    
    public final function description ()
    {
        return "Get list of slides for the profile.";
    }
    
}

?>
