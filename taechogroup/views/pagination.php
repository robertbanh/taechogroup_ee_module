<? if ($pagination) : ?>
    <div id='pagination'>
    <span class='curr'>Page <?php echo $pagination['curr_page']; ?> of <?= $pagination['total_pages'] ?></span><br/><br/>
        <?
            if ($pagination['total_pages'] > 1)
            {
                $range = 3;
                // build previous page
                if ($pagination['curr_page'] > 1)
                    echo "<span><a href='{$pagination['base_url']}&page=".($pagination['curr_page']-1)."'>Previous</a></span> ";
                // build range pages
                $stop = ($pagination['curr_page'] + $range) + 1;
                for ($x=($pagination['curr_page']-$range); $x<$stop; $x++) 
                {
                    // if it's a valid page number...
                    if (($x > 0) && ($x <= $pagination['total_pages'])) 
                    {
                        if ($x == $pagination['curr_page'])
                            echo "<span class='curr'>$x</span> ";
                        else
                            echo "<span><a href='{$pagination['base_url']}&page=$x'>$x</a></span> ";
                    }
                }
                // build last page
                if ($stop <= $pagination['total_pages']) 
                    echo "... <span><a href='{$pagination['base_url']}&page=".$pagination['total_pages']."'>".$pagination['total_pages']."</a></span> ";
                // build next page
                if ($pagination['curr_page'] != $pagination['total_pages'])
                    echo "<span><a href='{$pagination['base_url']}&page=".($pagination['curr_page']+1)."'>Next</a></span>";
            }
        ?>
    </div>
<? endif ?>