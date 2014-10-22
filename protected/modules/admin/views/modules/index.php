<?php
$this->menu=array(
    array('label'=>'Установка / Удаление','url'=>array('admin')),
);
?>
<table class="table">
    <tr>
        <td>Модуль</td>
        <td>Папка</td>
    </tr>
    <?php foreach($modules as $kay=>$mod):?>
    <tr>
        <td><?php echo $kay; ?></td>
        <td><?php echo $mod['class']; ?></td>
    </tr>
    <?php endforeach;?>
</table>