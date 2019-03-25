<?php
/*
 * USE
 *
   $table = new TableObj($id=null);
   $table->createRow()->addCol($txt)->addCol($txt);
   $table->createRow()->addCol($txt)->addCol($txt);
  
   $r = $table->createRow();
   $r->addCol($txt)->addCol($txt);
   $r->addRow($r);
 * 
 * $table->toHtml();
  
 *  TABLE
   setTableId($id)
   setTableClass()
   setCellPadding()
   setCellSpacing()
   createRow($insert = true)
   addRow($rows)
   addRows($rows, $tr_params=null)
   toHtml()
   
   insertForm($formObj, $hiddensList=null)
   addHiddens($hidden_array)
   addBasicFormList($elements_list, $labels_list=null)
 
 *  TABLE ROWS
    setId($id)
    setClass()
    addCol($text='')
    addRowParams($a = array())
    setRowClass($txt)
    
    TABLE COLS
    addColParams($a = array())
    setClass($txt)
    setColspan($txt)
    setRowspan($txt)
    setAlign($txt)
 */

class StdTable
{
    private $head = '';
    private $head_p = '';
    private $head_end = '';
    private $bottom = '';
    private $out = '';
    private $rowList = array();
    
    private $debug;
    
    //form
    public $formObj = null;
    private $formHiddens = '';
    public $msg = '';
    
    public static $ret = "\n";
    
    public function __construct($id=null, $debug=false)
    {
        $this->create($id);
        $this->debug = $debug;
    }
    
    public function __toString()
    {
        return $this->toHtml();
    }
    
    /*******
     * TABLE
     */
    private function create($id=null)
    {
        $this->head = "<table ";
        $this->head_p = '';
        $this->head_end = "><tbody>";
        $this->out = '';
        
        if(null != $id) $this->setId($id);
        $this->bottom = "</tbody></table>";
    }
    
    public function getHead()
    {
        return $this->head . $this->head_p . $this->head_end;
    }
    
    public function setTableParams($p = array())
    {
        foreach($p as $name => $val)
            $this->head_p .= $name . '="'.$val.'" ';
        return $this;
    }
    
    public function setTableId($id)
    {
        $this->setTableParams(array('id'=>$id));
        return $this;
    }
    
    public function setTableClass($c)
    {
        $this->setTableParams(array('class'=>$c));
        return $this;
    }
    
    public function setCellPadding($txt)
    {
        $this->setTableParams(array('cellpadding'=>$txt));
        return $this;
    }
    
    public function setCellSpacing($txt)
    {
        $this->setTableParams(array('cellspacing'=>$txt));
        return $this;
    }
    
    public function createRow($insert = true)
    {
        $rowObj = new StdTableRow();
        if($insert)
            $this->addRow($rowObj);
        return $rowObj;
    }
    
    public function addRow($rowObj)
    {
        if(method_exists($rowObj, 'verifMethodRow') )
            $this->rowList[] = $rowObj;
        //else 
            //$this->msg  = 'ERR addRow: not rowObj<br/>';
    }
    
    //rows: array
    /*public function addRows($rows, $tr_params=null)
    {
        foreach($rows as $n => $row)
            $this->addRow($row, $tr_params[$n]);
    }*/
    
    //retourne tout en html sans modif
    //ex : pour creer juste un élément
    public function toSimpleHtml()
    {
        return $this->out;
    }
    
    public function printOut()
    {
        print $this->toHtml();
    }
    
    public function toHtml()
    {
        $this->out = $this->getHead();
                
        //CREER ET AJOUTE LES ROWS
        foreach($this->rowList as $n => $rowObj)
        {
            $this->out .= $rowObj->out().self::$ret;
        }
        
        $this->out .= $this->bottom;
        $out = $this->out;
        
        //ajoute la form AUTOUR de la table
        if(null !== $this->formObj)
        {
            $out = $this->formObj->getHead();
            //$this->addHiddens( $this->formObj->getHiddenList() );
            $out .= $this->formHiddens;
            $out .= $this->out; //table entière
            $out .= $this->formObj->getBottom();
        }
        
        return $out;
    }
    
    
    
    
    
    
    
    
    /***************
     * FORM
     */
    public function insertForm($formObj, $hiddensList=null)
    {
        $this->formObj = $formObj;
        if(null !== $hiddensList)
            $this->addHiddens($hiddensList);
    }
    
