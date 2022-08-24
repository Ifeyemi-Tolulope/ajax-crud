<?php
include("db.php");

/*******SEARCH *****/
if(isset($_POST['search'])){
   $search =  mysqli_real_escape_string($conn, $_POST['search']);


    $query = "SELECT * FROM cars WHERE title LIKE '%$search%' ";
    $result = mysqli_query($conn,$query);

    if(!$result){
        die("ERRRRRORRRRR!!!".mysqli_error($conn));
    }
    
    $count = mysqli_num_rows($result);

    if($count > 0){
        while($row = mysqli_fetch_array($result)){
            $id =  $row['id'];
            $title = $row['title'];
        }

        echo "<li class=''>{$title}</li>";
    }else{
        echo "RECORD NOT FOUND!!!!";
    }
 
}

/*******add user *****/

if(isset($_POST['car_name'])){
    $car_name = $_POST['car_name'];

    $query = "INSERT INTO cars (title) VALUES('{$car_name}')";
    $result = mysqli_query($conn,$query);

    if(!$result){
       die("ERRRRRORRRRR!!!".mysqli_error($conn));
   }

}


if(isset($_POST['view'])){

     $query = "SELECT * FROM cars";
     $result = mysqli_query($conn,$query);

     if(!$result){
        die("ERRRRRORRRRR!!!".mysqli_error($conn));
    }

    while($row = mysqli_fetch_array($result)){
        $id =  $row['id'];
        $title = $row['title'];

        echo"<tr>";
        echo"<td>$id</td>";
        echo"<td ><a rel='$id' class='title-link' href='javascript:void(0)'>$title</a></td>";
        echo"</tr>";
    }

}

if(isset($_POST['edit'])){


    $edit = mysqli_escape_string($conn, $_POST['edit']);

    $query = "SELECT * FROM cars WHERE id = $edit ";
    $result = mysqli_query($conn,$query);

    if(!$result){
       die("ERRRRRORRRRR!!!".mysqli_error($conn));
   }

//    while($row = mysqli_fetch_array($result)){

    $row = mysqli_fetch_array($result);
       $id =  $row['id'];
       $title = $row['title'];
       
       echo "<input rel='$id' id='title-update' type='text' name='new_title' value='$title'>";
       echo "<button id='update' class='btn btn-success'>Update</button>";
       echo "<button id='delete'class='btn btn-danger'>Delete</button>";
//    }

  

}

if(isset($_POST['updatethis'])){

    
    $id = mysqli_real_escape_string( $conn, $_POST['id'] );
    $title = mysqli_real_escape_string( $conn, $_POST['title'] );
    // $updatethis = mysqli_real_escape_string( $conn, $_POST['updatethis'] );

    $query = "UPDATE cars SET title = '$title' WHERE id = $id";
    $result = mysqli_query($conn,$query);

    if(!$result){
        die("ERRRRROOOOOORRRRRR".mysqli_error($conn));
    }else{
        echo "Updated Succesfully!!!";
    }

}


?>
<script>
    $(document).ready(function(){
        var id;
        var title;
        var updatethis = "updatethis";
        var deletethis = "deletethis";

        $('.title-link').on('click',function(){
            
            $('#feedback').text('Selected New');

            var id = $(this).attr('rel');
            var url = "process.php";
         
            // alert(id);

            $.post(url,{edit:id},function(data){
                if(!data.error){
                    $('#action-container').html(data);
                }     
            });

        });

        $('#title-update').on('input', function(){
            title = $(this).val();
            id = $(this).attr('rel');
            
            
        });

            $('#update').on('click', function(){
                
            
            $.post("process.php",{id:id,title:title,updatethis:updatethis},function(data){
                if(!data.error){
                    $('#feedback').text('Record Updated succesfully!!');
                    
                }  
                
            });
           

            //prevent re-occuring execution of this function
            $(this).exit();
            
        });

        
    });
</script>


