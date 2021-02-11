<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
require APPPATH . '/libraries/ImplementJwt.php';
class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->objOfJwt = new ImplementJwt();
        header('Content-Type: application/json');
    }

    public function index()
    {
        echo "Hello Shakir";
    }

    public function LoginToken()
    {
        $data = array(
                    'email' => "shakir.sedoc@gmail.com",
                    'github' => "mshakirkhan",
                    'status' => true
                );
        $jwtToken = $this->objOfJwt->GenerateToken($data);
        echo json_encode(array('Token'=>$jwtToken));
    }

    public function GetTokenData()
    {
        $received_Token = $this->input->request_headers('Authorization');
        try
        {
            $jwtData = $this->objOfJwt->DecodeToken($received_Token['Token']);
            echo json_encode($jwtData);
        }
        catch (Exception $e)
        {
            http_response_code('401');
            echo json_encode(array( "status" => false, "message" => $e->getMessage()));exit;
        }           
    }
}

?>