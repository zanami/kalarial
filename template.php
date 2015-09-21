<?php 
/** 
 * @file 
 * Primary pre/preprocess functions and alterations.
 */ 

/**
 * Copy of theme_file_link() for linking to the file download URL.
 *
 * @see theme_file_link()
 */

function kalarial_file_entity_download_link($variables) {
  $file = $variables['file'];
  $icon_directory = $variables['icon_directory'];

  $uri = file_entity_download_uri($file);
	$icon = '<i class="fa fa-download"></i>';

  // Set options as per anchor format described at
  // http://microformats.org/wiki/file-format-examples
  $uri['options']['attributes']['type'] = $file->filemime . '; length=' . $file->filesize;

  $uri['options']['attributes']['class'] = array("btn","btn-primary");
	
	$uri['options']['html'] = TRUE;

  // Provide the default link text.
  if (!isset($variables['text'])) {
    $variables['text'] = t('Download [file:name]');
  }

  // Perform unsanitized token replacement if $uri['options']['html'] is empty
  // since then l() will escape the link text.
  $variables['text'] = token_replace($variables['text'], array('file' => $file), array('clear' => TRUE, 'sanitize' => !empty($uri
['options']['html'])));

  $output = '<span class="file">' . l($icon.' '.$variables['text'], $uri['path'], $uri['options']);
  $output .= '</span>';

  return $output;
}