<?php 

 /**
  * 顺序查找
  * 时间复杂度：O(n)
  */

  //直接查找
  function sequen_search1( $arr , $k ){
        $n=count($arr);
        if( $n == 0 ){
            return -1;
        }

        for($i = 0 ; $i < $n ;$i++ ){

            if($arr[$i] == $k ){
                return $i;
            } 
        }
       

        return -1;
  }

  //由于每次都要与$n进行比较，可以设置一个关哨，所以可以进行如下改进
  function sequen_search2( $arr, $k ){
        $n=count($arr);
        if( $n == 0 ){
            return -1;
        }

        if($arr[0] == $k ){
            return 0;
        }

        $arr[0]=$k;
        $i=$n-1;

        while( $arr[$i] != $k ) {
            $i--;
        }
       

        return $i==0?-1:$i;//如果$i为-1则表示没有找到

  }

  /**
   * 折半查找(二分查找)
   * 时间复杂度：O(logn)
   * 查找到当前元素的下标
   * $mid=(low+high)/2
   */

   function binary_search($arr,$key) {

       $low=0;
       $high=count($arr)-1;

       while($low<=$high){
           $mid=floor(($low+$high)/2);

           if($key < $arr[$mid]) {
               $high=$mid-1;
           }
           else if($key > $arr[$mid]) {
               $low=$mid+1;
           }
           else {
               return intval($mid);
           }
       }

       return -1;
   }

   /**
    * 插值查找(其实是按比例查找)
    *二分查找的mid=(low+high)/2=low/2+high/2=low+high/2-low/2=low+(high-low)/2
    *引出：我们在翻字典查找"apple"这个单词时，我们知道a在前面，所以会直接在前面小部分找
    *      当我们查找"zoon"这个单词时，我们知道z开头的在后面小部分，会直接在后面小部分查找
    *      而我们每次从中间翻起，就显得很傻，由此可以想到，把二分查找的公式中的1/2动态调整比例
    * mid=low+1/2*(high-low)
    *    =low+(($key-a[low])/(a[high]-a[low]))*(high-low)
    *
    *时间复杂度：O(logn) 
    *插值查找，在数据分布均匀时，效率会高于二分查找
    */

    function insert_search($arr,$key){
        $low = 0;
        $high = count($arr) -1;

        while( $low <= $high ){
            $mid=$low+(($key-$arr[$low])/($arr[$high]-$arr[$low]))* ($high-$low);
            $mid=floor($mid);

            if($key< $arr[$mid]){
                $high=$mid-1;
            }
            else if($key > $arr[$mid]){
                $low=$mid+1;
            }
            else {
                return intval($mid);
            }
        }

        return -1;
         
    }

    /**
     * 斐波那契查找
     * 原理：利用斐波那契数列F：f(n)=f(n-2)+f(n-1),用数字来表示多少项
     * 注意：当数组的长度跟斐波那契数列F中的某个最接近的数字对不上时，需要填充到项一样
     * 以数组有10项为例arr=[1,3,6,8,9,11,12,13,16,17]
     * F={1,1,2,3,5,8,13,21,44……}
     * 观察斐波那契数列F中的13表示有13项与10最接近，数组只需填充到13个项，即把最大的数17再填充3个
     * 注意为什么不能使用8呢，因为数组有10项，只能比10多
     * arr=[1,3,6,8,9,11,12,13,16,17,17,17,17] (13项)
     * 
     * 按照斐波那契数列F，13=5项(后半部分)+8项(前半部分)
     * arr=[1,3,6,8,9,11,12,13｜16,17,17,17,17]
     * mid=low+8-1(数组下标为0，所以需要-1)
     * 同理如果继续在左半边
     * N=F[k-1]
     *    按照斐波那契数列F，8=3项(后半部分)+5项(前半部分)
     *    arr=[1,3,6,8,9,|| 11,12,13｜16,17,17,17,17]
     *    mid=low+3-1
     * 如果在右半边
     * 则low=mid+1
     * N=F[k-2]
     *
     * 时间复杂度为：logn
     * 虽然斐波那契查找的时间复杂度跟二分查找一样是logn，
     * 但是就平均性能来说要优于二分查找
     * 可惜如果是最坏情况，比如这里，key=1,
     * 那么始终都处于左半侧长半区查找，则效率要低于折半查找
     */


     function fibonaci_search($arr,$key){
        
        $n = count($arr); 

        //1.生成斐波那契数列
        $F=array();
        $F[0]=1;
        $F[1]=1; 
        $k=1;
        while ( $F[$k] < $n ) {        
            array_push($F,$F[$k]+$F[$k-1]);             
            $k++;             
        }

        //2.把数组的项填充为斐波那契数列中的数据

        $num=$F[$k];
        for($m=$n;$m<$num;$m++){
            $arr[$m]=$arr[$n-1];//把数组的后几位填充为数组的最大数
        }

        //3.进行查找
        $low=0;
        $high=$num-1;//12

        while($low<$high){
            $mid=$low+$F[$k-1]-1;//数组的下标是从0开始的，所以需要-1

            if($key < $arr[$mid]) {
                $high=$mid;
                $k--;
            }else if($key >$arr[$mid]) {
                $low=$mid+1;
                $k-=2;
            }else {
                if ($mid < $n) {
                    return $mid;
                }
                else {
                    return $n-1;//超过原本的长度
                }
            }    

        }

        //还在判断low=high时，判断是不是最后一个或者是首位，如果是则返回，否则没找着
        if( $key == $arr[$high ]){
            return $high;
        }

        return -1;//没找着

     }

     /**
      * 总结：
      * 二分查找、插值查找、斐波那契查找的前提都是有序的基础上。
      * 二分查找mid=(low+high)/2
      * 插值查找mid=low+((key-a[low])/(a[high]-a[low]))*(high-low)
      * 斐波那契查找mid=low+F[k-1]-1
      * 可见：二分查找是用加法与除法
      *      插值查找是用四则运算
      *      斐波那契查找是简单加减法
      * 在海量数据的查找过程中，这种细微的差别也可能会影响最终的查找效率
      */



 //测试
$arr=[1,3,6,8,9,11,12,13,16,17];
$find=fibonaci_search($arr,19);
var_dump($find);

?>