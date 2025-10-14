<?php
//include our configure file
require_once 'config.php';

class Database{
    //Private property to hold our PDO
    private $pdo;
    //Public property to store any errors
    public $error = null;
    //Constructor to receive the PDO connection
    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }
    /**
     * IMAGE VALIDATION AND UPLOAD
     * validate and upload a user profile
     * @param array $fileData THE$_FILES array for the uploaded image
     * @return string|false returns the new image path on success or false on failure
     */
    private function validateImage(array $fileData) {
        if(empty($fileData['name'])) {
            $this->error = "Please select a profile image.";
            return false;
        }
        $fileName = $fileData['name'];
        $fileTmpName = $fileData['tmp_name'];
        $fileSize = $fileData['size'];
        $fileError = $fileData['error'];

        //Check for upload errors
        if($fileError !== 0){
            $this->error = "There was an issue uploading your file.";
            return false;
        }
        //Allow images type
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if(!in_array($fileExt, $allowed)){
            $this->error = "Only JPG, JPEG, PNG, or GIF files are allowed.";
            return false;
        }
        //Enforce maximum size(2 MB)
        $maxSize = 2 * 1024 * 1024; //2MB
        if($fileSize > $maxSize) {
            $this->error = "File must be less than 2MB.";
            return false;
        }
        //Create a unique name to avoid overwriting
        $newFileName = uniqid('', true) . "." . $fileExt;
        $fileDestination = 'uploads/' . $newFileName;

        //Move the uploaded folder form the temporary location to its final location
        if(!move_uploaded_file($fileTmpName, $fileDestination)){
            $this->error = "File upload failed";
            return false;
        }
        //If successful, return the file path to DB storage
        return $fileDestination;
    }
    /**
     * CREATE (INSERT)
     * @param string $full_name - user's name
     * @param string $email - user's email
     * @param string $bio - user's bio/description
     * @param array $fileData - the $_FILES array for the uploaded image
     * @return bool true on success, false on failure
     */
    public function create($full_name, $email, $bio, array $fileData){
        //validate and upload the image
        $imagePath = $this->validateImage($fileData);
        if($imagePath === false){
            return false;
        }
        try{
            //prepare the SQL statement
            $sql = "INSERT INTO users (full_name, email, bio, image_path) VALUES(:full_name, :email, :bio, :image_path)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':full_name', $full_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':bio', $bio);
            $stmt->bindParam(':image_path', $imagePath);
            return $stmt->execute();
        } catch(PDOException $e){
            //store the message
            $this->error = "Database Error: " . $e->getMessage();
            // clean up the uploaded image if insert fails
            if(file_exists($imagePath)){
                unlink($imagePath);
            }
            return false;
        }
    }
    /**
     * Read function
     */
    public function read(){
        try{
            $sql = "SELECT * FROM users ORDER BY id DESC";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e){
            $this->error = "Database Error: " . $e->getMessage();
            return false;
        }
    }
}
//create a global database object for use in your scripts
$db = new Database($pdo);
?>