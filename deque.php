<?php
/*
要求：用PHP实现一个双向对列

基本思路：
主要用到数组相关的几个函数：
array_push($arr,$item):从数组尾部压入一个数据
array_unshift($arr,$item):从数组头部插入一个数据
array_pop($arr):从数据尾部弹出一个数据
array_shift($arr):从数据头部移除一个数据
*/
/**
 * 本例以实现升序说明
 */

class Test
{
    private $queue = array();

    public function addFirst($item)
    {
        array_unshift($this->queue,$item);
    }

    public function addLast($item)
    {
        array_push($this->queue,$item);
    }

    public function removeFirst()
    {
        array_shift($this->queue);
    }

    public function removeLast()
    {
        array_pop($this->queue);
    }

    public function getList()
    {
        return $this->queue;
    }
    
}

        $t = new Test(); 
        $t->addFirst('a');    
        $t->addFirst('b');
        $t->addFirst('c');
        var_dump($t->getList());
        
?>