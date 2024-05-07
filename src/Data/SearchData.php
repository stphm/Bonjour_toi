<?php 

namespace App\Data;

/**
 * Permet de faire les filtres avec le Match
 */
class SearchData
{

    
    /**
     * @var string
     */
    public $q = '';
    

    /**
     * @var boolean
     * True = Women
     */
    public $sexe = true;  


    /**
     * @var null|integer
     */
    public $max;

    /**
     * @var null|integer
     */
    public $min; 



}