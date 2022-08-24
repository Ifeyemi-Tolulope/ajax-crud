<?php
include('db.php');

// if(isset($_POST['car_name'])){
//     $car_name = $_POST['car_name'];

  $query = "SELECT * FROM cars";
  $result = mysqli_query($conn,$query);

  if(!$result){
      die("ERRRRROOOOOORRRRRR".mysqli_error($conn));
  }

  while ($row = mysqli_fetch_array($result)) {
      $view_id = $row['id'];
      $view_cars = $row['title'];

      echo "<tr>";
      echo "<td class='car_id'>$view_id </td>";
      echo "<td><a rel='{$view_id}' class='title_link' href='javascript:void(0)'>$view_cars </a></td>";
      echo "</tr>";
  }
//   header("Location:index.html");
// }
?>
<script>
   $(document).ready(function(){
        //  $('#action-container').hide();
        

   $('.title_link').on('click', function(){
    //    alert('ALERT');
       
    //    $('#action-container').show();

       var id = $(this).attr('rel');

      //  alert(id);

       $.post('process.php',{edit:id}, function(data){
       $('#action-container').html(data);
      // alert(data);

       });


   }); 

   });
   
</script>