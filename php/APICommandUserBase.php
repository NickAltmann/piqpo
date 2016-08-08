<?php

require_once(getenv("DOCUMENT_ROOT")."/inc_piqpo.php");

abstract class APICommandUserBase extends APICommand
{
    public function __construct()
    {
        parent::__construct();
    }

    final public function run( $inputs )
    {
        $userId = null;
        $userManager = new UserManager();
        
        if (array_key_exists('token', $inputs))
        {
            $user = $userManager->getUserFromToken($inputs['token']);
            if ( isset($user) )
            {
                $userId = $user->userId();
            }
        }
        else
        {
            $userId = $userManager->getUserIdFromCookieToken( );
        }
        
        $result = null;
        if ( !isset($userId) )
        {
            $result = APIOutput::error(APIErrorCode::userNotAuthenticated, "Authentication failed");
        }
        else
        {
            $result = $this->doWork( $inputs, $userId );
        }
        
        return $result;
    }
    
    public final function inputs()
    {
        $inputs = array( new APIParameter( 'token', 'User token', false ) );
        
        return array_merge($inputs, $this->addInputs());
    }    
        
    protected abstract function doWork( $inputs, $userId );
    protected abstract function addInputs();
}

?>
