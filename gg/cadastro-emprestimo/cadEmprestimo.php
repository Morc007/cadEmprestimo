<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleEmprestimo.css">
    <title>Registro De Livros</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="topbar" id="header"></div>
    <div class="Encapsulamento">
        <div class="grayBox">
            <div class="CadastrarLivro">
                <span>CADASTRAR LIVRO</span>
            </div>
            <form action="register.php" method="post" enctype="multipart/form-data">
                <div class="form-group full-width imgContainerImg">
                   
                </div>

                <div class="form-group full-width">
                    <label for="Name">Nome do Estudante:</label>
                    <input type="text" id="Name" name="Name" placeholder="Digite o nome do livro" required>
                </div>

                <div class="form-group full-width">
                    <label for="matricula">Matricula</label>
                    <input type="text" id="matricula" name="matricula" placeholder="Digite a matricula" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="titulolivro">titulo do livro:</label>
                        <input type="text" id="titulolivro" name="titulolivro" placeholder="Digite o titulo do livro" required>
                    </div>
                    <div class="form-group">
                    <label for="author">Autor do livro:</label>
                    <input type="text" id="author" name="author" placeholder="Digite o nome do autor" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="curso">curso:</label>
                        <select id="curso" name="curso" required>
                            <option value="sim">Sim</option>
                            <option value="nao">Não</option>
                            <option value="sim">Sim</option>
                            <option value="nao">Não</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="observacao">observação:</label>
                        <input type="text" id="observacao" name="obsevacao"
                            placeholder="Digite o ano de aquisição" required>
                    </div>
                   
                </div>

                <div class="button-container">
                    <button type="submit" class="cadastrarButton">
                        <i class="fas fa-check"></i> Cadastrar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#header').load('../../Component/Menu_Nav');
        });
    </script>

    <script src="cdd_genero.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');

            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Impede o envio padrão do formulário

                const formData = new FormData(form);

                fetch('register.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(result => {
                        if (result.status === 'success') {
                            alert(result.message);
                            window.location.reload(); // Recarrega a página após o sucesso
                        } else {
                            alert(result.message);
                        }
                    })
                    .catch(error => {
                        alert('Erro ao realizar o cadastro.');
                    });
            });

            const fileInput = document.getElementById('bookImage');
            const fileInputContainer = document.getElementById('fileInputContainer');
            const previewImage = document.getElementById('previewImage');
            const fileIcon = document.querySelector('.file-icon');

            fileInputContainer.addEventListener('click', () => {
                fileInput.click();
            });

            fileInputContainer.addEventListener('dragover', (event) => {
                event.preventDefault();
                fileInputContainer.classList.add('dragover');
            });

            fileInputContainer.addEventListener('dragleave', () => {
                fileInputContainer.classList.remove('dragover');
            });

            fileInputContainer.addEventListener('drop', (event) => {
                event.preventDefault();
                fileInputContainer.classList.remove('dragover');
                const files = event.dataTransfer.files;
                if (files.length > 0) {
                    fileInput.files = files;
                    displayImage(files[0]);
                }
            });

            // Event listener to handle file selection
            fileInput.addEventListener('change', () => {
                const file = fileInput.files[0];
                if (file) {
                    displayImage(file);
                }
            });

            // Function to display and resize the image
            function displayImage(file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = new Image();
                    img.src = e.target.result;
                    img.onload = function () {
                        const canvas = document.createElement('canvas');
                        const ctx = canvas.getContext('2d');

                        canvas.width = 256;
                        canvas.height = 256;

                        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                        previewImage.src = canvas.toDataURL();
                        previewImage.style.display = 'block';
                        fileIcon.style.display = 'none';
                    };
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

</body>

</html>