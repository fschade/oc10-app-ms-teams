<?php

namespace OCA\MSTeams\Controller;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\IConfig;
use OCP\IRequest;
use OCP\IURLGenerator;
use OC_App;
use ZipStream;
use OCP\AppFramework\Controller;

class FactoryController extends Controller {
	/**
	 * @var IURLGenerator
	 */
	private $generator;

	/** @var IConfig */
	private $config;

	public function __construct(string $appName,
															IURLGenerator $generator,
															IRequest $request,
															IConfig $config
	) {
		parent::__construct($appName, $request);

		$this->generator = $generator;
		$this->config = $config;
	}

	/**
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 * @PublicPage
	 * @CORS
	 */
	public function build() {
		$config = $this->config->getSystemValue('ms-teams', null);
		$manifest = (new TemplateResponse(
			$this->appName,
			'factory/manifest.json',
			array(
				'version' => $config['version'],
				'id' => $config['id'],
				'packageName' => $config['packageName'],
				'name.short' => $config['name']['short'],
				'name.full' => $config['name']['full'],
				'description.short' => $config['description']['short'],
				'description.full' => $config['description']['full'],
				'accentColor' => $config['accentColor'],
				'contentUrl' => $this->generator->linkToRouteAbsolute($this->appName . '.authentication.index'),
				'validDomain' => $this->request->getServerHost(),
			),
			'blank'
		))->render();

		$options = new ZipStream\Option\Archive();
		$options->setSendHttpHeaders(true);

		$zip = new ZipStream\ZipStream('oc-teams-app.zip', $options);
		$zip->addFileFromPath('color.png', OC_App::getAppPath($this->appName) . '/img/color.png');
		$zip->addFileFromPath('outline.png', OC_App::getAppPath($this->appName) . '/img/outline.png');
		$zip->addFile('manifest.json', $manifest);

		$zip->finish();
	}
}
