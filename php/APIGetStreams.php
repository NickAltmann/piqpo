<?php

require_once(getenv("DOCUMENT_ROOT")."/inc_piqpo.php");

class APIGetStreams extends APICommandUserBase
{
    public final function description ()
    {
        return "Get list of all available streams, marking which user default profile is subscribed to";
    }
    
    public final function doWork( $inputs, $userId )
    {
        $profileManager = new ProfileManager;
        
        $profile = $profileManager->getUserProfile($userId);

        if ( isset($profile) )
        {
            $streamManager = new StreamManager();

            $streamInfoList = array();
            $subscribedStreams = array();
            
            $userStreams = $streamManager->profileStreams($profile->profileId()); 
            foreach ($userStreams as $stream)
            {
                $subscribedStreams[ $stream->streamId() ] = $stream;
            }

            $allStreams = $streamManager->allStreams($userId);                        
            
            foreach ($allStreams as $stream)
            {
                $isAssigned = false;
                if ( array_key_exists($stream->streamId(), $subscribedStreams) )
                {
                    $isAssigned = true;
                }
                $streamInfoList[] = $streamManager->streamInfoArray( $stream, $isAssigned );             
            }
            
            $apiResult = APIOutput::success(array('streams' => $streamInfoList));
        }
        else
        {
            $apiResult = APIOutput::error(APIErrorCode::failure, 'User profile not found');            
        }
        
        return $apiResult;
    }
    
    public final function addInputs()
    {
        return array(  );
    }    
}

?>
