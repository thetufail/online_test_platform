<!DOCTYPE html>
<html>
<head>
    <title>
        Register
    </title>
    <!-- <link rel="stylesheet" type="text/css" href="admin.css"> -->
</head>
<body>
    <div id="wrapper">
        <div id="addproduct-form">
            <h2>Add Questions</h2>
            <form action="addproduct.php" method="POST" enctype="multipart/form-data">
                <table>
                    <tr>
                        <th>Question Number</th>
                        <th>Question</th>
                        <th>Option 1</th>
                        <th>Option 2</th>
                        <th>Option 3</th>
                        <th>Option 4</th>
                        <th>Answers</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td><textarea name="" id="" cols="30" rows="10" required></textarea></td>
                        <td><input type="text" name="id" required></td>
                        <td><input type="text" name="id" required></td>
                        <td><input type="text" name="id" required></td>
                        <td><input type="text" name="id" required></td>
                        <td colspan="6">
                        <table>
                            <tr>  
                                <td>Option 1</td>  
                                <td><input type="checkbox" name="answers[]" value="option1"></td>  
                            
                            <tr>  
                                <td>Option 2</td>  
                                <td><input type="checkbox" name="answers[]" value="option2"></td>  
                            </tr>
                            <tr>  
                                <td>Option 3</td>  
                                <td><input type="checkbox" name="answers[]" value="option3"></td>  
                            
                            <tr>  
                                <td>Option 4</td>  
                                <td><input type="checkbox" name="answers[]" value="option4"></td>  
                            </tr>
                        </table>
                        </td>
                    </tr>
                </table>
                <p>
                    <input type="submit" name="submit" value="Submit">
                </p>
            </form>
        </div>
    </div>
</body>
</html>