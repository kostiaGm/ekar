
<?php $this->widget('application.widgets.index.NewsWidget');?>

<?php $this->widget('application.widgets.index.PageWidget');?>
<h1><?php echo CHtml::encode($data->header); ?></h1>

<div style="border:1px solid;">
    <p>Доработки</p>
    <ul>
        <li>
            Паффиндер [v]
        </li>
        <li>
            Список новостей [v]
        </li>
        <li>
            Новость подробно [v]
        </li>
        <li>
            Новость на главной [v]
        </li>
        <li>
            Поиск
        </li>
        <li>
            Форма обратной связи [v]
        </li>
        <li>
            Выбор языка
        </li>
        <li>
            Карта сайта
        </li>
    </ul>
</div>

<table border="1">
<?php echo $data->body; ?>

</table>