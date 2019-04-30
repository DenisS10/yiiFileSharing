<?php
/** @var $fileArr */
?>
<html>
<head>

</head>
<body>

<ul style="list-style-type: none;">
    <?php
    foreach ($fileArr as $file) {

    ?>
    <li>
        <?if($file->extension == 'jpg' || $file->extension == 'png' || $file->extension == 'gif' || $file->extension == 'PNG' || $file->extension == 'JPG' || $file->extension == 'GIF'){?>
    <a style="color: #ff3768;" href="/file/download/<?=$file->file_key?>">Download image<img src="<?=$file->file_link?>"></a>
    <?}
    else {?>
        <a href="/file/download?key=<?=$file->file_key?>">Download file</a>
        </li>
    <?}
    }?>
</ul>
</body>
</html>
<?/*Yii.local/controller/action?parameters=value*/?>