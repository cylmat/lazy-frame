<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 *
 * USE
 * 
 * 
        //form
        $form = new FormObj('/amzcatadmin.php'); 
        $form->createHidden('name', 'value');
        
        //form elements list
        $elements['nom']  = $form->createTextarea('txtarea')->setValue('2')->setRows(4);
        $elements['shop'] = $form->createSelect('shop', 'value')
                                    ->addOption('value1');

        //table
        $table = new TableObj();
        $table->insertForm($form, $form->getHiddenList());
        
        $table->createRow()
                ->addCol('Nom: '.$elements['nom']);
        $table->createRow()
                ->addCol('Shop: '.$elements['shop']);
        $table->createRow()
                ->addCol($form->createSubmit('validate')->setValue('Envoyer'));
        
        //display
        print $table->toHtml();
 
 * 
 * 
 * 
 * 
 * 
   $form = new FormObj($action); 
   $form->createHidden($name, $value);
   $table->insertForm($form, $form->getHiddenList());
 
   $elements = $form->genDbList($formElements, $data);
   $labels = $form->getLabelList();
 
   $labels[$name] = 'NOM: ';
   $elements[$name] = $form->createTextarea($name)->setValue($value)->setRows(4);
 
      genDbList($columns_name, $data)
      getValue($value, $data)
 
   $table->createRow()->addCol($labels)->setClass('left');
   $table->createRow()->addCol(  $form->createSubmit('validate')->setValue('Envoyer'));
   print $table->toHtml();
 *
 */


/*
 * FORMOBJ
 * 
     * setFormParams($p = array())
     * createHidden($name, $value='', $params='')
     * createText($name, $value='', $params='')
     * createLabel($name, $value='', $params='')
     * createTextarea($name, $value='', $params='')
     * createSelect($name, $value='', $params='')
     * createOption($name, $value='', $params='')
     * createSubmit($name, $value='', $params='')
     * elOut()
     * 
     * genDbList($db_columns, $dbData)
     * getValue($value, $data)
     * 
     * createImg($src='')
     * createA($href='')
     * createIframe($name='')
     */

/*
 * FORMELEMENT
 * 
     * setValue($val)
     * setParamValue($val)
     * setInsideValue($val)
     * 
     * setId($val)
     * setClass($val)
     * setSize($val)
     * setName($val)
     * setRows($val)
     * setStyle($val)
     * 
     * addParams($a = array())
     * setOnclick($array_fct)
     * 
     * setSrc($val)
     * setHref($val)
   */
    

class StdForm
{
    private $out = '';
    private $head = '';
    private $head_p = '';
    private $head_end = '';
    private $action = '';
    private $elements = '';
    private $bottom = '';
    
    private $hiddensList = array();
    private $elementsList = array();
    private $labelsList = array();
    private $submitsList = array();
    
    private $currentElement = '';
    
    private static $ret = "\n";
    
    /*
     * 
     */
    public function __construct($action='', $method='post', $txtParams='')
    {
        //$this->textMisc = new TextMisc();
        $this->create($action, $method, $txtParams);
    }
    
    public function __toString()
    {
        return $this->toHtml();
    }
    
    
    
    /*
     * SETTERS
     */
    public function addHiddenList($name, $element)
    {
        $this->hiddensList[$name] = $element;
    }
    
    public function addElementList($name, $element)
    {
        $this->elementsList[$name] = $element;
    }
    
    public function addLabelList($name, $element)
    {
        //if(preg_match($name))
        $this->labelsList[$name] = $element;
    }
    
    
    
    /*********
     * GETTERS
     */
    public function getHead()
    {
        return $this->head . $this->head_p . $this->head_end . self::$ret;
    }
    
    public function getBottom()
    {
        return $this->bottom;
    }
    
    /*******
     * List
     */
    public function getHiddenList()
    {
        return $this->hiddensList;
    }
    
    public function getElementList()
    {
        return $this->elementsList;
    }
    
    public function getLabelList()
    {
        return $this->labelsList;
    }
    
    public function getLabelListVal()
    {
        $a = array();
        
        foreach($this->labelsList as $n => $el)
        {//print_r($el) ;//.' - ';
            $a[$n] = $el->out();
        }
   //print_r($a);
        return $a;
    }
    
