<?php
script('ms-teams', 'teams-sdk', true);
style('ms-teams', 'default');
?>

<script type="application/javascript">
    microsoftTeams.initialize();

    function notifySuccess(url) {
        microsoftTeams.authentication.notifySuccess({url: '<?php print_unescaped($_['url']) ?>'});
    }
</script>

<script type="application/javascript">
    notifySuccess();
</script>