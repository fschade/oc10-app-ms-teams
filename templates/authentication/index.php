<?php
script('ms-teams', 'teams-sdk', true);
style('ms-teams', 'default');
?>

<script type="application/javascript">
    microsoftTeams.initialize();

    function authenticate() {
        microsoftTeams.authentication.authenticate({
            url: '<?php print_unescaped($_['url']) ?>',
            width: 600,
            height: 535,
            successCallback: function (result) {
                window.location = result.url
            },
            failureCallback: function (reason) {
                alert(reason)
            }
        });
    }
</script>

<button onclick="authenticate()"><?php print_unescaped($_['loginButtonName']) ?></button>
