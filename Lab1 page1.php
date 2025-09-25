<?php
$x = 'блок X'; 
$y = 'блок Y';  

$W = 520;
$H = 560;
$cols = 4;
$rows = 4;

//блоки у вигляді масиву, де r — стартовий ряд (1-based), c — стартовий стовпець (1-based)
//rows, cols — скільки рядків чи стовпців займає блок
$gridBlocks = [
    1 => ['r'=>1,'c'=>1,'rows'=>1,'cols'=>4,'label'=>1,'color'=>'#cfe8ff','align'=>'right'],
    2 => ['r'=>2,'c'=>1,'rows'=>3,'cols'=>1,'label'=>2,'color'=>'#e6f3e8','align'=>'right'],
    3 => ['r'=>2,'c'=>2,'rows'=>2,'cols'=>2,'label'=>3,'color'=>'#ffffff','align'=>'center'],
    4 => ['r'=>2,'c'=>4,'rows'=>1,'cols'=>1,'label'=>4,'color'=>'#e6f3e8','align'=>'left'],
    5 => ['r'=>3,'c'=>4,'rows'=>1,'cols'=>1,'label'=>5,'color'=>'#ffe8dc','align'=>'left'],
    6 => ['r'=>4,'c'=>2,'rows'=>1,'cols'=>3,'label'=>6,'color'=>'#cfe8ff','align'=>'right'],
];

//X і Y з координатами клітинки (r,c) і розміром
$tags = [
    ['label'=>$x, 'r'=>1, 'c'=>1, 'w'=>120, 'h'=>30, 'offset_x'=>10, 'offset_y'=>50],
    ['label'=>$y, 'r'=>4, 'c'=>2, 'w'=>120, 'h'=>30, 'offset_x'=>15, 'offset_y'=>0], 
];

$text1 = "<ul><li>Пункт 1</li><li>Пункт 2</li></ul>";
$text2 = "Це текст для блоку 2";
$text4 = "Це текст для блоку 4";
$text5 = "Це текст для блоку 5";
$text6 = "Це текст для блоку 6";

$pages = [
    'Lab1 page1.php' => 'Сторінка 1',
    'Lab1 page2.php' => 'Сторінка 2',
    'Lab1 page3.php' => 'Сторінка 3',
    'Lab1 page4.php' => 'Сторінка 4',
    'Lab1 page5.php' => 'Сторінка 5'
];


?>
<!doctype html>
<html lang="uk">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lab1 page1</title>

<style>
    :root{
        --W:<?=$W?>px; 
        --H:<?=$H?>px; 
        --cols:<?=$cols?>; 
        --rows:<?=$rows?> 
    }

    html,body{ 
        height:100%; 
        margin:0; 
    }

    body{ 
        display:flex; 
        align-items:flex-start; 
        justify-content:center; 
        background:#f4f5f7; 
        font-family:Arial, Helvetica, sans-serif; 
        padding:18px 
    }

    .frame{
        width:var(--W);
        height:var(--H);
        display:grid;
        grid-template-columns: repeat(4, 1fr);
        grid-template-rows: repeat(4, 1fr);
        border:1px solid #222;
        gap:0;
        position:relative;
        box-sizing:border-box;
    }

    .blk{
        border:1px solid #222;
        box-sizing:border-box;
        position:relative;
        display:flex;
        align-items:center;
        justify-content:center;
        font-weight:700;
        color:#222;
        overflow:hidden;
    }

    .num{ 
        position:absolute; 
        font-weight:600; 
        font-size: 25px;
    }


    .num.center { left:50%; top:50%; transform:translate(-50%,-50%); }
    .num.left { left:6px; top:50%; transform:translateY(-50%); }
    .num.right { right:6px; top:50%; transform:translateY(-50%); }

    .tag{
        position:absolute;
        background:#fff;
        border:2px solid #000000ff;
        box-shadow:0 1px 2px rgba(0,0,0,0.08);
        display:flex; align-items:center; 
        justify-content:flex-end; 
        padding-right:10px;      
        font-weight:600;
        font-size: 25px;
    }
</style>
</head>
<body>

<div class="frame">

    <?php foreach($gridBlocks as $id => $b):
    $colEnd = $b['c'] + $b['cols'];
    $rowEnd = $b['r'] + $b['rows'];

    if($id == 3){ //блок під меню
        $content = '<ul style="list-style:none; padding:0; margin:0; white-space: nowrap;">';
        foreach($pages as $url => $name){
            $content .= '<li><a href="'.$url.'" style="text-decoration:none;">'.$name.'</a></li>';
        }
        $content .= '</ul>';
    } else {
        $varName = 'text'.$id;
        $content = $$varName; 
    }
    ?>
    <div class="blk" style="grid-column: <?=$b['c']?> / <?=$colEnd?>; grid-row: <?=$b['r']?> / <?=$rowEnd?>; background: <?=$b['color']?>;">
        <div class="num <?=$b['align']?>"><?=$content?></div>
    </div>
    <?php endforeach; ?>


    <?php
        $cellW = $W / $cols;
        $cellH = $H / $rows;

        foreach($tags as $t){
            $left = ($t['c'] -1) * $cellW + $t['offset_x'];
            $top  = ($t['r'] -1) * $cellH + $t['offset_y'];
            echo '<div class="tag" style="left:'.$left.'px; top:'.$top.'px; width:'.$t['w'].'px; height:'.$t['h'].'px;">'.$t['label'].'</div>';
        }

    ?>

</div>
</body>
</html>
