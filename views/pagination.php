<div class="d-flex justify-content-around">
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link" href="<?php echo $url . "pag=" . ($current >= 1 ? 1 : $current - 1); ?>&" aria-label="Anterior">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <?php for ($i = 1; $i <= $totalPages; $i++) {
            $style = "";

            if ($current == $i) {
                $style = " active";
            }
        ?>
            <li class="page-item<?php echo $style; ?>"><a class="page-link" href="readGUI.php?pag=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li class="page-item">
            <a class="page-link" href="<?php echo $url . "pag=" . ($current < $totalPages ? $current + 1 : $totalPages); ?>&" aria-label="Próximo">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</div>