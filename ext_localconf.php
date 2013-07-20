<?php
if (TYPO3_MODE === 'BE') {
	// AJAX Extbase Dispatcher
	$TYPO3_CONF_VARS['BE']['AJAX']['opauth'] = 'Butenko\\Opauth\\Utility\\AjaxDispatcher->initAndDispatch';
	// Add popup js to user setup module
	$TYPO3_CONF_VARS['SC_OPTIONS']['ext/setup/mod/index.php']['setupScriptHook']['opauth'] = 'Butenko\\Opauth\\Controller\\UserSetupModuleController->jsAction';
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'Opauth',
		'authentification',
		array(
			'Authentification' => 'authenticate,callback'
		)
	);
}


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addService($_EXTKEY, 'auth', 'Butenko\\Opauth\\OpauthService',
	array(
		'title' => 'Opauth Authentication',
		'description' => 'Opauth authentication service for Frontend and Backend',
		'subtype' => 'getUserFE,authUserFE,getUserBE,authUserBE',
		'available' => TRUE,
		'priority' => 75,
		// Must be higher than for tx_sv_auth (50) or tx_sv_auth will deny request unconditionally
		'quality' => 50,
		'os' => '',
		'exec' => '',
		'className' => 'Butenko\\Opauth\\OpauthService'
	)
);
?>
