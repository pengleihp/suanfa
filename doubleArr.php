<?php
/*
要求：实现二维数组的排序算法,能够具有通用性,可以调用PHP内置函数
分析：
*/

/**
 * 方案一：
 * 主要用到如下函数
 * array_column ( array $input , mixed $column_key [, mixed $index_key = null ] ) : array
 * array_column() 返回input数组中键值为column_key的列， 如果指定了可选参数index_key，
 * 那么input数组中的这一列的值将作为返回数组中对应值的键。
 * 
 * array_multisort ( array &$array1 [, mixed $array1_sort_order = SORT_ASC 
 * [, mixed $array1_sort_flags = SORT_REGULAR [, mixed $... ]]] ) : bool
 * array_multisort() 可以用来一次对多个数组进行排序，或者根据某一维或多维对多维数组进行排序。
 * 主要是根据一维数组然后对多维数组进行排序
 * 
 */


function dobuleSort1($arr,$key,$sort=SORT_DESC)
{
    $column=array_column($arr,$key);
    
    array_multisort($column,$sort == SORT_ASC?SORT_ASC:SORT_DESC,$arr);

    return $arr;
}

// $arr1 = array(
//         array('id'=>1,'name'=>'zhangsan','height'=>180),
//         array('id'=>2,'name'=>'lisi','height'=>170),
//         array('id'=>3,'name'=>'wangwu','height'=>175),
//         array('id'=>4,'name'=>'zhaoliu','height'=>168),
// );

// var_dump(dobuleSort1($arr1,'height',SORT_DESC));



/**
 * 方案二：
 * 主要用到如下函数
 *  usort( array &$array , callable $value_compare_func ) : bool
 * 本函数将用用户自定义的比较函数对一个数组中的值进行排序。 如果要排序
 * 的数组需要用一种不寻常的标准进行排序，那么应该使用此函数。
 * 
 * 注意：用匿名函数时，可以使用use，然后加入其它参数，
 * 例如可以进行多个字段排序，也可以设置升降序
 * 本例是对单个字段进行排序
 * 
 */



function dobuleSort2($arr,$orders)
{
    usort($arr,function($a,$b) use ($orders) {

        list($field,$sort)=$orders;

        if($a[$field] == $b[$field] ){

            return 0;
        }

        $left = ($sort == SORT_ASC )?-1:1;
        $right = ($sort == SORT_ASC )?1:-1;

        return $a[$field] < $b[$field] ? $left : $right;       
    });

    return $arr;
}

$arr2 = array(
        array('id'=>1,'name'=>'zhangsan','height'=>180),
        array('id'=>2,'name'=>'lisi','height'=>170),
        array('id'=>3,'name'=>'wangwu','height'=>175),
        array('id'=>4,'name'=>'zhaoliu','height'=>168),
);

//  var_dump(dobuleSort2($arr2,array('height',SORT_ASC)));
// var_dump(dobuleSort2($arr2,array('id',SORT_DESC)));


/**
 * 方案三：
 * 手动使用排序函数
 * asort($arr):对数组的值进行升序排序，保留索引关联
 * arsort($arr):对数组的值进行降序排序，保留索引关联
 */

function dobuleSort3($arr,$key,$sort=SORT_ASC)
{
    $columns=array_column($arr,$key);
    
    $sort==SORT_ASC?asort($columns):arsort($columns);

    $res = [];

    foreach($columns as $k => $v )
    {
        $res[$k]=$arr[$k];
    }

    return $res;

}


$arr3 = array(
    array('id'=>1,'name'=>'zhangsan','height'=>180),
    array('id'=>2,'name'=>'lisi','height'=>170),
    array('id'=>3,'name'=>'wangwu','height'=>175),
    array('id'=>4,'name'=>'zhaoliu','height'=>168),
);

 //var_dump(dobuleSort3($arr3,'height',SORT_DESC));
 //var_dump(dobuleSort3($arr3,'id',SORT_ASC));
?>