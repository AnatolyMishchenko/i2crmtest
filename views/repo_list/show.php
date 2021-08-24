<?php

/* @var $this yii\web\View */

?>

<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <th>Логин</th><th>Удалить</th>
    </thead>
    <tbody>
        <?php foreach($userList as $itemList) { ?>
            <tr>
                <td><?php echo $itemList['login']; ?></td>
                <td><a href="/repo-list/delete/<?php echo $itemList['id']?>">Удалить</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
