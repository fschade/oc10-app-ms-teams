<?php

namespace OCA\MSTeams\Controller;

use OC\User\Session;
use OCA\OpenIdConnect\Controller\LoginFlowController as OIDCLoginFlowController;
use OCA\OpenIdConnect\Service\UserLookupService;
use OCA\MSTeams\Client;
use OCP\AppFramework\Http\RedirectResponse;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\ICacheFactory;
use OCP\IConfig;
use OCP\ILogger;
use OCP\IRequest;
use OCP\ISession;
use OCP\IURLGenerator;
use OC_Util;
use OCP\IUserSession;

class AuthenticationController extends OIDCLoginFlowController {

	/**
	 * @var Session
	 */
	private $userSession;

	/**
	 * @var IURLGenerator
	 */
	private $generator;

	/** @var IConfig */
	private $config;

	public function __construct(string $appName,
															IRequest $request,
															UserLookupService $userLookup,
															IUserSession $userSession,
															ISession $session,
															ILogger $logger,
															Client $client,
															ICacheFactory $memCacheFactory,
															IURLGenerator $generator,
															IConfig $config
	) {
		parent::__construct($appName, $request, $userLookup, $userSession, $session, $logger, $client, $memCacheFactory);

		$this->userSession = $userSession;
		$this->generator = $generator;
		$this->config = $config;
	}

	/**
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 * @PublicPage
	 * @CORS
	 */
	public function index() {
		if ($this->userSession->isLoggedIn()) {
			return new RedirectResponse(\OC_Util::getDefaultPageUrl());
		}

		$config = $this->config->getSystemValue('ms-teams', null);

		return new TemplateResponse(
			$this->appName,
			'authentication/index',
			array(
				'url' => $this->generator->linkToRouteAbsolute($this->appName . '.authentication.login'),
				'loginButtonName' => $config['loginButtonName'],
			),
			'login'
		);
	}

	/**
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 * @PublicPage
	 * @CORS
	 */
	public function finalize(): TemplateResponse {
		return new TemplateResponse(
			$this->appName,
			'authentication/finalize',
			array(
				'url' => OC_Util::getDefaultPageUrl()
			),
			'custom'
		);
	}

	/**
	 * @return string
	 */
	protected function getDefaultUrl(): string {
		return $this->generator->linkToRouteAbsolute($this->appName . '.authentication.finalize');
	}
}
