<?php
namespace TwilioWithThinq;
//require_once __DIR__ . '/../../vendor/autoload.php'; // Loads the library
use Services_Twilio;

class TwilioWrapper {
    private $client;
    private $twilio_account_sid;
    private $twilio_account_token;
    private $thinQId;
    private $thinQToken;
    const THINQ_DOMAIN = "wap.thinq.com";
    const TWIML_RESOURCE_URL = "http://demo.twilio.com/docs/voice.xml";

    function __construct($twilio_account_sid, $twilio_account_token, $thinQId, $thinQToken){
        $this->twilio_account_sid = $twilio_account_sid;
        $this->twilio_account_token = $twilio_account_token;
        $this->thinQId = $thinQId;
        $this->thinQToken = $thinQToken;

        $this->client = new Services_Twilio($twilio_account_sid, $twilio_account_token);        
    }

    public function isClientValid(){
        return $this->client != null && $this->client->account != null;
    }

    public function call($from, $to, $)
    {
        if(!$this->isClientValid()) {
            return "Invalid Twilio Account details.";
        }

        try{
            $call = $this->client->account->calls->create($from, "sip:" . $to . "@". self::DOMAIN, self::TWIML_RESOURCE_URL, array( 'thinQid' => $this->thinQid, 'thinQtoken' => $this->thinQtoken ));
            return $call->sid;
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
}