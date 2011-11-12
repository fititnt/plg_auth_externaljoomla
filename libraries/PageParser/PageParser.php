<?php

/**
 * @package         PageParser
 * @author          Emerson Rocha Luiz - emerson at webdesign.eng.br - http://fititnt.org
 * @copyright       Copyright (C) 2011 Webdesign Assessoria em Tecniligia da Informacao. All rights reserved.
 * @license         GNU General Public License version 3. See license-gpl3.txt
 * @license         Massachusetts Institute of Technology. See license-mit.txt
 * @version         0.1alpha
 * 
 */

class PageParser {
    /**
     * DomDocument object
     * 
     * @var Object
     */

    private $dom;

    /**
     * Type of document to parse
     * 
     * @param Object
     */
    private $doctype = 'HTML';


    /**
     * Content to parse
     * 
     * @var String
     */
    private $content;


    /**
     * Value of last parset element
     * 
     * @var String 
     */
    private $element;

    /**
     * Value of last parset array of element
     * 
     * @param Array 
     */
    private $elements;

    /**
     * ID of element to parse
     * 
     * @param String
     */
    private $id;

    /**
     * Path of element to parse
     * 
     * @param String
     */
    private $path;

    /**
     * Initialize values
     */

    function __construct() {
        $this->dom = $doc = new DomDocument;
        $this->dom->preserveWhiteSpace = false;
    }

    function __destruct() {
        //
    }

    /**
     * Function to debug $this object
     *
     * @param String $method: print_r or, var_dump
     * @param Boolean $format: true for print <pre> tags. Default false
     * @return Void
     */
    public function debug($method = 'print_r', $format = FALSE) {
        if ($format) {
            echo '<pre>';
        }
        if ($method === 'print_r') {
            print_r($this);
        } else {
            var_dump($this);
        }
        if ($format) {
            echo '</pre>';
        }
    }

    /**
     * Delete (set to NULL) generic variable
     * 
     * @param[in] String $name: name of var to return
     * @return Object $this
     */

    public function del($name) {
        $this->$name = NULL;
        return $this;
    }

    /**
     * Execute Dig. Set TRUE for return content. Default FALSE to just set internal variable
     * 
     * @param[in] String $method: TRUE for return contents, FALSE for not
     * @return Mixed $this object OR $this->content String
     */

    public function pp($method = FALSE) {
        //
    }

    /**
     * Execute Dig. Set TRUE for return content. Default FALSE to just set internal variable
     * 
     * @param String $value: value of id to return
     * @param String $method: TRUE for return contents, FALSE for not
     * @return Mixed $this object OR $this->content String
     */

    public function ppId($value, $method = TRUE) {
        if ($this->doctype === 'HTML') {
            $this->dom->loadHTML($this->content);
            $this->element = $this->dom->getElementById($value)->nodeValue;
        } else {
            die('PageParser: Document Type is not implemented yet. Use HTML type');
        }

        if ($method) {
            return $this->element;
        } else {
            return $this;
        }
    }

    /**
     * Return generic variable
     * 
     * @param[in] String $name: name of var to return
     * @return Mixed $this->$name: value of var
     */

    public function get($name) {
        return $this->$name;
    }

    /**
     * Return last parsed element ( $this->element )
     * @return mixed $this->$name: value of var
     */

    public function getElement() {
        return $this->element;
    }

    /**
     * Set one generic variable the desired value
     * 
     * @param[in] String $name: name of var to return
     * @return Object $this
     */

    public function set($name, $value) {
        $this->$name = $value;
        return $this;
    }

    /**
     * Set content page to parse
     * 
     * @param[in] String $value: value to set
     * @return Object $this
     */

    public function setPage($value) {
        $this->content = $value;
        return $this;
    }

    /**
     * Set Type of document to parse
     * 
     * @param[in] String $value: value to set
     * @return Object $this
     */

    public function setType($value = 'HTML') {
        $this->doctype = strtoupper($value);
        return $this;
    }

}