    public function getMixedList()
    {
        $list = array();
        foreach($this->elementsList as $k => $v)
            $list[$k] = $v;
        foreach($this->labelsList as $k => $v)
            $list['l_'.$k] = $v;
        return $list;
    }
    
    
    
    
    /******
     * FORM
     */
    //params: action, method
    public function create($action, $method='post', $params='')
    {
        $this->head = '<form method="'.$method.'" action="'.$action.'" '; //. self::$ret;
        $this->head_p = $params;
        $this->head_end = '>';
        $this->out = '';
        $this->bottom = "</form>";
    }
    
    public function setFormParams($p = array())
    {
        foreach($p as $name => $val)
            $this->head_p .= $name . '="'.$val.'" ';
        return $this;
    }
    
    public function setOnsubmit($txt)
    {
        $this->setFormParams(array('onSubmit'=>$txt));
        return $this;
    }
    
    
    
    
    /*******
     * Elements
     */
    public function createHidden($name, $value='', $params='')
    {
        //$el = '<input type="hidden" name="'.$name.'" value="'.$value.'" '.$this->insertParams($params).' />';
        $el = new StdFormElement();
        $el->createHidden();
        $el->setName($name);
        if('' != $value) $el->setParamValue($value);
        if('' != $params) $el->addParams($params);
        $this->currentElement = $el;
        $this->addHiddenList($name, $el);
        return $el;
    }
    
    public function createText($name, $value='', $params='')
    {
        //$el = '<input type="text" name="'.$name.'" value="'.$value.'" '.$this->insertParams($params).' />';
        $el = new StdFormElement();
        $el->createText();
        $el->setName($name);
        if('' != $value) $el->setParamValue($value);
        if('' != $params) $el->addParams($params);
        $this->currentElement = $el;
        $this->addElementList($name, $el);
        return $el;
    }
    
    public function createLabel($name, $value='', $params='')
    {
        //$el = '<label '.$this->insertParams($params).'>'.$value.'</label>';
        $el = new StdFormElement();
        $el->createLabel();

        $el->setName('l_'.$name);
        if('' != $value) $el->setInsideValue($value);
        if('' != $params) $el->addParams($params);
        $this->currentElement = $el;
        $this->addLabelList($name, $el);
  
        return $el;
    }
    
    //creer et AJOUTE a la liste
    public function createTextarea($name, $value='', $params='')
    {
        //$el = '<textarea name="'.$name.'" '.$this->insertParams($params).' >'.$value.'</textarea>';
        $el = new StdFormElement();
        $el->createTextArea();
        $el->setName($name);
        if('' != $value) $el->setInsideValue($value);
        if('' != $params) $el->addParams($params);
        $this->currentElement = $el;
        $this->addElementList($name, $el);
        return $el;
    }
    
    public function createSelect($name, $value='', $params='')
    {
        //$el = '<textarea name="'.$name.'" '.$this->insertParams($params).' >'.$value.'</textarea>';
        $el = new StdFormElement();
        $el->createSelect();
        $el->setName($name);
        if('' != $value) $el->setParamValue($value);
        if('' != $params) $el->addParams($params);
        $this->currentElement = $el;
        $this->addElementList($name, $el);
        return $el;
    }
    
    
    public function createSubmit($name, $value='', $params='')
    {
        //$el = '<input type="submit" name="'.$name.'" value="'.$value.'" '.$this->insertParams($params).' />';
        $el = new StdFormElement();
        $el->createSubmit();
        $el->setName($name);
        if('' != $value) $el->setParamValue($value);
        if('' != $params) $el->addParams($params);
        $this->currentElement = $el;
        $this->submitsList[$name] = $el;
        return $el;
    }
    
    public function createButton($name, $value='', $params='')
    {
        //$el = '<input type="submit" name="'.$name.'" value="'.$value.'" '.$this->insertParams($params).' />';
        $el = new StdFormElement();
        $el->createButton();
        $el->setName($name);
        if('' != $value) $el->setParamValue($value);
        if('' != $params) $el->addParams($params);
        $this->currentElement = $el;
        $this->submitsList[$name] = $el;
        return $el;
    }
    
    
    
    /*************
     * HTML
     *********/
    public function createDiv($inside='')
    {
        $el = new StdHtmlElement();
        $el->createDiv();
        $el->setValue($inside);
        //$this->addElementList($name, $el);
        return $el;
    }
    
