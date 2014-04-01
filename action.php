<?php
$language="enus";
include_once("locale/".$language.".php");
include 'content.php';
$content = new content;
$data = array();

switch($_SERVER['REQUEST_METHOD'])
{
   case 'GET': 

      $the_request = &$_GET; 

      break;

   case 'POST': 

      $the_request = &$_POST; 
      $the_requestg = &$_GET; 
         
      if(stristr($the_requestg['for'], "homepage") !== false)
      {

         switch ($the_requestg['data']) {

            case 'newsfeed':
                     $data['for'] = 'newsfeed';
                     $viewdata = array_values($content->viewitems(array('id,newsfeed'), $prefix.'module', "WHERE newsfeed != ''"));

                     if($viewdata) {
                        $data['content'] = $the_request['content'];
                        $data['id'] = $viewdata[0]['id'];

                        $return = $content->update_content($data);
                     } else {
                        $data['content'] = $the_request['content'];
                        
                        $return = $content->insert_content($data);
                     }

                     if($return)
                     {
                        echo "<script>alert('Success!'); location.href = './';</script>";
                        exit;
                     }

                     echo "<script>alert('There was an error!')</script>";
               break;
            case 'copp':

                     $data['for'] = 'copp';
                     $viewdata = array_values($content->viewitems(array('id,careeropp'), $prefix.'module', "WHERE careeropp != ''"));

                     if($viewdata) {
                        $data['content'] = $the_request['content'];
                        $data['id'] = $viewdata[0]['id'];

                        $return = $content->update_content($data);
                     } else {
                        $data['content'] = $the_request['content'];
                        
                        $return = $content->insert_content($data);
                     }

                     if($return)
                     {
                        echo "<script>alert('Success!');location.href = './'; </script>";
                        exit;
                     }

                     echo "<script>alert('There was an error!')</script>";

               break;            
            default:
                  die('bloodsuckers! aw');
               break;
         }
      }

      break;

   default:
      break;
}

header("location:javascript://history.go(-1)");
exit;