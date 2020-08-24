var uploadButton = document.getElementById("uploadLabel");

//Upload Button//

uploadButton.onmouseover = function(){
    document.getElementById("uploadButton").style.display = "none";
    document.getElementById("uploadButtonHover").style.display = "block";
}

uploadButton.onmouseout = function(){
    document.getElementById("uploadButton").style.display = "block";
    document.getElementById("uploadButtonHover").style.display = "none";
}

function openCaptionModal(captionModalID){
    captionModal = document.getElementById(captionModalID);
    captionModal.style.display = "block";
    var image = document.getElementById('output');
    image.src = URL.createObjectURL(event.target.files[0]);
}

function closeCaptionModal(captionModalID){
    captionModal = document.getElementById(captionModalID);
    captionModal.style.display = "none";
    document.getElementById('uploadInput').value=null;
}