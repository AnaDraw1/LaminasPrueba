<?php

namespace Usuarios\Model\Rowset;

abstract class AbstractModel
{
    protected $baseUrl;
    public $id;
    
    public function __construct($baseUrl = null)
    {
        $this->baseUrl = $baseUrl;
    }
}

?>