    public function addHiddens($hidden_array)
    {
        if(!is_array($hidden_array)) 
            $hidden_array = array($hidden_array);
        
        foreach($hidden_array as $n => $hidden)
            $this->formHiddens .= $hidden . self::$ret;
    }
    
    /*
     * elements_list must be: (label, name)
     */
    public function addBasicFormList($elements_list, $labels_list=array())
    {
        foreach($elements_list as $name => $element)
        {
            if(array_key_exists('l_'.$name, $labels_list))
                $this->createRow()
                    ->addCol($labels_list['l_'.$name])
                    ->addCol($element);
            
            elseif(array_key_exists($name, $labels_list))
                $this->createRow()
                    ->addCol($labels_list[$name])
                    ->addCol($element);
            else
                $this->createRow()
                    ->addCol($name)
                    ->addCol($element);
        }
    }
    
}//table



/*
 * ROW
 */
class StdTableRow
{
    public $head = '<tr ';
    public $inside = '';
    public $bottom = '</tr>';
    
    public $colList = array();
    private $currentColIndex = 0;
    
    public function __construct()
    {
        
    }
    
    function verifMethodRow() {} //pour method_exists()
    
    public function addCol($text='')
    {
        $this->currentColIndex++;
        
        $colObj = new StdTableCol();
        $colObj->insideValue($text);
        $this->colList[$this->currentColIndex] = $colObj;
        return $this;
    }
    
    //add multiple cols: array of colsElement
    public function addCols($array)
    {
        $lastCol = null;
        foreach($array as $n => $colTxt)
        {
            $lastCol = $this->addCol($colTxt);
        }
        return $lastCol;
    }
    
    /*
     * ROW
     */
    public function addRowParams($a = array())
    {
        foreach($a as $name => $value)
            $this->head .= $name.'="'.$value.'" ';
        
        return $this;
    }
    
    public function setRowClass($txt)
    {
        return $this->addRowParams(array('class'=>$txt));
    }
    
    public function setRowId($txt)
    {
        return $this->addRowParams(array('id'=>$txt));
    }
    
    
    
    
    /*
     * COL PARAMS
     */
    public function addColParams($a = array())
    {
        foreach($a as $name => $value)
            $this->colList[$this->currentColIndex]->addColParams($a);
        
        return $this;
    }
    
    public function setColspan($txt)
    {
        return $this->addColParams(array('colspan'=>$txt));
    }
    
    public function setRowspan($txt)
    {
        return $this->addColParams(array('rowspan'=>$txt));
    }
    
    public function setAlign($txt)
    {
        return $this->addColParams(array('align'=>$txt));
    }
    
    public function setClass($txt)
    {
        return $this->addColParams(array('class'=>$txt));
    }
    
    public function setId($txt)
    {
        return $this->addColParams(array('id'=>$txt));
    }
    
    public function out()
    {
        $ret = $this->head.' >';
        
        foreach($this->colList as $n => $colObj)
        {
            $ret .= $colObj->out().TableObj::$ret;
        }
                
        $ret .= $this->bottom;
        return $ret;
    }
}//tablerow



/*
 * COLUMN CLASS
 */
class StdTableCol
{
    public $head = '<td ';
    public $inside = '';
    public $bottom = '</td>';
    
    public function __construct()
    {
        
    }
    
    public function addColParams($a = array())
    {
        foreach($a as $name => $value)
            $this->head .= $name.'="'.$value.'" ';
        
        return $this;
    }
    
    public function insideValue($txt)
    {
        $this->inside = $txt;
    }
    
    public function out()
    {
        return $this->head.' >' . $this->inside . $this->bottom;
    }
}//tablecol