<html>
{!like.js!}
{$data},{$person}
<ul>
{loop $b} <li>{V}</li> {/loop}
</ul>

<?php
echo $pai * 2;
?>

{if $data == 'abc'}
我是abc
{elseif $data == 'def'}
我是def
{else}
我是,{$data}
{/if}

{#注释代码,PHP会忽略掉#}
123456-----------
</html>
