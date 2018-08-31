function vl_logout() {
    campaign.$(function() {
        campaign.logout({reloadWidgets: true});
    });
}
