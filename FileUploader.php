<!DOCTYPE html>
<html>
<head>
	<title>Lab 9: Uploading files</title>
</head>

<body>
	<?php
	function UploadFile($fname, $fileAllowed, $sizeAllowed, $overrideAllowed)
    {
    	$uploadOK = 1;
        $dir = "upload/"; //the folder for the files
        
        $file = $dir . basename($_FILES[$fname]["name"]); //folder and file name
        $fileType = pathinfo($file, PATHINFO_EXTENSION);
        $fileSize = $_FILES[$fname]["size"];
        
        if($fileSize > $sizeAllowed)
        {
        	echo "File is too big<br/>";
            $uploadOK = 0;
        }
        if(!stristr($fileAllowed, $fileType))
        {
        	echo "File type is not allowed<br/>";
            $uploadOK = 0;
        }
        if(!$overrideAllowed && file_exists($file))
        {
        	echo "File does not exist<br/>";
            $uploadOK = 0;
        }
        if($uploadOK == 1)
        {
        	if(!move_uploaded_file($_FILES[$fname]["tmp_name"], $file)) $uploadOK = 0;
        }
        if($uploadOK == 1)return $file;
        else return false;
    }
	?>

	<h1>Application for GGC jobs</h1>
	<p>Please fill in the information</p>
	<form method=POST action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
    
	<table border=1>
        <tr><td align=right>Name:</td><td><input type="text" name="name" value=""></td></tr>
        <tr><td align=right>Email:</td><td><input type="email" name="email"  value=""></td></tr>
        <tr><td align=right>Highest Education Degree:</td><td>
        <select name="education">
            <option value="Doctor">Doctor</option>
            <option value="Master">Master</option>
            <option value="College">College</option>
            <option value="High School">High School</option>  
        </select> <br/><br/>
        </td></tr>

        <tr><td align=right>Position Applied:</td><td>
        <select name="position">
            <option value="IT Help Desk Technician" >IT Help Desk Technician</option>
            <option value="Fron Desk Receptionist" >Fron Desk Receptionist</option>
            <option value="Janitor"  >Janitor</option>
            <option value="PHP Web Programmer" >PHP Web Programmer</option>  
        </select> <br/><br/>
        </td></tr>

        <tr><td align=right>CV (PDF only):</td><td><input type="file" name="cv"></td></tr>
        <tr><td align=right>Photo (PNG/JPG/GIF):</td><td><input type="file" name="photo"></td></tr>
        <tr><td><input type="submit" name="submit" value="Submit"></td><td><input type="reset" name="reset"></td></tr>
	</table>
</form>

<?php 
if(isset($_POST["submit"]))
{
	$fname1 = "cv";
    $fname2 = "photo";
    $fileAllowed = "PNG:JPEG:JPG:GIF:BMP:PDF";
    $sizeAllowed = 5000000; //5 megabytes
    $overrideAllowed = 1;
    
    
    echo "<br/><table border=1>";
        echo "<tr><td align=right>Name:</td><td>" . $_POST["name"] . "</td></tr>";
        echo "<tr><td align=right>Email:</td><td>" . $_POST["email"] . "</td></tr>";
        echo "<tr><td align=right>Highest Education Degree:</td><td>" . $_POST["education"] . "</td></tr>";

        echo "<tr><td align=right>Position Applied:</td><td>" . $_POST["position"] . "</td></tr>";

        echo "<tr><td align=right>CV (PDF only):</td><td>" . 
       		$file2 = UploadFile($fname1, $fileAllowed, $sizeAllowed, $overrideAllowed);
    		if($file2 != false) echo "<a href='" .$file2. "' target='_blank'>link</a>";
    		else echo "CV file was not uploaded sucessfully<br/>"
        . "</td></tr>";
        echo "<tr><td align=right>Photo (PNG/JPG/GIF):</td><td>" . 
       		$file = UploadFile($fname2, $fileAllowed, $sizeAllowed, $overrideAllowed);
    		if($file != false) echo "<img src='" .$file. "' width=300 height=300/>";
    		else echo "Image file was not uploaded sucessfully<br/>"
        . "</td></tr>";
	echo "</table>"; 
}
?>

 </body>
 </html> 