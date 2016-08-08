function apiSuccess( resp, successCallback, failureCallback )
{
    try
    {
        var obj = jQuery.parseJSON( resp );
        if ( obj.status == 101 )
        {
            window.location = "/basic_index.html";
        }
        else
        {
            successCallback( obj );                            
        }
    }
    catch(err)
    {
        failureCallback( err );            
    }
}    

function callAPI( method, params, successCallback, failureCallback )
{
    params.command = method;
    $.ajax(
        {
        type: "GET",			
        url: "/api/handler.php",
        data: params,
        cache: false,
        success: function( resp ) { apiSuccess( resp, successCallback ); },
        error: function( request, status ) { failureCallback( status ); } 
        });
}

function logOut()
{
    var params = new Object;                
    callAPI(    "logOut", 
                params,
                function() 
                {
                    window.location = "/basic_index.html";
                },
                function() 
                {
                    window.location = "/basic_index.html";
                }                    
            );  
}

function getUserDetails( callback )
{
    var params = new Object;                
    callAPI(    "getUserDetails", 
                params, 
                callback,
                function( mesg )
                {
                    alert(mesg);
                    logout();
                }
            );                         
}



