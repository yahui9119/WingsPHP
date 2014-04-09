<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>分词测试</title>
</head>
<body>
<table width='90%' align='center'>
    <tr>
        <td>

            <hr size='1'/>

            <form id="form1" name="form1" method="post" action="?ac=done"
                  style="margin:0px;padding:0px;line-height:24px;">
                <b>源文本：</b>&nbsp; <a href="dict_build_new.php" target="_blank">[更新词典]</a> <br/>
                <textarea name="source"
                          style="width:98%;height:150px;font-size:14px;"><?php echo(isset($_POST['source']) ? $_POST['source'] : $teststr); ?></textarea>
                <br/>
                <input type='checkbox' name='do_fork' value='1' <?php echo($do_fork ? "checked='1'" : ''); ?>/>岐义处理
                <input type='checkbox' name='do_unit' value='1' <?php echo($do_unit ? "checked='1'" : ''); ?>/>新词识别
                <input type='checkbox' name='do_multi' value='1' <?php echo($do_multi ? "checked='1'" : ''); ?>/>多元切分
                <input type='checkbox' name='do_prop' value='1' <?php echo($do_prop ? "checked='1'" : ''); ?>/>词性标注
                <input type='checkbox' name='pri_dict' value='1' <?php echo($pri_dict ? "checked='1'" : ''); ?>/>预载全部词条
                <br/>
                <input type="submit" name="Submit" value="提交进行分词"/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="reset" name="Submit2" value="重设表单数据"/>
            </form>
            <br/>
            <textarea name="result" id="result"
                      style="width:98%;height:120px;font-size:14px;color:#555"><?php echo(isset($okresult) ? $okresult : ''); ?></textarea>
            <br/><br/>
            <b>调试信息：</b>
            <hr/>
            <font color='blue'>字串长度：</font><?php echo $slen; ?>K <font
                color='blue'>自动识别词：</font><?php echo (isset($pa_foundWordStr)) ? $pa_foundWordStr : ''; ?><br/>
            <hr/>
            <font color='blue'>内存占用及执行时间：</font>(表示完成某个动作后正在占用的内存)
            <hr/>
            <?php echo $memory_info; ?>
            总用时：<?php echo $endtime; ?> 秒
        </td>
    </tr>
</table>
</body>
</html>

