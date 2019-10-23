<?php  
   session_start();
   require_once ('../includes/init.php');
   $user = new User();
   $role = $_SESSION['role'];
   if (!$user->get_session()) {
    header("location:../login.php");
    exit();
    }
    
    if (isset($_GET['q'])) {
        $user->user_logout();
        header("location:../login.php");
        exit();
    }
   $uid = $_SESSION['uid'];

   
   ?>
<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://bootswatch.com/4/minty/bootstrap.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
      <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
      <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" />
      <link rel="stylesheet" href="../sidebar/sidebar.css" />
      <title>אצל דודי - ספקים</title>
   </head>
   <style>
      .custom-select {
      width: 30%;
      }
      canvas {
      max-width: 100%;
      height:80%;
      margin:auto;
      }
   </style>
   <body>
      <?php include "../sidebar/sidebarH.php"; ?>
      <!-- Page Wrapper -->
      <div id="wrapper" class="toggled">
         <!-- Content Wrapper -->
         <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
             <h1 class="text-center">אצל דודו - מאגר ספקים</h1>
             <div dir="rtl" class="text-center" id="jsGrid"></div>
            <!-- End of Main Content -->
         </div>
         <!-- End of Content Wrapper -->
      </div>
      <!-- End of Page Wrapper -->
      <?php include "../sidebar/sidebarF.php"; ?>
      <!-- JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <!-- Page level custom scripts -->
      <script src="script.js"></script>
        <script type="text/javascript" src="jsgrid.min.js"></script>
      <script type="text/javascript" src="jsgrid-locale-he.js"></script>
      <script>
         var role = <?php if($role != "מנהל"){ echo 'false'; } else { echo 'true'; }?>;
         if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                 if(role){
                     $('.container-fluid').hide();
                     swal({
                        title: "שים לבד",
                        text: "סמוך עלינו, יותר נוח להשתמש במאגר הספקים מהמחשב",
                        icon: "warning",
                        button: "אישור",
                        dangerMode: true
                     }).then(function(){
                         window.history.back();
                     });
                 }
             }
         jsGrid.locale("he");
         var MyDateField = function(config) {
             jsGrid.Field.call(this, config);
         };
         
         jsGrid.sortStrategies.birth = function(a,b) {
         var aa = a.split('.').reverse().join(),
             bb = b.split('.').reverse().join();
         return aa < bb ? -1 : (aa > bb ? 1 : 0);
         };
             
         $('#jsGrid').jsGrid({
          width: "100%",
         height: "auto",
          filtering: true,
          inserting:role,
          editing: role,
          sorting: true,
          paging: true,
          autoload: true,
          pageSize: 10,
          pageButtonCount: 5,
          confirmDeleting: false,
          onItemUpdating: function(args) {
                 var myData = $("#jsGrid").jsGrid("option", "data");
                     if(args.previousItem.uid == args.item.uid){
                         $("#jsGrid").jsGrid("loadData");
                     }else{
                         for(i=0; i<myData.length; i++){
                             if(myData[i].uid == args.item.uid){
                                 swal({
                                     title: 'ת"ז קיימת',
                                     text: 'אנא הקש מחדש',
                                     icon: 'error',
                                     buttons: 'סבבה',
                                     dangerMode: true
                                 });
                                 args.cancel=true;
                             }
                         }
                 }
                 
         },
         onItemUpdated: function(args){
             $("#jsGrid").jsGrid("loadData");
         },
          onItemDeleting: function(args){
              if(!args.item.deleteConfirmed){
                  args.cancel = true;
                  swal({
                   reverseButtons: true,
                   title: "מחיקת ספק",
                   text: "האם אתה בטוח?",
                   icon: "warning",
                   buttons: ["ביטול", "אישור"],
                   dangerMode: true,
                 })
                 .then((willDelete) => {
                   if (willDelete) {
                       args.item.deleteConfirmed = true;
                       $('#jsGrid').jsGrid('deleteItem', args.item);
                     swal({
                         title: "נמחק בהצלחה",
                         icon: "success",
                         buttons: 'אישור'
                     });
                   } else {
                     swal({
                         text: "מחיקת ספק בוטלה",
                         buttons: "אישור",
                         icon: "info"
                   });
                 };
              });
          }
          },
          onItemInserting: function (args){
              var myData = $("#jsGrid").jsGrid("option", "data");
              for(i=0; i<myData.length; i++){
                 
              }
              swal({
                     title: "נוסף בהצלחה",
                     icon: "success",
              });
          },
          onItemInserted:function(args){
              $("#jsGrid").jsGrid("loadData");
          },
          controller: {
           loadData: function(filter){
               console.log(filter);
            return $.ajax({
             type: "GET",
             url: "fetch_data.php",
             data: filter,
            });
           },
           insertItem: function(item){
            return $.ajax({
             type: "POST",
             url: "fetch_data.php",
             data:item,
            });
           },
           updateItem: function(item){
            return $.ajax({
             type: "PUT",
             url: "fetch_data.php",
             data: item
            });
           },
           deleteItem: function(item){
            return $.ajax({
             type: "DELETE",
             url: "fetch_data.php",
             data: item
            });
           },
          },
         
          fields: [
             {
                 name: "#",
                 visible : false,
             },
             {
                 name: "name", 
                 title: "שם הספק",
                 type: "text", 
                 width: 150, 
                 validate: "required"
             },
             {
                 name: "address", 
                 type: "text", 
                 title: "כתובת הספק",
                 width: 150, 
                 validate: "required"
             },
             {
                 name: "email", 
                 title: "אימייל",
                 type: "text", 
                 width: 150, 
                 validate:{
                     validator: function validateEmail(email) {
                         var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                         return re.test(String(email).toLowerCase());
                     },
                 message:"אימייל לא תקין"
                 }
             },
             {
                 name: "type", 
                 title: "סוג מוצרים",
                 type: "text", 
                 width: "100", 
                 validate: "required"
             },
             
             {
                 name: "phone", 
                 title: "טלפון",
                 type: "text", 
                 width: 100, 
                 validate: {
                 message: "מספר טלפון לא תקין",
                 validator: "pattern", 
                 param: "^[0-9]{10}$"
             }
             },
             {
                 type: "control",
                 deleteButton: role,
                 editButton: role,
             }
             ]
         });
      </script>
   </body>
</html>