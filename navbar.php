<div class="navbar navbar navbar-static-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="#"><?php echo COMPANY_NAME; ?></a>
      <ul class="nav pull-right">
          <?php 
            if ($user) {
              $loginBtn = $facebook->getLogoutUrl();
              $loginText = 'Log out';
            } else {
              $loginBtn = $facebook->getLoginUrl();
              $loginText = 'Log in';
            }

            echo '<li><a href="'.$loginBtn.'">'.$loginText.'</a></li>';
          ?>    
      </ul>
     </div>
  </div>
</div>

