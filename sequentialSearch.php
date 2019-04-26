<?php
/*
要求：用PHP实现顺序查找，在数组中，查找某个元素是否存在，存在则返回下标值
分析：
前提：数组
定义：顺序查找是按照序列原有顺序对数组进行遍历比较查询的基本查找算法。
基本思路：

*/
/**
 * 本例以实现升序说明
 */


function sequentialSearch1($arr,$k){

        for($i = 0,$n = count($arr);$i < $n;$i++ )
        {
            if($k == $arr[$i])
            {
                return $i;
            }
        }
        return -1;
}

//上述方法中，每次循环都需要对i是否小于n做判断，可以进行如下改进

function sequentialSearch2($arr,$k){

    $i = count($arr);
    
    while($i>=1 && $arr[$i-1] != $k )
    {
        $i--;
    }

    //返回-1表示没有找到
    return $i-1;
}

$arr=array(1,4,5,2);
var_dump(sequentialSearch2($arr,2));



?>