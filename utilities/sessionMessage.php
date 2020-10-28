<?php
session_start();

if (isset($_SESSION['message'])) {
  echo '<div class="modal modal-dialog-centered" id="messageModal" tabindex="-1" aria-labelledby="messageModal" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">' . $_SESSION['message'] . '</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
      </div>
  </div>
</div>';
}

unset($_SESSION['message']);
