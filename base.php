<?php

$engine = new Mustache_Engine([
  'loader' => new Mustache_Loader_FilesystemLoader(__DIR__.'/layouts', [
    'extension' => '.html',
  ]),
]);

$template = $engine->loadTemplate('govuk_template');
if ( is_multisite() ) {
	$home_url = network_site_url();
	$site_name = esc_html( get_site_option( 'site_name' ) );
} else {
	$home_url = home_url();
	$site_name = esc_html( get_bloginfo( 'name' ) );
}


echo $template->render([
  'pageTitle' => html_entity_decode(wp_title('-', false, 'right'), ENT_HTML5 | ENT_QUOTES), // Apparently it doesn't unescape quotes by default for some reason
  'govukFrontendAssetPath' => get_template_directory_uri().'/build/node_modules/govuk-frontend/govuk/assets/',
  'head' => \Missing\Strings::getOutput('wp_head'),
  'bodyClasses' => implode(' ', array_map('esc_attr', get_body_class())),
  // 'afterHeader' => \Missing\Strings::getOutput(function () {
  //     get_template_part('templates/banner');
  // }),
  'skipLinkMessage' => 'Skip to main content',
  'homepageUrl' => $home_url,
  'bloginfoName' => $site_name,
  'logoLinkTitle' => 'Go to the homepage',
  'content' => \Missing\Strings::getOutput(function () {
      get_template_part('templates/base');
  }),
  'footerSupportLinks' => \Missing\Strings::getOutput(function () {
      get_template_part('templates/footer');
  }),
  'licenceMessage' => \Missing\Strings::getOutput(function () {
      get_template_part('templates/licence');
  }),
  'crownCopyrightMessage' => '© Crown copyright',
  'bodyEnd' => \Missing\Strings::getOutput('wp_footer'),
]);
