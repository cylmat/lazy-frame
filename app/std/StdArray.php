<?php

//namespace StdCore/StdArray;

/**
 * Class StdArray 
 * 
 * @package    Stdarray
 * @copyright  Copyright (c) Url (fr) 2018
 * @author     Cylmat
 * @license    http://creativecommons.org/licenses/by/2.0/fr/ Creative Commons
 */

/**
 * Class Array
 * 
abstract public mixed current ( void )
abstract public scalar key ( void )
abstract public void next ( void )
abstract public void rewind ( void )
abstract public bool valid ( void )
 * 
 * 
 *     ArrayObject::append — Ajoute la valeur à la fin d'un tableau
    ArrayObject::asort — Trie les éléments par valeur
    ArrayObject::__construct — Construit un nouvel objet tableau
    ArrayObject::count — Retourne le nombre de propriétés publiques dans l'objet ArrayObject
    ArrayObject::exchangeArray — Remplace un tableau par un autre
    ArrayObject::getArrayCopy — Crée une copie de l'objet ArrayObject
    ArrayObject::getFlags — Lit les options de comportement
    ArrayObject::getIterator — Crée un nouvel itérateur à partir d'un objet ArrayObject
    ArrayObject::getIteratorClass — Lit le nom de la classe de ArrayObject
    ArrayObject::ksort — Trie un tableau par clé
    ArrayObject::natcasesort — Trie un tableau en utilisant le tri naturel sans la casse
    ArrayObject::natsort — Trie les éléments avec un tri naturel
    ArrayObject::offsetExists — Vérifie si un index existe
    ArrayObject::offsetGet — Retourne la valeur de l'index spécifié
    ArrayObject::offsetSet — Définie $newval comme valeur à l'$index spécifié
    ArrayObject::offsetUnset — Efface la valeur à l'$index spécifié
    ArrayObject::serialize — Linéarise un ArrayObject
    ArrayObject::setFlags — Configure les options de comportement
    ArrayObject::setIteratorClass — Définit le nom de la classe de l'itérateur pour l'objet ArrayObject
    ArrayObject::uasort — Trie les éléments avec une fonction utilisateur
    ArrayObject::uksort — Trie les éléments par clé avec une fonction utilisateur
    ArrayObject::unserialize — Délinéarisation d'un ArrayObject
 * 
 * 
 */


class StdArray extends ArrayObject //Iterator
{
    /*
     * array array_chunk ( array $array , int $size [, bool $preserve_keys = FALSE ] )
     */
    
    //array array_combine ( array $keys , array $values )
    
    /*
     * bool array_key_exists ( mixed $key , array $array )
     */
    
    /*
     * mixed current ( array $array )
     */
    
    /*
     * mixed key ( array $array )
     */
    
    /*
     * mixed next ( array &$array )
     */
    
    /*
     * mixed reset ( array &$array )
     */
    
    /*
     * bool valid ( void )
     */
    
    /*
     * $yourObject->array_keys();
     */
    public function __call($func, $argv)
    {
        if (!is_callable($func) || substr($func, 0, 6) !== 'array_')
        {
            throw new BadMethodCallException(__CLASS__.'->'.$func);
        }
        return call_user_func_array($func, array_merge(array($this->getArrayCopy()), $argv));
    }
}

