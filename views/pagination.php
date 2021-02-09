<?php
if(!empty($questions) && (count($questions) > 1)) {
    echo '
    <div class="d-flex justify-content-around">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="' . $url . 'pag=' . ($current >= 1 ? 1 : $current - 1) . '&" aria-label="Anterior">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>';
            for ($i = 1; $i <= $totalPages; $i++) {
                $style = "";

                if ($current == $i) {
                    $style = " active";
                }
            
                echo '<li class="page-item' . $style . '"><a class="page-link" href="readGUI.php?pag=' . $i . '">' . $i . '</a></li>';
            } 
            echo '<li class="page-item">
                <a class="page-link" href="' . $url . 'pag=' . ($current < $totalPages ? $current + 1 : $totalPages) . '&" aria-label="Próximo">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </div>
    ';
}
