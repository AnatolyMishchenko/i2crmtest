<?php

/* @var $this yii\web\View */

$this->title = 'i2crmtest';
?>
<a class="btn btn-success" href="/site/index?update=1">Обновить список репозиториев</a>
<span>Чтобы не ждать 10 минут, добавил кнопку для обновления</span>
<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <th>Номер</th><th>Дата</th><th>Репозиторий</th><th>Логин</th>
    </thead>
    <tbody>
    <?php $count = 1; ?>
    <?php foreach($resultList as $repoItem) { ?>
        <?php if($count < 11) {?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo date('d-m-Y H:i:s', strtotime($repoItem->pushed_at)); ?></td>
                <td>
                    <a href="<?php echo $repoItem->html_url ?>">
                        <?php echo $repoItem->name; ?>
                    </a>
                </td>
                <td>
                    <a href="<?php echo $repoItem->owner->html_url; ?>">
                        <?php echo $repoItem->owner->login; ?>

                    </a>
                </td>
            </tr>
            <?php $count++; ?>
        <?php } else {
            break;
        }?>
    <?php } ?>
    </tbody>
</table>