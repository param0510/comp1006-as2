<?php
    require 'includes/auth.php';
    $pageName = 'Pages';
    require 'includes/header.php';
    if(isset($_GET['success']))
    {

      if($_GET['success'])
      {
        echo  '<div class="alert alert-success" role="alert">
                Page list successfully updated!  
              </div>';
      }
    }
    try{

        require 'includes/db-conn.php';
        $sql = 'SELECT * FROM pages';
        $cmd = $db->prepare($sql);
        $cmd->execute();
        $pages=$cmd->fetchAll();
        $db = null;
    }
    catch(Exception $error)
    {
        echo 'im heree';
        header("location:error.php");
    }
?>
    <main class="m-3">
        
        <h2>List of Pages</h2>
        <table class="table table-striped mt-5 w-75 m-auto" >
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Page Name</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($pages)
                    {
                        // Error with confirm Delete function in js
                        $serialNo = 1;
                        foreach ($pages as  $page) 
                        {
                            echo '<tr>
                                    <th scope="row">'.$serialNo.'</th>
                                    <td>'.$page['pageName'].'</td>
                                    <td><a class="btn btn-outline-primary" href="add_edit-page.php?id='.$page['id'].'">Edit</a></td>
                                    <td><a class="btn btn-outline-danger" onClick="return confirmDelete()" href="delete-page.php?id='.$page['id'].'">Delete</a></td>
                                </tr>';
                            $serialNo = $serialNo +1;
                        }
                    }
                    echo    '<tr>
                                <td><a class="btn btn-success" href="add_edit-page.php">Add page</a></td>
                                <td></td>
                                <td></td>   
                                <td></td>
                            </tr>';
                   
                ?>
                
            </tbody>
        </table>
    </main>
<?php
  require 'includes/footer.php';
?>