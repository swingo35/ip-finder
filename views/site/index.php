<?php
    use yii\helpers\Html;
    use yii\widgets\LinkPager;
    /*
    Display all the logs and Locations from my sql
     */
?>
<h1>Locations</h1>
<ul>
<?php foreach ($locations as $location){
    echo $location->loc;
    echo "<br>";
}
?>
</ul>
<h1>Logs</h1>
<ul>
<?php foreach ($logs as $log){
    echo $log->log;
    echo "<br>";
    echo "<br>";
}
?>
</ul>