    public function createImg($src='')
    {
        $el = new StdHtmlElement();
        $el->createImg();
        $el->setSrc($src);
        //$this->addElementList($name, $el);
        return $el;
    }
    
    public function createA($href='')
    {
        $el = new StdHtmlElement();
        $el->createA();
        $el->setHref($href);
        //$this->addElementList($name, $el);
        return $el;
    }
    
    public function createIframe($name='')
    {
        $el = new StdHtmlElement();
        $el->createIframe($name);
        //$this->addElementList($name, $el);
        return $el;
    }
    
    
    
    
    /***********
     *    FUNCTION
     */
    
    //params:
    //db_columns: array of name array('name1', 'name2'...)
    //dbData: array of data array('name1'=>val1, 'name2'=>val2)
    public function genDbList($columns, $data)
    {
        foreach($columns as $n => $col_name)
        {
            $label_el = $this->createLabel($col_name, ucfirst($col_name.': '));
            $el = $this->createText($col_name, $this->getValue($col_name, $data));      
        }
        return $this->getElementList();
    }
    
    /*
     * private
     */
    private function getValue($value, $data)
    {
        if(is_array($data) && is_string($value))
        {
            if(array_key_exists($value, $data))
                return $data[$value];
            return false;
        }
        elseif(is_object($data))
            return $data->$value;
        else return '';
    }
    
    
    public function addElements($array_elements)
    {
        if(!is_array($array_elements)) 
            $array_elements = array($array_elements);
        
        foreach($array_elements as $n => $element)
        {
            $this->out .= $element;
        }
    }
    
    //display ONE last element
    public function elOut()
    {
        return $this->currentElement->out();
    }
    
    /*
     * OUT
     */
    public function toHtml()
    {
        $this->out = $this->getHead();
        foreach($this->hiddensList as $name => $elh) $this->out .= $elh.self::$ret;
        foreach($this->elementsList as $name => $el) $this->out .= $el.self::$ret;
        foreach($this->submitsList as $name => $els) $this->out .= $els.self::$ret;
        $this->out .= $this->bottom;
        return $this->out;
    }
    
}









/**********************
 * ELEMENT
 **********/
class StdFormElement
{
    public $head = ''; //<td ';
    public $head_p = ''; //<td ';
    public $head_end = ''; //<td ';
    public $inside = '';
    public $type = '';
    public $bottom = ''; //</td>';
    
    //for selected option
    public $privateValue = ''; 
    //public $subElmt = null;
    
    public function __construct()
    {
        
    }
    
    public function __toString()
    {
        return $this->out();
    }
    
    
    
    public function addParams($a = array())
    {
        foreach($a as $name => $value)
        {
            //option
            if('selected' == $name) 
            {
//print $this->privateValue.'.'.$value.' - ';
          
                if(true !== $value)
                    if($this->privateValue == $value) $this->head_p .= ' selected ';
                    else $this->head_p .= '';
                else  
                    $this->head_p .= ' selected ';
            }
            elseif('disabled' == $name) $this->head_p .= ' disabled ';
                
            else $this->head_p .= $name.'="'.$value.'" ';
        }
        
        return $this;
    }
    
    
    /*
     * SETTERS + HTML
     */
    public function setValue($val)
    {
        switch($this->type)
        {
            case 'textarea': $this->setInsideValue($val); break;
            case 'option': $this->setInsideValue($val); break; //$this->setParamValue($val); break;
            case 'a': $this->setInsideValue($val); break;
            case 'iframe': $this->setInsideValue($val); break;
            case 'div': $this->setInsideValue($val); break;
            case 'label': $this->setInsideValue($val); break;
            
            default: $this->setParamValue($val);
        }
        
        return $this;
    }
    
    public function setParamValue($val)
    {
        $this->addParams(array('value'=>$val));
        return $this;
    }
    
    public function setInsideValue($val)
    {
        //$this->addParams(array('value'=>$val));
        $this->inside = $val;
        return $this;
    }
    
    public function addInsideValue($txt)
    {
        $this->inside .= $txt;
        return $this;
    }
    
    public function setId($val)
    {
        $this->addParams(array('id'=>$val));
        return $this;
    }
    
    public function setClass($val)
    {
        $this->addParams(array('class'=>$val));
        return $this;
    }
    
