<!Doctype html>
<html>
    <head>
        <title>Test</title>
        <style type="text/css">
            input[type=text] {
                width: 45px !important;
            }
        </style>
    </head>
    <body>
        <form name="table" action="table/save" method="post">
            <table>
                <tr>
                <?php
                    $i = 0;
                    foreach($items as $k=>$v){
                ?>
                    <td>
                        <input size="5" maxlength="5" width="20px;" type="text" name="<?=$v['id']?>" value="<?=!empty($v['number']) ? $v['number'] : ''?>">
                    </td>
                <?php
                        if($i == 100){
                            echo "</tr>";
                            $i = 0;
                        }

                        $i++;
                    }

                    if(count($items) < 10000){
                        ?>
                        <tr>
                        <?php
                        $cnt = count($items);
                        $count = 10000 - $cnt;
                        $iteration = 0;
                        for($i=1;$i<=$count;$i++){

                            if($iteration == 100){
                                echo "</tr>";
                                $iteration = 0;
                            }

                            ?>
                                <td>
                                    <input type="text" name="<?=$cnt+$i?>" value="" size="5" maxlength="5" width="20px;">
                                </td>
                            <?php


                            $iteration++;
                        }
                    }
                ?>
                <tr>
                    <td>
                        <input type="submit" value="Save">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>