<?php

$xml = simplexml_load_file("books.xml");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Online Book Library</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
        }

        .header {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: white;
            text-align: center;
            padding: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 32px;
        }

        .header p {
            margin-top: 8px;
            font-size: 16px;
        }

        .container {
            width: 90%;
            max-width: 1000px;
            margin: 35px auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.10);
        }

        h2 {
            text-align: center;
            color: #1e3c72;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 8px;
        }

        th {
            background: #1e3c72;
            color: white;
            padding: 15px;
            font-size: 16px;
        }

        td {
            padding: 13px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            color: #333;
        }

        tr:nth-child(even) {
            background: #f2f6fc;
        }

        tr:hover {
            background: #dce9ff;
            transition: 0.3s;
        }

        .price {
            font-weight: bold;
            color: #1e3c72;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            color: #777;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>📚 Online Book Library</h1>
        <p>Book Details and Information</p>
    </div>

    <div class="container">

        <h2>Available Books</h2>

        <table>

            <tr>
                <th>S.No</th>
                <th>Book Title</th>
                <th>Author</th>
                <th>Year</th>
                <th>Price</th>
            </tr>

            <?php
            $i = 1;

            foreach ($xml->book as $book) {
                echo "<tr>";
                echo "<td>" . $i . "</td>";
                echo "<td>" . $book->title . "</td>";
                echo "<td>" . $book->author . "</td>";
                echo "<td>" . $book->year . "</td>";
                echo "<td class='price'>$" . $book->price . "</td>";
                echo "</tr>";

                $i++;
            }
            ?>

        </table>

        <div class="footer">
            Total Books: <?php echo $i - 1; ?> | Online Book Library
        </div>

    </div>

</body>
</html>