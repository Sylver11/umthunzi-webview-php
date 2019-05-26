<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta name="robots" content="noindex,nofollow">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <title>Umthunzi-Farmer</title>
</head>
<body>
<div class="container">
<div style="position: absolute; z-index:3;"class="alert alert-success" id="success-alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>Success! </strong>
        Vegetable has been added. 
    </div>
    <h5 id="farmername">Please input your PIN below</h5>
    <form class="firstform" role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <div class="input-group">
            <input  maxlength="4" minlenght="4" type="number" placeholder="Enter your PIN here" class="form-control"   id="userpin" aria-label="" aria-describedby="basic-addon1">
        </div>
        <br>
        <div style="display: none; flex-direction: column;" class="reveal-vegetables">
            <h5>Choose type of vegetable </h5>
            <div id="types-vegetables">
                <div id="leafy-greens" style="height:100px;cursor: pointer;">
                    <img  class="img-thumbnail" style=" width: 100%;height: 100%;"class="types-vegatables" src="img/leavy-greens.jpg" alt=""> 
                </div> 
                





                <div id="cruciferous" style="height:100px;cursor: pointer;">
                    <img  class="img-thumbnail" style=" width: 100%;height: 100%;"class="types-vegatables" src="img/cruciferous.jpg" alt=""> 
                </div> 
                <div id="marrow" style="height:100px;cursor: pointer;">
                    <img  class="img-thumbnail" style=" width: 100%;height: 100%;"class="types-vegatables" src="img/marrow.jpg" alt=""> 
                </div>
                <div id="root" style="height:100px;cursor: pointer;">
                    <img  class="img-thumbnail" style=" width: 100%;height: 100%;"class="types-vegatables" src="img/root.jpg" alt=""> 
                </div> 
                <div id="herbs" style="height:100px;cursor: pointer;">
                    <img  class="img-thumbnail" style=" width: 100%;height: 100%;"class="types-vegatables" src="img/herbs.jpg" alt=""> 
                </div>   




                



                
                <button style="float:right;"type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Submit
                </button>
                 
                <!-- <p style="cursor: pointer;">Leavfy Greens</p>  -->
                <!-- <input type="image" src="img/carrot.svg" name="carrot"  value="carrot">
                <input type="image" src="img/broccoli.svg" name="carrot"  value="carrot">
                <input type="image" src="img/lettuce.svg" name="carrot"  value="carrot">
                <input type="image" src="img/chilli.svg" name="carrot"  value="carrot">
                <input type="image" src="img/onion.svg" name="carrot"  value="carrot">
                <input type="image" src="img/potato.svg" name="carrot"  value="carrot">
                <input type="image" src="img/aubergine.svg" name="carrot"  value="carrot">
                <input type="image" src="img/pepper.svg" name="pepper"  value="carrot"> -->
            </div>
            <div id="leafy-greens-options"style="display: none;">

                

                <select id="choose-leafy-greens" class="custom-select">
                    <option selected>Choose leafy-green here</option>
                    <option value="lettuce">Lettuce</option>
                    <option value="spinach">Spinach</option>
                    <option value="cabbage">Cabbage</option>
                    <option value="kale">Kale</option>
                </select> 
                <select style="display: none;" id="quantity-leafy-greens"class="custom-select">
                    <option selected>Choose quantity here</option>
                    <option value="0.5kg">0.5kg</option>
                    <option value="1kg">1kg</option>
                    <option value="1.5kg">1.5kg</option>
                    <option value="2kg">2kg</option>
                </select> 
                <button style="display: none; float: right;"type="button" id="leafy-greens-add-button"class="btn btn-success">Add</button> 
                <div style="display:none;" id="lettuce-img">
                    <img style=" width: 100%;height: 100%;" src="img/lettuce.jpg" alt="">
                </div>
            </div>
            <!-- <p style="color:red">The moment a farmer clicks on a vegetable it will display name of the vegetable and ask for the quantity</p> -->
            <br><br>
            <!-- <button name="submit">Submit</button> -->
        </div>
    </form>
    








<script>

$("#success-alert").hide();
$("#quantity-leafy-greens").on("change", function(e){
    $("#leafy-greens-add-button").css("display","block");
})
    
$("#choose-leafy-greens").on("change", function(e){
    $("#quantity-leafy-greens").css("display","block");

    if($("#choose-leafy-greens").val() =="lettuce"){
        $("#lettuce-img").css("display","block");
    }
    
})

$("#leafy-greens").on("click", function(e){
    e.preventDefault();
    $("#types-vegetables").css("display", "none");
    $("#leafy-greens-options").css("display","block");
});
$("#userpin").on("keyup", function(e){
    // e.preventDefault();
    var userPin = $(this).val();
    if(userPin.length && userPin.length % 4 == 0){
        $.ajax({
            url: "userpin.php",
            async: true,
            method:"POST",
            dataType: "text",
            data: {
                userPin: userPin
            },
            success : function(name){
                var name = JSON.parse(name);
                $("#farmername").text("Welcome " + name["name"]);
                if(name["name"]=="your PIN is incorrect."){
                    $(".reveal-vegetables").css("display", "none");
                }else{
                $(".reveal-vegetables").css("display", "block");
                }
            }
        });
    }
    else{
         $("#farmername").text("Please input your PIN below");
        $(".reveal-vegetables").css("display", "none");
    }
});

$("#leafy-greens-add-button").on("click", function(e){
    $("#leafy-greens-add-button").css("display","block");
    var quality  = $("#choose-leafy-greens").val();
    var quantity = $("#quantity-leafy-greens").val();
    console.log(quantity);
    console.log(quality);
    $.ajax({
        url: "vegetables.php",
        async: true,
        method:"POST",
        dataType: "text",
        data: {
            quality: quality,
            quantity: quantity
        },
        success : function(){
            $("#leafy-greens-options").css("display","none");
            $("#types-vegetables").css("display", "block");
            $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
               $("#success-alert").slideUp(500);
                })

        }

    })
})

</script>


                <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Please make sure all vegetables are correct.</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Confirm</button>
                        </div>
                        </div>
                    </div>
                    </div> 



</div>
<?php

// $date = date('d/m/Y');
// // $date= $datetime1->format('%R%a');
// echo $datetime1;

?>
</body>
</html>