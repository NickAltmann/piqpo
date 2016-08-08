<?php

require_once(getenv("DOCUMENT_ROOT")."/inc_piqpo.php");

class APISubscribeToStream extends APICommandUserBase
{
    public final function description ()
    {
        return "Subscribe profile to stream";
    }
    
    public final function doWork( $inputs, $userId )
    {
        $profileManager = new ProfileManager;
        
        $profile = $profileManager->getUserProfile($userId);

        if ( isset($profile) )
        {
            $streamManager = new StreamManager();

            $result = $streamManager->assignProfileStream($profile->profileId(), $inputs['stream']);

            if ( $result->success() )
            {
                $apiResult = APIOutput::success(array());
            }
            else
            {
                $apiResult = APIOutput::error(APIErrorCode::failure, $result->errorText());
            }
        }                
        return $apiResult;
    }
    
    public final function addInputs()
    {
        return array( new APIParameter( 'stream', 'Stream to add', true ) );
    }        
}

?>
