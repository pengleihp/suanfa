<?php
/*
要求：使对象可以像数组一样进行foreach循环，要求属性必须是私有。
    (Iterator模式的PHP5实现，写一类实现Iterator接口)
分析：
基本思路：
私有属性定义为数组;
实现Iterator接口具体要实现下面几个方法：
1、rewind()
2、current()
3、next()
4、valid()
5、key()
*/

class Test implements Iterator
{
    private $item = array('dog','cat','pig');

    private $_key=0;

    public function rewind()
    {
        $this->_key=0;
    }

    public function valid()
    {
        return isset($this->item[$this->_key]);
    }

    public function key()
    {
        return $this->_key;
    }

    public function current()
    {
        return $this->item[$this->_key];
    }

    public function next()
    {
        return $this->_key++;
    }
}

    $obj = new Test();
    foreach($obj as $k=>$v)
    {
        echo  $k.'---->'. $v.'<br/>';
    }



?>