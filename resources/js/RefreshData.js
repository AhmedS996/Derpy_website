function refreshEventData() {
    fetch("/api/events");
}
function refreshGroupData() {
    fetch("/api/groups");
}
function refreshUserData() {
    fetch("/api/users");
}
function refreshEmailData() {
    fetch("/api/emails");
}

window.onload = function () {
    refreshUserData();
    refreshEventData();
    refreshGroupData();
    refreshEmailData();
};
