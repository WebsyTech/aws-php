<?php

namespace WebsyTech\AWS\SES;

class Template
{
    protected $name = "DefaultTemplate";

    protected $subjectPart = "Default Template";

    protected $textPart = "Default template body.";

    protected $htmlPart = "<p>Default html template body.</p>";

    /**
    * Get or Set the name of the template.
    * @param  mixed $name A string or null.
    * @return string       [description]
    */
    public function name(string $name=NULL) : string
    {
        if ($name != null) :
            $this->name = $name;
        endif;
        return $this->name;
    }

    /**
    * Get or Set the subject of the template.
    * @param  mixed $subjectPart A string or null.
    * @return string       [description]
    */
    public function subject(string $subjectPart=NULL) : string
    {
        if ($subjectPart != null) :
            $this->subjectPart = $subjectPart;
        endif;
        return $this->subjectPart;
    }

    /**
    * Get or Set the text of the template.
    * @param  mixed $textPart A string or null.
    * @return string       [description]
    */
    public function text(string $textPart=NULL) : string
    {
        if ($textPart != null) {
            $this->textPart = $textPart;
        }
        return $this->textPart;
    }

    /**
    * Get or Set the html of the template.
    * @param  mixed $htmlPart A string or null.
    * @return string       [description]
    */
    public function html(string $htmlPart=NULL) : string
    {
        if ($htmlPart != null) {
            $this->htmlPart = $htmlPart;
        }
        return $this->htmlPart;
    }
}
