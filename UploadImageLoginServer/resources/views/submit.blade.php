<html>
<input type="file" id="fileInput" name="file"><br>
 <input type="button" value="Upload File" onclick="uploadFile()">

 <script>
function uploadFile(){
    var file = document.getElementById('fileInput').files[0];
    if(file){
        var xhr = new XMLHttpRequest();
        var url = "http://localhost:8000/upload";
        xhr.open("POST", url, true);
        //xhr.setRequestHeader("Content-Type", "multipart/form-data; boundary=");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
            }
        };
        var formData = new FormData();
        formData.append("file", file);
        xhr.send(formData);
    }
}
</script>

</html>
