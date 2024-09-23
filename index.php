<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Chatbot</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>PDF Chatbot</h1>
        <form id="upload-form" enctype="multipart/form-data">
            <label for="pdf">Upload a PDF:</label>
            <input type="file" id="pdf" name="pdf" accept="application/pdf" required>
            <button type="submit">Upload</button>
        </form>
        
        <div id="chatbox">
            <input type="text" id="query" placeholder="Ask something about the PDF">
            <button id="ask-btn">Ask</button>
            <p id="response"></p>
        </div>
    </div>

    <script>
        document.getElementById('upload-form').onsubmit = function(event) {
            event.preventDefault();

            const formData = new FormData(document.getElementById('upload-form'));

            fetch('upload.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message || data.error);
            });
        };

        document.getElementById('ask-btn').onclick = function() {
            const query = document.getElementById('query').value;

            fetch('chatbot.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'query=' + encodeURIComponent(query)
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('response').textContent = data.response || data.error;
            });
        };
    </script>
</body>
</html>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    max-width: 400px;
    width: 100%;
}

h1 {
    margin-bottom: 20px;
}

#upload-form {
    margin-bottom: 20px;
}

#chatbox {
    margin-top: 20px;
}

#chatbox input[type="text"] {
    width: 70%;
    padding: 10px;
    margin-right: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

#chatbox button {
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

#chatbox button:hover {
    background-color: #0056b3;
}

#response {
    margin-top: 20px;
    font-weight: bold;
}
</style>s