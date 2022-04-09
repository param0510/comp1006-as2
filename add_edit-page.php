<?php
    require 'includes/auth.php';
    $pageName = 'Add/Edit Page';
    require 'includes/header.php';
    try
    {
        $id = '';
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
    
            require 'includes/db-conn.php';
            $sql = 'SELECT * FROM pages WHERE id = :id';
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':id', $id, PDO::PARAM_INT);
            $cmd->execute();
            $page=$cmd->fetch();
    
            $name = $page['pageName'];
            $heading = $page['heading'];
            $content = $page['content'];
    
            $db = null;
        }
    }
    catch(Exception $error)
    {
        header("location:error.php");
    }
?>

    <h2 class="m-3">Add or Edit your pages here!</h2>

    <form class="m-3 mx-5" method="post" action="save-page.php">
        <fieldset class="form-group row my-4">
            <label for="pageName" class="col-sm-2 col-form-label">Page Name</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="pageName" name="pageName" value="<?php if(!empty($id)){ echo $name; } ?>" placeholder="Name of your page..." required>
            </div>
        </fieldset>
        <fieldset class="form-group row my-4">
            <label for="heading" class="col-sm-2 col-form-label">Heading</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="heading" name="heading" value="<?php if(!empty($id)){ echo $heading; } ?>" placeholder="Heading of your page...">
            </div>
        </fieldset>
        <fieldset class="form-group row my-4">
            <label for="content" class="col-sm-2 col-form-label">Content</label>
            <div class="col-sm-10">
                <textarea rows="15" class="form-control" id="content" name="content" placeholder="Type in your content here..."><?php if(!empty($id)){ echo $content; } ?></textarea>
            </div>
        </fieldset>
        
        <input name="id" type="number" value="<?php if(!empty($id)){ echo $id; } ?>" hidden>
        
        <fieldset class="form-group row my-4">
            <div class="col-sm-10">
            <button type="submit" class="btn btn-primary ">Submit</button>
            </div>
        </fieldset>
    </form>
<?php
  require 'includes/footer.php';
?>