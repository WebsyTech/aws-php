<?php

namespace WebsyTech\AWS\SES;

use Aws\Ses\SesClient;
use Aws\Exception\AwsException;

class SES
{

    private $SesClient;

    protected $profile = "default";

    protected $version =  "2010-12-01";

    protected $region = "us-east-1";

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $this->SesClient = null;
        $this->SesClient = new SESClient(
            [
                'profile' => $this->profile,
                'version' => $this->version,
                'region' => $this->region
            ]
        );
    }

    public function region(string $region = null)
    {
        if($region == null) :
            return $this->region;
        else :
            $this->region = $region;
            $this->connect();
            return $this->region;
        endif;
    }

    public function version(string $version = null)
    {
        if($version == null) :
            return $this->version;
        else :
            $this->version = $version;
            $this->connect();
            return $this->version;
        endif;
    }

    public function profile(string $profile = null)
    {
        if($profile == null) :
            return $this->profile;
        else :
            $this->profile = $profile;
            $this->connect();
            return $this->profile;
        endif;
    }


    public function bulkTemplatedEmail()
    {
        return new BulkTemplatedEmail();
    }

    public function destination()
    {
        return new Destination();
    }

    public function email()
    {
        return new Email();
    }

    public function template()
    {
        return new Template();
    }

    public function send($email)
    {
        switch(get_class($email)) :
            case (Email::class):
                return $this->sendEmail($email);
            case (TemplatedEmail::class):
                return $this->sendTemplatedEmail($email);
            case (BulkTemplatedEmail::class):
                return $this->sendBulkTemplatedEmail($email);
        endswitch;

    }

    public function sendEmail($email)
    {
        // Send email.
        // Return response.
        return new Response\EmailResponse();
    }

    public function sendTemplatedEmail($email)
    {
        // Send email.
        // Return response.
        return new Response\EmailResponse();
    }

    public function sendBulkTemplatedEmail($email)
    {
        $params = [
            'DefaultTemplateData' => $email->defaultTemplateData("json"),
            'Destinations' => $email->destinations("array"),
            'ReplyToAddresses' => $email->replyToAddresses(),
            'ReturnPath' => $email->return(),
            'Source' => $email->from(),
            'Template' => $email->template(),
        ];

        $result = $this->SesClient->sendBulkTemplatedEmail($params);

        return $result;
    }
}
