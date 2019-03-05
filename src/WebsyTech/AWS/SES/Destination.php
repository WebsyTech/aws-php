<?php

namespace WebsyTech\AWS\SES;

class Destination
{
    /**
    * An array of email addresses represented as strings to be in the To: field.
    * @var array
    */
    protected $toAddresses;

    /**
    * An associative array with key/value pairs to replace variables in a template.
    * @var array
    */
    protected $replacementTemplateData;

    public function __construct()
    {
        $this->toAddresses = array();
        $this->replacementTemplateData = array();
    }

    /**
     * Add an email address to the to field.
     * @param string $emailAddress An email address
     * @return integer Returns the number of to addresses.
     */
    public function addToAddress(string $emailAddress)
    {
        return array_push($this->toAddresses, $emailAddress);
    }

    /**
     * Return the array of to: addresses.
     * @return array
     */
    public function toAddresses() : array
    {
        return $this->toAddresses;
    }

    /**
     * Remove an email address from the to: field.
     * @param  mixed    $key The index of the element you wish to remove from the array or the actual email string to search and remove.
     */
    public function removeToAddress($key)
    {
        switch(gettype($key)) :
            case "string":
                $index = array_search($key, $this->toAddresses);
                unset($this->toAddresses[$index]);
                break;
            case "integer":
                unset($this->toAddresses[$key]);
                break;
        endswitch;
    }

    public function setReplacementData($key, $value) {
        $this->replacementTemplateData[$key] = $value;
    }

    public function deleteReplacementData($key) {
        unset($this->replacementTemplateData[$key]);
    }

    public function replacementData($type = "array") {
        switch($type) :
            case "string" :
                return json_encode((object)$this->replacementTemplateData);
            default :
                return $this->replacementTemplateData;
        endswitch;
    }
}
