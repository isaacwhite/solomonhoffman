<?php
/**
 * Implements hook_form_system_theme_settings_alter().
 *
 * @param $form
 *   Nested array of form elements that comprise the form.
 * @param $form_state
 *   A keyed array containing the current state of the form.
 */
function hoffman_form_system_theme_settings_alter(&$form, &$form_state, $form_id = NULL)  {
  // Work-around for a core bug affecting admin themes. See issue #943212.
  if (isset($form_id)) {
    return;
  }
  /* BACKGROUND IMAGE AS PER https://drupal.org/node/177868 */
  $form['homepage']['settings']['bg_image'] = array(
    '#type' => 'fieldset',
    '#title' => t('Homepage'),
    '#description' => t("Settings for adjusting the appearance of the homepage")
  );
  $bg_path = theme_get_setting('background_path');
  // If $bg_path is a public:// URI, display the path relative to the files
  // directory; stream wrappers are not end-user friendly.
  if (file_uri_scheme($bg_path) == 'public') {
    $bg_path = file_uri_target($bg_path);
  }
  $form['homepage']['settings']['bg_image']['background_path'] = array(
    '#type' => 'textfield',
    '#title' => t('Path to background image'),
    '#default_value' =>  $bg_path,
  );
  $form['homepage']['settings']['bg_image']['bg_upload'] = array(
    '#type' => 'file',
    '#title' => t('Upload a new background image'),
  );
  //Zen notes below
  // We are editing the $form in place, so we don't need to return anything.
  $form['#submit'][]   = 'hoffman_settings_submit';
  /* -- Delete this line if you want to use this setting
  $form['STARTERKIT_example'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('STARTERKIT sample setting'),
    '#default_value' => theme_get_setting('STARTERKIT_example'),
    '#description'   => t("This option doesn't do anything; it's just an example."),
  );
  // */
  // Remove some of the base theme's settings.
  unset($form['themedev']['zen_wireframes']); // We don't need to toggle wireframes on this site.

  // We are editing the $form in place, so we don't need to return anything.
}

function hoffman_settings_submit($form, &$form_state) {
  $settings = array();
  // Check for a new uploaded file, and use that if available.
  if ($file = file_save_upload('bg_upload')) {
    $parts = pathinfo($file->filename);
    $destination = 'public://' . $parts['basename'];
    $file->status = FILE_STATUS_PERMANENT;
     if (file_copy($file, $destination, FILE_EXISTS_REPLACE)) {
        $_POST['background_path'] = $form_state['values']['background_path'] = $destination;
     }
  }
}