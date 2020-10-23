<?php
session_start();
if (isset($_SESSION['message'])) {
  echo '
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false" style="position: absolute; top: 80px; right: 0">
      <div class="toast-header">
        <!-- <img src="..." class="rounded mr-2" alt="..."> -->
        <strong class="mr-auto">Autella</strong>
        <!-- <small>11 mins ago</small> -->
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="toast-body">';

  echo $_SESSION['message'];

  echo '
      </div>
    </div>
';
}

unset($_SESSION['message']);
