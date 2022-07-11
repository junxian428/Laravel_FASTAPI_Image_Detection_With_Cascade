<!DOCTYPE html>
<html>
<head>

   <title>Webcam</title>
    <style>
       #camera{
           width: 350px;
           height: 350px;
           border: 1px solid black;
        
        
       }
	


    </style>

</head>
<body>

<div id="demo">
<h1>LOGIN PORTAL</h1>
</div>

<div id="camera" ></div>
<button onclick="take_snapshot()">Take Snapshot</button>
<button onclick="saveImageAs(document.anImage); return false">View</button>


<div id="download" style="display:inline;  ">
</div>
<div>
<p>Login: <input type="file" id="fileInput" name="file"><input type="button" value="Upload File" onclick="uploadFile()"> </p>
</div>
<br>


<h3>Preview Effect</h3>
<div id="results" class="results">
</div>
<textarea id="result" rows="25" cols="50"></textarea>

<br>





</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
<script src="https://html2canvas.hertzen.com/build/html2canvas.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

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
                //alert(xhr.responseText);
            }
        };
        var formData = new FormData();
        formData.append("file", file);
        xhr.send(formData);
        
        }
       
    }
    function take_snapshot(){
        // Load all webcam
        Webcam.set({
            width:350,
            height: 350,
            image_format:'jpeg',
            jpeg_quality:90
        })

    }
    Webcam.attach("#camera")
    function convertURIToImageData(URI) {
        return new Promise(function(resolve, reject) {
            if (URI == null) return reject();
                var canvas = document.createElement('canvas'),
                context = canvas.getContext('2d'),
                image = new Image();
            image.addEventListener('load', function() {
            canvas.width = image.width;
            canvas.height = image.height;
            context.drawImage(image, 0, 0, canvas.width, canvas.height);
            resolve(context.getImageData(0, 0, canvas.width, canvas.height));
            }, false);
        image.src = URI;
        });
    }

   


    function take_snapshot(){
        Webcam.snap(function(data_uri) {
            document.getElementById('results').innerHTML = '<img id="anImage" src="'+data_uri+'"/>';
	    var image1 = new Image();
	    image1.src = document.getElementById("anImage").src;            
        //document.getElementById('file').innerHTML = '<input></input>';
	    document.getElementById('download').innerHTML = '<button><a href="'+image1.src +'" download="photo" style="color:black; text-decoration:none;">Download </a></button>';
        

        });


        var img = document.getElementById('anImage');
        //img.crossOrigin = "Anonymous";
        img.onload = function(){

            function POST_CREATE(){
                //var canvas = document.createElement('canvas');
                //var ctx = canvas.getContext('2d');
                //canvas.height = this.naturalHeight;
                //canvas.width = this.naturalWidth;
                //console.log(typeof ctx[this.spriteCostumeCount])
                //ctx.drawImage(this,0,0);
                //var data = img.toDataURL('image/jpeg');
                //document.getElementById('result').value = data;
                console.log(img);
                var currentSource;
                currentSource = img.currentSrc;
                console.log(currentSource);
                document.getElementById('result').value = currentSource;
                //var data;
                //data = currentSource;
                //document.getElementById('file').value=currentSource;
                convertURIToImageData(currentSource).then(function(imageData) {
                    // Here you can use imageData
                    console.log(imageData);
                    //document.getElementById('file').value = imageData;
                    
                    //var xhr = new XMLHttpRequest();
                    //var url = "http://localhost:8000/upload";
                    //xhr.open("POST", url);
                    //xhr.onreadystatechange = function () {
                    //if (xhr.readyState === 4) {
                        //console.log(xhr.status);
                        //console.log(xhr.responseText);
                    //}};

                     //xhr.send(imageData);
                });

                          
                
                //callback(data);
            //var sendBase64ToServer = function(name, base64){
            //var httpPost = new XMLHttpRequest(),
            //path = "http://127.0.0.1:8000/uploadImage/" + name,
            //data = JSON.stringify({image: base64});
            //console.log(data);
            //httpPost.onreadystatechange = function(err) {
                //if (httpPost.readyState == 4 && httpPost.status == 200){
                    //console.log(httpPost.responseText);
                //} else {
                    //console.log(err);
                //}
            //};
            // Set the content type of the request to json since that's what's being sent
            //httpPost.setHeader('Content-Type', 'application/json');
            //httpPost.open("POST", path, true);
            //httpPost.send(data);
            //console.log(data);
            //};
           
            
        }    
        POST_CREATE();
        };    
    }


    function saveImageAs (data){
	    if(typeof data == 'object')
		    data = data.src;

	   
	    var image = new Image();
	    image.src = document.getElementById("anImage").src;
	    var w = window.open("");
	    w.document.write(image.outerHTML);
	    w.document.execCommand("SaveAs",null,'image15.jpeg');
	    
    }





   
</script>
</html>