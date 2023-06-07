<?php

namespace Ecommage\Blogext3\Plugin;

class ExamplePlugin{
    public function beforeSetTitle(\Ecommage\Blogext3\Controller\Index\Example $subject, $title)
    {
        $title = $title . " to ";
        echo __METHOD__ . "</br>";

        return [$title];
    }
    public function afterGetTitle(\Ecommage\Blogext3\Controller\Index\Example $subject, $result)
    {

        echo __METHOD__ . "</br>";

        return '<h1>'. $result . 'Mageplaza.com' .'</h1>';

    }


    public function aroundGetTitle(\Ecommage\Blogext3\Controller\Index\Example $subject, callable $proceed)
    {

        echo __METHOD__ . " - Before proceed() </br>";
            $result = $proceed();
        echo __METHOD__ . " - After proceed() </br>";


        return $result;
    }


}
