<?php
require_once("./src/shared/GeneralResponse.php");
require_once("./src/dao/MessageDao.php");

class MessageCtrl {
    private $uri;

    private $messageDao;
    private $generalResponse;

    public function __construct($uri){
        $this->uri = $uri;

        $this->generalResponse = new GeneralResponse();
        $this->messageDao = new MessageDao();
    }

    public function getAllMessages(){
        $result = $this->messageDao->findAll();
        header("status_code_header: HTTP/1.1 200 OK");
        return $result;
    }

    public function getMessage($id){
        // $result = $this->personGateway->find($id);
        // if (! $result) {
        //     return $this->generalResponse->notFoundResponse("message");
        // }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        echo "getonem";
        return $response;
    }

    public function createMessageFromRequest(){
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        // if (! $this->validateMessage($input)) {
        //     return $this->generalResponse->unprocessableEntityResponse();
        // }
        // $this->personGateway->insert($input);
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = null;
        echo "postm";
        return $response;
    }

    private function validateMessage($input)
    {
        if (! isset($input['firstname'])) {
            return false;
        }
        if (! isset($input['lastname'])) {
            return false;
        }
        return true;
    }
}
?>