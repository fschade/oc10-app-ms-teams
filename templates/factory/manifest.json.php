{
  "$schema": "https://developer.microsoft.com/json-schemas/teams/v1.8/MicrosoftTeams.schema.json",
  "manifestVersion": "1.8",
  "version": "<?php print_unescaped($_['version']) ?>",
  "id": "<?php print_unescaped($_['id']) ?>",
  "packageName": "<?php print_unescaped($_['packageName']) ?>",
  "developer": {
    "name": "ownCloud",
    "websiteUrl": "https://owncloud.com/",
    "privacyUrl": "https://owncloud.com/privacy-statement/",
    "termsOfUseUrl": "https://owncloud.com/imprint/"
  },
  "name": {
    "short": "<?php print_unescaped($_['name.short']) ?>",
    "full": "<?php print_unescaped($_['name.full']) ?>"
  },
  "description": {
    "short": "<?php print_unescaped($_['description.short']) ?>",
    "full": "<?php print_unescaped($_['description.short']) ?>"
  },
  "icons": {
    "outline": "outline.png",
    "color": "color.png"
  },
  "accentColor": "<?php print_unescaped($_['accentColor']) ?>",
  "staticTabs": [
    {
      "entityId": "ownCloud",
      "name": "ownCloud",
      "scopes": [
        "personal"
      ],
      "context":[
        "personalTab",
        "channelTab"
      ],
      "contentUrl": "<?php print_unescaped($_['contentUrl']) ?>"
    }
  ],
  "validDomains": [
    "<?php print_unescaped($_['validDomain']) ?>"
  ],
  "showLoadingIndicator": false,
  "isFullScreen": false
}