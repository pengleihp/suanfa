<?php
/*
要求：用PHP实现二分查找,在有序数组中查找某个数组是否存在，存在则返回下标值
分析：
前提：一堆有序的数组
定义：二分查找也叫折半查找，但是，折半查找要求线性表必须采用顺序存储结构，而且表中元素按关键字有序排列
基本思路： 
1、将查找的键和中间键做比较
2、小于，继续在左子数组中查找
3、大于，继续在右子数组中查找
4、直到找到，或找不到退出
*/
/**
 * 本例假设有序数组为升序排列数组
 */

 /**
  * 方案一：用while循环
  * $arr:升序数组
  * $low:查找开始位置
  * $high:查找结束位置
  * $k :要查找的元素
  */

function binarySearch1($arr,$low,$high,$k){ 

        //注意需要=,否则可能会漏掉边界值
         while ($low <= $high )
         {    
            $mid=intval(($low + $high)/2);       

            if($arr[$mid] == $k )
            {
               return $mid;
            }
            else if($arr[$mid] < $k )
            {
                $low = $mid+1 ;//注意要+1，否则可能死循环
            }
            else
            {
                $high= $mid-1 ;//注意要-1，否则可能死循环
            }

         }
                
        
        return -1;
}


// $arr=array(1,2,2,2,2,5,6);
// var_dump(binarySearch1($arr,0,6,2));

/**
* 方案二：用递归方法
* $arr:升序数组
* $low:查找开始位置
* $high:查找结束位置
* $k :要查找的元素 
 */

 function binarySearch2($arr,$low,$high,$k)
 {
   
    if($low <= $high )
    {    
        $mid = intval(($low + $high)/2 );
        
        if($k == $arr[$mid] )
        {
            return $mid;
        }
        else if($k < $arr[$mid] )
        {            
            return binarySearch2($arr,$low,$mid-1,$k);
        }
        else {

            return binarySearch2($arr,$mid+1,$high,$k);
        }
    }

    return -1;
 }

    $arr=array(1,2,5,6);
    var_dump(binarySearch2($arr,0,3,1));
?>