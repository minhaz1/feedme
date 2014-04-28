<script>
 
<?php 
    include_once('params.php');

    if(isset($member_id) && $_SESSION['SESS_USERTYPE'] == USERTYPE_ADMIN){
?>
        function ban_user(username){
          var conf = confirm("Are you sure you want to ban " + username + "?");
          if(conf){
            var id = document.createElement("input");
            id.setAttribute("value", username); 
            moderate("ban_user", id);            
          }
          alert(username + " has been banned.");

        }

<?php } ?>

    function flag_user(username){
      var conf = confirm("Are you sure you want to flag " + username + "?");
      if(conf){
        var id = document.createElement("input");
        id.setAttribute("value", username); 
        moderate("flag_user", id);
      }
      // alert(username + " has been flagged.");
    }

<?php 
    if(isset($reviewid)){
?>
      function flag_review(reviewid){
        var conf = confirm("Are you sure you want to flag this review?");
        if(conf){
          var id = document.createElement("input");
          id.setAttribute("value", reviewid); 
          moderate("flag_review", id);
        }
        // alert("The review has been flagged.");
      }

<?php 
    }
   
   if(isset($reviewid) && $_SESSION['SESS_USERTYPE'] == USERTYPE_ADMIN){
?>
      function hide_review(reviewid){
        var conf = confirm("Are you sure you want to remove this review?");
        if(conf){      
          var id = document.createElement("input");
          id.setAttribute("value", reviewid); 
          moderate("hide_review", id);
        }
       alert("The review has been removed."); 
      }


<?php } 
  
    if($_SESSION['SESS_USERTYPE'] >= USERTYPE_MOD){

?>

    function moderate (value, id) {

      var form = document.createElement('form');
      form.setAttribute('method', 'post');
      form.setAttribute('action', 'scripts/moderate.php');
      form.style.display = 'hidden';
      
      var action = document.createElement("input");
      action.setAttribute("type", "hidden");
      action.setAttribute("name", "action");
      action.setAttribute("value", value);

      id.setAttribute("type", "hidden");
      id.setAttribute("name", "id");      

      form.appendChild(action);
      form.appendChild(id);
      document.body.appendChild(form);
      form.submit();
    }
    
<?php } ?>

</script>