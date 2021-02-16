<?php

namespace OCA\MSTeams;

use OCA\OpenIdConnect\Client as OIDCClient;
use OCP\IConfig;
use OCP\ISession;
use OCP\IURLGenerator;

class Client extends OIDCClient {
	/**
	 * @var IURLGenerator
	 */
	private $generator;

	public function __construct(IConfig $config,
															IURLGenerator $generator,
															ISession $session
	) {
		parent::__construct($config, $generator, $session);

		$this->generator = $generator;
	}

	public function getRedirectURL() {
		return $this->generator->linkToRouteAbsolute('ms-teams.authentication.login');
	}
}
