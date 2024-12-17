** post_journey_process.php **

Key Points of Your Code:
1- Output Buffering:

ob_start();
2- Fetching Form Data:
    Retrieves input data such as immat, marque, model, etc.

3- Database Connection:
    include('Models/db.php'); 
    $bdd = getBdd();

4- File Upload Handling:
    - Ensures that the first photo is mandatory and validates the file types.
    - Moves files to the uploads directory.

5- Database Insertion:
    Prepares and executes an SQL statement to insert the journey details, including the photo paths.

6- Redirection:
    After processing, it redirects to another page.

