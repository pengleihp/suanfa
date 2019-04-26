<?php
/*
要求：用PHP实现快速排序算法
分析：
前提：一堆无序数组，实现排序(升序或降序)
定义：快速排序是对冒泡排序的一种改进
基本思路：
1、在数组中选一个基准数(通常为数组第一个)
2、将数组中小于等于基准数的数据移到基准数左边，大于基准数的数据移到基准数右边
3、对于基准数左、右两边的数组，不断重复以上两个过程，直到每个子集只有一个元素，即为全部有序
*/
/**
 * 本例以实现升序说明
 */


function quickSort($arr){

        //设置退出条件
        if( count($arr) <= 1 )
        {
            return $arr;
        }

        $base=$arr[0];

        $left_arr=$right_arr = array();

        for($i= 1 ,$n = count($arr);$i < $n;$i++ )
        {
            if($arr[$i] <= $base )
            {
                $left_arr[] = $arr[$i];
            }
            else
            {
                $right_arr[] = $arr[$i]; 
            }

        }

        $left_arr=quickSort($left_arr);
        $right_arr=quickSort($right_arr);

        $arr=array_merge($left_arr,array($base),$right_arr);
        
        return $arr;
}


        $arr=array(1,3,5,6,7,2,3,1);
        var_dump(quickSort($arr));



?>