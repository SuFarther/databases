<?php
    /**
     * file_put_contents, 第一个参数为文件夹,第二个参数是文件的内容
     * 假设这个文件存在,则写入的内容则覆盖原先的内容
     * 假设这个文件不存在,则写入的内容则重新创建这个文件,并插入这个文件的内容
     */
   file_put_contents('a.txt','这是我的地方');

   file_put_contents('test.txt','这是测试的文档,你要来看看吗？');