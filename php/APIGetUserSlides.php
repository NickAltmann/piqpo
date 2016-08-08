<?php

require_once(getenv("DOCUMENT_ROOT")."/inc_piqpo.php");

class APIGetUserSlides extends APICommandUserBase
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public final function doWork( $inputs, $userId )
    {
        $profileManager = new ProfileManager;
        
        $profile = $profileManager->getUserProfile($userId);

        if ( isset($profile) )
        {
            $slideManager = new SlideManager();

            $slides = $slideManager->getProfileSlides($profile->profileId());

            $apiOutput = APIOutput::success(array('slides' => $slides));
        }
        else
        {
            $apiOutput = APIOutput::error(APIErrorCode::failure, 'User profile not found');            
        }
        
        return $apiOutput;
    }
    
    public final function addInputs()
    {
        return array(  );
    }    
    
    public final function description ()
    {
        return "Get list of slides for the user.";
    }
    
}

?>
