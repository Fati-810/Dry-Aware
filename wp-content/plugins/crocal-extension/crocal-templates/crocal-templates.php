<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Class Crocal_Vc_Templates
 */
class Crocal_Vc_Templates {
	/**
	 * @var bool
	 */
	protected $initialized = false;

	/**
	 *
	 */
	public function init() {
		if ( $this->initialized ) {
			return;
		}
		$this->initialized = true;

		add_filter( 'vc_templates_render_category', array(
			$this,
			'renderTemplateBlock',
		), 10 );

		add_filter( 'vc_get_all_templates', array(
			$this,
			'addTemplatesTab',
		) );
		add_filter( 'vc_templates_render_frontend_template', array(
			$this,
			'renderFrontendTemplate',
		), 10, 2 );
		add_filter( 'vc_templates_render_backend_template', array(
			$this,
			'renderBackendTemplate',
		), 10, 2 );
		add_filter( 'vc_templates_render_backend_template_preview', array(
			$this,
			'renderBackendTemplate',
		), 10, 2 );

	}

	/**
	 * @param $data
	 *
	 * @return array
	 */
	public function addTemplatesTab( $data ) {
		$newCategory = array(
			'category' => 'crocal_templates',
			'category_name' => esc_html__( 'Content Manager', 'crocal-extension' ),
			'category_weight' => 9,
			'templates' => $this->getTemplates(),
		);
		$data[] = $newCategory;

		return $data;
	}

	/**
	 * @param $category
	 *
	 * @return mixed
	 */
	public function renderTemplateBlock( $category ) {
		if ( 'crocal_templates' === $category['category'] ) {
			$category['output'] = $this->getTemplateBlockTemplate();
		}
		return $category;
	}

	/**
	 * @return string
	 */
	private function getTemplateBlockTemplate() {
		ob_start();
		$this->crocal_vc_include_template( 'crocal-templates/category.tpl.php', array(
			'controller' => $this,
			'templates' => $this->getTemplates(),
			'filters' => $this->getFilters(),
		) );

		return ob_get_clean();
	}

	public function crocal_vc_include_template( $template, $variables = array(), $once = false ) {
		is_array( $variables ) && extract( $variables );
		if ( $once ) {
			return require_once CROCAL_EXT_PLUGIN_DIR_PATH . $template;
		} else {
			return require CROCAL_EXT_PLUGIN_DIR_PATH . $template;
		}
	}

	public function renderBackendTemplate( $templateId, $templateType ) {
		if ( 'crocal_templates' === $templateType ) {
			$templates = $this->getTemplates();
			if ( ! is_numeric( $templateId ) || ! is_array( $templates ) || ! isset( $templates[ $templateId ] ) ) {
				wp_send_json_error( array(
					'code' => 'Wrong ID or no Template found',
				) );
			} else {
				$data =  $templates[ $templateId ];
				return trim( $data['content'] );
			}
		}
		return $templateId;
	}

	public function renderFrontendTemplate( $templateId, $templateType ) {
		if ( 'crocal_templates' === $templateType ) {
			$templates = $this->getTemplates();
			if ( ! is_numeric( $templateId ) || ! is_array( $templates ) || ! isset( $templates[ $templateId ] ) ) {
				wp_send_json_error( array(
					'code' => 'Wrong ID or no Template found',
				) );
			} else {
				$data = $templates[ $templateId ];
				vc_frontend_editor()->setTemplateContent( trim( $data['content'] ) );
				vc_frontend_editor()->enqueueRequired();
				vc_include_template( 'editors/frontend_template.tpl.php', array(
					'editor' => vc_frontend_editor(),
				) );
				die();
			}
		}

		return $templateId;
	}

	public function getFilters() {
		return array(
			'*' => esc_html__( 'All', 'crocal-extension' ),
			'homepage' => esc_html__( 'Homepage', 'crocal-extension' ),
			'page' => esc_html__( 'Page', 'crocal-extension' ),
		);
	}

	public function getTemplates() {

		$templates = array();

$data = array();
$data['unique_id'] = $data['id'] = 'sample-section-1';
$data['type'] = 'crocal_templates';
$data['name'] = esc_html__( 'Sample Section 1', 'crocal-extension' );
$data['image_path'] = preg_replace( '/\s/', '%20', CROCAL_EXT_PLUGIN_DIR_URL . 'crocal-templates/images/sample-section-01.jpg');
$data['custom_class'] = 'homepage';
$data['content'] = <<<CONTENT
Sample Text
CONTENT;
$templates[] = $data;

		return $templates;
	}
}

$crocal_vc_templates = new Crocal_Vc_Templates();
$crocal_vc_templates->init();
