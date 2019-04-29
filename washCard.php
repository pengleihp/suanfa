<?php
/*
要求：用PHP实现洗牌算法
分析：
1.生成一副牌1-54
2.最后随机打乱这副牌
*/

/**
 * 方案一：
 * 没有说不能用内置函数，可以用内置函数实现
 * range($start,$end,$step):
 * shuffle($arr)
 * 
 */


function washCard1($num)
{
    //1.随机生成一副牌
    $arr = range(1,$num);

    //2.打乱这副牌
    shuffle($arr);

    return $arr;
}

//var_dump(washCard1(54));


/**
 * 方案二：不用内置方法
 * 1.用循环生成一副牌
 * 2.用循环随机打乱这副牌
 * 
 */

function washCard2($num)
{
    $arr=[];

    for($i=1;$i<=$num;$i++)
    {
        $arr[]=$i;
    }

    //随机打乱牌
    $res=[];
    
    for($m = 0;$m<$num ;$m++ )
    {
        $len=count($arr);

        //随机选一个
        $index=rand(0,$len-1);

        $card = $arr[$index];
        $res[] = $card;

        //把该牌从旧牌中移除
        unset($arr[$index]);

        //用unset移除的数，并未改变原有数组的索引，需要重新用array_values进行重新索引
        $arr=array_values($arr);
    }

    return $res;
} 

var_dump(washCard2(54));



?>