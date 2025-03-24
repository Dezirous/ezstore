<!doctype html>
<html lang="<?php echo current_language_code(); ?>">

<head>
    <meta charset="utf-8">

    <base href="<?php echo base_url(); ?>">
    <title><?php echo $this->lang->line('common_software_short')  . '&nbsp;|&nbsp;' .  $this->lang->line('login_login'); ?></title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="noindex, nofollow" name="robots">
    <link href="images/logo.png" rel="shortcut icon" type="image/x-icon">
    <link href="<?php echo 'dist/bootswatch-5/' . (empty($this->config->item('theme')) || 'paper' == $this->config->item('theme') || 'readable' == $this->config->item('theme') ? 'flatly' : $this->config->item('theme')) . '/bootstrap.min.css'; ?>" rel="stylesheet" type="text/css">
    <!-- start css template tags -->
    <link rel="stylesheet" type="text/css" href="css/login.min.css"/>
    <!-- end css template tags -->
    <meta content="#2c3e50" name="theme-color">
	
	<style>
    	.container-login {
    	    max-width: 500px;
    	}
	    .box-login {
	        width: 100%;
	    }
	</style>
</head>

<body class="bg-light d-flex flex-column">
  <main class="d-flex justify-content-around align-items-center flex-grow-1">
    <div class="container-login container d-flex flex-column flex-md-row bg-body shadow rounded m-3 p-4 p-md-0">
      
      <section class="box-login d-flex flex-column justify-content-center align-items-center p-md-4">
				<?php echo form_open('login'); ?>
        <h3 class="text-center m-0"><?php echo $this->lang->line('login_welcome', $this->lang->line('common_software_short')); ?></h3>
        <?php if (validation_errors()): ?>
        <div class="alert alert-danger mt-3">
          <?php echo validation_errors(); ?>
        </div>
        <?php endif; ?>
				<?php if (!$this->migration->is_latest()): ?>
        <div class="alert alert-info mt-3">
					<?php echo $this->lang->line('login_migration_needed', $this->config->item('application_version')); ?>
				</div>
				<?php endif; ?>
        <?php if (empty($this->config->item('login_form')) || 'floating_labels'==($this->config->item('login_form'))): ?>
        <div class="form-floating mt-3">
          <input class="form-control" id="input-username" name="username" type="text" placeholder="<?php echo $this->lang->line('login_username'); ?>">
          <label for="input-username"><?php echo $this->lang->line('login_username'); ?></label>
        </div>
        <div class="form-floating mb-3">
          <input class="form-control" id="input-password" name="password" type="password" placeholder="<?php echo $this->lang->line('login_password'); ?>">
          <label for="input-password"><?php echo $this->lang->line('login_password'); ?></label>
        </div>
      <?php elseif ('input_groups'==($this->config->item('login_form'))): ?>
        <div class="input-group mt-3">
          <span class="input-group-text" id="input-username">
            <svg class="bi" fill="currentColor" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
              <title><?php echo $this->lang->line('common_icon') . '&nbsp;' . $this->lang->line('login_username'); ?></title>
              <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            </svg>
          </span>
          <input class="form-control" name="username" type="text" placeholder="<?php echo $this->lang->line('login_username'); ?>" aria-label="<?php echo $this->lang->line('login_username'); ?>" aria-describedby="input-username" <?php if (ENVIRONMENT == "testing") echo "value='admin'"; ?>>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text" id="input-password">
            <svg class="bi" fill="currentColor" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
              <title><?php echo $this->lang->line('common_icon') . '&nbsp;' . $this->lang->line('login_password'); ?></title>
              <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
            </svg>
          </span>
          <input class="form-control" name="password" type="password" placeholder="<?php echo $this->lang->line('login_password'); ?>" aria-label="<?php echo $this->lang->line('login_password'); ?>" <?php if (ENVIRONMENT == "testing") echo "value='pointofsale'"; ?>" aria-describedby="input-password">
        </div>
        <?php endif; ?>
				<?php if($this->config->item('gcaptcha_enable')) {
					echo '<script src="https://www.google.com/recaptcha/api.js"></script>';
					echo '<div class="g-recaptcha mb-3" align="center" data-sitekey="' . $this->config->item('gcaptcha_site_key') . '"></div>'; }
        ?>
        <div class="d-grid">
          <button class="btn btn-lg btn-primary" name="login-button" type="submit" ><?php echo $this->lang->line('login_go'); ?></button>
        </div>
				<?php echo form_close(); ?>
      </section>
    </div>
  </main>
  
</body>

</html>
