/*eslint-env browser*/
//Note there aren't actual errors, "$ is not defined" can be ignored since jQuery is imported from other pages
function likePost(pid, likes){
    var name = 'like' + pid;
    document.getElementById(name).innerHTML = (likes + 1) + " Like(s)";
    document.getElementById(name).style.color = "rgb(0, 192, 0)"; 
    $('#hidden').append($('<div>').load('like.php?pid=' + pid)); 
    document.getElementById(name).onclick = function(){unlikePost(pid, likes + 1)};
}
function unlikePost(pid, likes){
    var name = 'like' + pid;
    document.getElementById(name).innerHTML = (likes - 1) + " Like(s)";
    document.getElementById(name).style.color = "rgb(0, 0, 0)"; 
    $('#hidden').append($('<div>').load('unlike.php?pid=' + pid)); 
    document.getElementById(name).onclick = function(){likePost(pid, likes - 1)};
}