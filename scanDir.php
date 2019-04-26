<?php
/*
要求：遍历文件夹，读取文件夹里的文件
分析：
基本思路：
1、读取文件夹，判断里面的内容是不是文件
2、如果是文件直接得到文件的值
3、如果不是文件，仍为文件夹，则递归调用遍历文件夹的方法；
*/

function scan_Dir($dir)
{
    $files = [];
    if(is_dir($dir))
    {
        if($handle = opendir($dir))
        {
           while(($file = readdir($handle)) !== false)
           {
                if($file != '.' && $file != '..')
                {
                    if(is_dir($dir . '/'.$file))
                    {
                        $files[$file] = scan_Dir($dir . '/'.$file);
                    }
                    else
                    {
                        $files[]=$dir . '/'.$file;
                    }
                }
           }
           
           closedir($handle);
        }
    }

    return $files;
}

    $dir='D:/phpdemo';
    var_dump(scan_Dir($dir));

?>