    public function setSize($val)
    {
        $this->addParams(array('size'=>$val));
        return $this;
    }
    
    public function setName($val)
    {
        $this->addParams(array('name'=>$val));
        return $this;
    }
    
    //textarea
    public function setRows($val)
    {
        $this->addParams(array('rows'=>$val));
        return $this;
    }
    
    public function setStyle($val)
    {
        $this->addParams(array('style'=>$val));
        return $this;
    }
    
    
    
    
    /*
     * JS array(fct1=>el1, fct2=>el2) => onClick(fct1(el1);fct2(el2))
     */
    public function setOnclick($array_fct)
    {
        if(!is_array($array_fct)) return $this;
        $js = ''; 
        
        foreach($array_fct as $fct_name => $fct_val)
            $js .= $fct_name .= "(".$fct_val.");";
        
        $js .= ' return false';
        $this->addParams(array('onClick'=>$js)); 
        return $this;
    }
    
    
    /*
     * ELEMENTS
     */
    //text
    public function createHidden()
    {
        $this->head = '<input type="hidden" ';
        $this->head_end = ' />';
        $this->type = 'hidden';
        return $this;
    }
    
    //text
    public function createText()
    {
        $this->head = '<input type="text" ';
        $this->head_end = ' />';
        $this->type = 'input';
        return $this;
    }
    
    public function createLabel()
    {
        $this->head = '<label ';
        $this->head_end = '>';
        $this->bottom = '</label>';
        $this->type = 'label';
        return $this;
    }
    
    //textArea
    public function createTextArea()
    {
        $this->head = '<textarea ';
        $this->head_end = ' >';
        $this->bottom = '</textarea>';
        $this->type = 'textarea';
        return $this;
    }
    
    //select
    public function createSelect()
    {
        $this->head = '<select ';
        $this->head_end = ' >';
        $this->bottom = '</select>';
        $this->type = 'select';
        return $this;
    }
    
    private function createOption()
    {
        $this->head = '<option ';
        $this->head_end = ' >';
        $this->bottom = '</option>';
        $this->type = 'option';
        return $this;
    }
    
    
    /*
     * for SELECT elements
     */
    public function addOption($txt, $option_value, $params='')
    {
        $elOpt = new StdFormElement();
        $elOpt->createOption();
        $elOpt->privateValue = $option_value;
        
//print 'opt'.$value;        
        //if('' != $value) 
        $elOpt->setValue($txt);
        $elOpt->setParamValue($option_value);
        if('' != $params) $elOpt->addParams($params);
        
        //'select' element
        $this->addInsideValue($elOpt->out());
        return $this; //'select' element
    }
    
    /*public function selected($nom)
    {
        if($this->value == $nom)
            
        return $this;
    }*/
    
    
    //submit
    public function createSubmit()
    {
        $this->head = '<input type="submit" ';
        $this->head_end = ' />';
        $this->type = 'input';
        return $this;
    }
    
    public function createButton()
    {
        $this->head = '<input type="button" ';
        $this->head_end = ' />';
        $this->type = 'input';
        return $this;
    }
    
    public function out()
    {
        return $this->head . $this->head_p. $this->head_end . $this->inside . $this->bottom;
    }
}//formelement





/*
 * HTML
 */
class StdHtmlElement extends StdFormElement
{
    public function createImg()
    {
        $this->head = '<img ';
        $this->head_end = ' />';
        $this->type = 'img';
        return $this;
    }
    
    public function createA()
    {
        $this->head = '<a ';
        $this->head_end = '>';
        $this->bottom = '</a>';
        $this->type = 'a';
        return $this;
    }
    
    public function createDiv()
    {
        $this->head = '<div ';
        $this->head_end = '>';
        $this->bottom = '</div>';
        $this->type = 'div';
        return $this;
    }
    
    public function createIframe()
    {
        $this->head = '<iframe ';
        $this->head_end = '>';
        $this->bottom = '</iframe>';
        $this->type = 'iframe';
        return $this;
    }
    
    /*
     * SETTERS
     */
    public function setSrc($val)
    {
        $this->addParams(array('src'=>$val));
        return $this;
    }
    
    public function setHref($val)
    {
        $this->addParams(array('href'=>$val));
        return $this;
    }
    
    
}//htmlelement


