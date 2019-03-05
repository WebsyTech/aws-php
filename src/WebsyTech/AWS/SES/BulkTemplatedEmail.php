<?php

namespace WebsyTech\AWS\SES;

class BulkTemplatedEmail
{
    /**
    * An array of destination objects.
    * @var array
    */
    protected $destinations;

    /**
    * The email address the email will be sent from.
    * @var string
    */
    protected $source;

    /**
    * The name of the template to send.
    * @var string
    */
    protected $template;

    /**
    * An object containing default template data.
    * @var object
    */
    protected $defaultTemplateData;

    /**
    * An array containing strings representing addresses.
    * @var array
    */
    protected $replyToAddresses;

    /**
    * The email address that bounces and complaints will be forwarded to when
    * feedback forwarding is enabled.
    * @var string
    */
    protected $returnPath;


    public function __construct()
    {
        $this->destinations = [];
        $this->replyToAddresses = [];
    }

    /**
    * Add a destination to the destinations array.
    */
    public function addDestination(Destination $destination)
    {
        array_push($this->destinations, $destination);
    }

    /**
    * Remove a specified destination from the destinations array.
    * @param  int    $index [description]
    */
    public function removeDestination(int $index)
    {
        unset($this->destinations[$index]);
    }

    /**
    * Returns the destinations array.
    * @return [type] [description]
    */
    public function destinations($type = "object")
    {
        switch($type) :
            case "array" :
                return $this->destinationsToArray();
            default :
                return $this->destinations;
        endswitch;
    }

    public function purgeDestinations()
    {
        $this->destinations = array();
    }

    /**
    * Add a destination to the destinations array.
    */
    public function addReplyToAddress(string $email)
    {
        array_push($this->replyToAddresses, $email);
    }

    /**
    * Remove a specified destination from the destinations array.
    * @param  int    $index [description]
    */
    public function removeReplyToAddress(int $index)
    {
        unset($this->replyToAddresses[$index]);
    }

    /**
    * Returns the destinations array.
    * @return [type] [description]
    */
    public function replyToAddresses() {
        return $this->replyToAddresses;
    }

    /**
     * Sets and/or returns the from field for the email.
     * @param  string $template from field for the bulk email.
     * @return string           from field for the bulk email.
     */
    public function from($source = null)
    {
        if ($source == null) :
            return $this->source;
        else :
            return $this->source = $source;
        endif;
    }

    /**
     * Sets and/or returns the return to address for bounced emails..
     * @param  string $template return address for the bulk email.
     * @return string           return address for the bulk email.
     */
    public function return($returnPath = null)
    {
        if ($returnPath == null) :
            return $this->returnPath;
        else :
            return $this->returnPath = $returnPath;
        endif;
    }

    /**
     * Sets and/or returns the name of the template that will be used for the bulk email.
     * @param  string $template Name of the template for the bulk email.
     * @return string           Name of the template for the bulk email.
     */
    public function template($template = null)
    {
        if ($template == null) :
            return $this->template;
        else :
            return $this->template = $template;
        endif;
    }

    /**
     * Set default default replacement data for any key for the template.
     * @param string $key   The variable that will be replaced in the template.
     * @param string $value The text that will replace the variable in the template.
     */
    public function setDefaultReplacementData(string $key, string $value)
    {
        $this->defaultTemplateData[$key] = $value;
    }

    /**
     * Delete the default replacement data for any key for the template.
     * @param  string $key The variable you would like to remove the default value for.
     */
    public function deleteDefaultReplacementData($key)
    {
        unset($this->defaultTemplateData[$key]);
    }

    public function defaultTemplateData($type = "array")
    {
        switch($type) :
            case "json" :
                return json_encode($this->defaultTemplateData);
            default :
                return $this->defaultTemplateData;
        endswitch;
    }

    private function destinationsToArray()
    {
        $list = [];
        foreach($this->destinations as $destination) :
            $list[] = [
                "Destination" => [
                    "ToAddresses" => $destination->toAddresses(),
                ],
                'ReplacementTemplateData' => $destination->replacementData("string"),
            ];
        endforeach;
        return $list;
    }
}
