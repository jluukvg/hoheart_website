<div class="col-sm-9 col-md-9 well admin-content" id="account-changeProfilePic">

                                <!--  <script>
                                    var head = document.getElementsByTagName("head")[0],
                                        cssLink = document.createElement("link");

                                    cssLink.href = "https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.css";
                                    cssLink.id = "dynamic-css";
                                    cssLink.media = "screen";
                                    cssLink.type = "text/css";

                                    head.appendChild(cssLink);
                                </script>-->

                                <div class="container">
                                    <h1>Upload Profile Picture</h1>
                                    <h3>Image</h3>

                                    <form name="form5" role="form" enctype="multipart/form-data" method="post" action="users.php">
                                        <input type="hidden" name="action" value="changeProfilePic">

                                        <div class="cropping-canvas">

                                            <input type='file' onchange="readURL(this);" id="fileInput" />
                                            <img id="blah" src="#" alt="your image" />
                                        </div>
                                        <h3>Result</h3>
                                        <p>
                                            <button type="button" id="button">Crop</button>
                                        </p>
                                        <div id="result"></div>
                                        <p class="button">

                                            <input type="submit" name="Submit" value="upload" id="dnd_upload" />
                                        </p>
                                    </form>



                                </div>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js"></script>
                                <script>
                                    function readURL(input) {
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();

                                            reader.onload = function (e) {
                                                $('#blah')
                                                    .attr('src', e.target.result)
                                                    .width(150)
                                                    .height(200);

                                                var image = document.getElementById('blah');
                                                var button = document.getElementById('button');
                                                var result = document.getElementById('result');

                                                var croppable = false;
                                                var cropper = new Cropper(image, {
                                                    aspectRatio: 1,
                                                    viewMode: 1,
                                                    crop: function (e) {
                                                        console.log(e.detail.x);
                                                        console.log(e.detail.y);
                                                        console.log(e.detail.width);
                                                        console.log(e.detail.height);
                                                        console.log(e.detail.rotate);
                                                        console.log(e.detail.scaleX);
                                                        console.log(e.detail.scaleY);
                                                    },
                                                    ready: function () {
                                                        croppable = true;
                                                    }
                                                });
                                            };

                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }

                                    $(document).ready(function () {


                                        button.onclick = function () {
                                            document.write(croppable);
                                            var croppedCanvas;
                                            var squareImage;
                                            if (!croppable) {
                                                return;
                                            }
                                            // Crop
                                            croppedCanvas = cropper.getCroppedCanvas();
                                            // Show
                                            squareImage = document.createElement('img');
                                            squareImage.src = croppedCanvas.toDataURL('image/jpeg')

                                            result.innerHTML = '';
                                            result.appendChild(squareImage);

                                            var url = 'hidden.php',
                                                image_data = $(squareImage).attr('src');

                                            $.ajax({
                                                type: "POST",
                                                url: url,
                                                dataType: 'text',
                                                data: {
                                                    base64data: image_data
                                                }

                                            });


                                        };
                                    });
                                </script>





                            </div>