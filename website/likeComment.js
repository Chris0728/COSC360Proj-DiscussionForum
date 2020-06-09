/*eslint-env browser*/
//Note there aren't actual errors, "$ is not defined" can be ignored since jQuery is imported from other pages
function likeComment(cid, likes){
    var name = 'like_c' + cid;
    document.getElementById(name).innerHTML = (likes + 1) + " Like(s)";
    document.getElementById(name).style.color = "rgb(0, 192, 0)"; 
    $('#hidden').append($('<div>').load('like.php?cid=' + cid)); 
    document.getElementById(name).onclick = function(){unlikeComment(cid, likes + 1)};
}
function unlikeComment(cid, likes){
    var name = 'like_c' + cid;
    document.getElementById(name).innerHTML = (likes - 1) + " Like(s)";
    document.getElementById(name).style.color = "rgb(0, 0, 0)"; 
    $('#hidden').append($('<div>').load('unlike.php?cid=' + cid)); 
    document.getElementById(name).onclick = function(){likeComment(cid, likes - 1)};
}