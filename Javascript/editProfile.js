var profilePictureInput = document.getElementById("profilePictureUpload");
var removeProfilePicture = document.getElementById("removeProfilePicture");
var selectedProfilePicture = document.getElementById('selectedProfilePicture');

profilePictureInput.onchange = function(){
    document.getElementById("profilePicture").style.display = "none";
    selectedProfilePicture.src = URL.createObjectURL(event.target.files[0]);
    selectedProfilePicture.style.display = "block";
}

removeProfilePicture.onclick = function(){
    document.getElementById("profilePicture").style.display = "none";
    document.getElementById("selectedProfilePicture").style.display = "none";
    selectedProfilePicture.src = "Graphics/defaultProfilePicture.jpg";
    selectedProfilePicture.style.display = "block";
}