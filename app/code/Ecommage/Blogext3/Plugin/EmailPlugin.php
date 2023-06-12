<?php

namespace Ecommage\Blogext3\Plugin;

class EmailPlugin
{
    public function beforeGetTitle(\Ecommage\Blogext3\Block\Email $subject)
    {
       echo "Hello World";
    }
}
