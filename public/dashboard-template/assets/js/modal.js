// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
var authorText = document.getElementById("author-name");

function popUp(name, directory, uploader){
    console.log(directory);

    modal.style.display = "block";

    modalImg.src = directory;
    modalImg.data = directory;

    authorText.innerHTML = uploader;
    captionText.innerHTML = name;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal and reset src img
span.onclick = function() { 
    modal.style.display = "none";
    modalImg.src = '';
    modalImg2.src = '';
    modalImg2.style = 'hidden';
}
