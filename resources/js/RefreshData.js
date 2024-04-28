function refreshEventData() {
    fetch("/api/events")
}
function refreshGroupData() {
    fetch("/api/groups")
}
function refreshUserData() {
    fetch("/api/users")
}

window.onload = function() {
    refreshUserData();
    refreshEventData();
    refreshGroupData();
};
